<?php
$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{

    $funiqid = strtoupper(generateRandomString(7));
    $fdate = date("Y-m-d");
    $fqty_checkout = isset($_POST["fqty_checkout"]) ? filter_var($_POST['fqty_checkout'], FILTER_SANITIZE_NUMBER_INT) : null;
    $forders_total = isset($_POST["forders_total"]) ? filter_var($_POST['forders_total'], FILTER_SANITIZE_NUMBER_INT) : null;
    $fcustomer = isset($_POST["fcustomer"]) ? filter_var($_POST['fcustomer'], FILTER_SANITIZE_STRING) : null;
    $fstatus = "invoiced";
    $faddress = isset($_POST["faddress"]) ? filter_var($_POST['faddress'], FILTER_SANITIZE_STRING) : "";
    $fdestination = !empty($_POST["faddress2"]) ? filter_var($_POST['faddress2'], FILTER_SANITIZE_STRING) : $faddress;
    $fshipping = isset($_POST["fcourier_checkout"]) ? filter_var($_POST['fcourier_checkout'], FILTER_SANITIZE_NUMBER_INT) : null;
    $fnotes = isset($_POST["fnotes"]) ? filter_var($_POST['fnotes'], FILTER_SANITIZE_STRING) : "";

    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    $sid = empty($_SESSION['isSession']) ? "" : md5($_SESSION['vcMail'].md5(" Belanja"));
    $query = "SELECT p.*, t.cart_id, t.cart_qty FROM products AS p "
        . "INNER JOIN tmp_orders AS t ON t.product_uniqid = p.product_uniqid "
        . "WHERE t.cart_uniqid = '$sid'";
    
    if( $database->num_rows( $query ) > 0 )
    {
        $results = $database->get_results( $query );
        foreach ($results AS $row){
            $fpid = $row["product_uniqid"];
            $fqty = (int) $row["cart_qty"];

            $price = $row["product_price"];

            $disc = $row["product_disc"];
            $disc_state = (int)$disc > 0 ? TRUE : FALSE;
            $discount = ((int)$disc/100)*$price;

            $subtotal = $fqty * ($price-$discount);
            $total = $total + $subtotal;
            
            $arrValueDetail = array(
                'order_uniqid' => $funiqid,
                'product_uniqid' => $fpid,
                'qty' => $fqty,
                'discount' => $discount,
                'subtotal' => $subtotal
            );
            
            $add_query_detail = $database->insert( 'orders_detail', $arrValueDetail );
        }
    }
    
    $arrValue = array(
        'order_uniqid' => $funiqid,
        'order_date' => $fdate,
        'order_qty' => $fqty_checkout,
        'order_subtotal' => $forders_total,
        'customer_uniqid' => $fcustomer,
        'order_status' => $fstatus,
        'destination' => $fdestination,
        'shipping_id' => $fshipping,
        'order_notes' => $fnotes
    );

    $add_query = $database->insert( 'orders', $arrValue );
    if( $add_query )
    {
        //delete tmp cart by session
        //Add the WHERE clauses
        $where_clause = array(
            'cart_uniqid' => $sid
        );
        //Query delete
        $deleted = $database->delete( 'tmp_orders', $where_clause);
        
        
        $url = $baseurl.'?page='.$furl;
        echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
        exit();
    }
}
?>