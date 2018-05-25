<?php
session_start();
require("includes/constants.php");
require('includes/class.db.php');
$database = DB::getInstance();
require("includes/common_helper.php");

//if (empty($_SESSION['isSession'])){
//    $url = $baseurl.'?page=enroll';
//    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
//    exit();
//}else{
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');
//    $sid = md5("Joko Sukoco Belanja");
    $sid = empty($_SESSION['isSession']) ? "" : md5($_SESSION['vcName']." Belanja");
    
    // Cart Total
    if ($getact == "cart-total"){
        $query = "SELECT SUM(t.cart_qty) as qty_total FROM tmp_orders AS t "
                . "RIGHT JOIN products AS p ON t.product_uniqid = p.product_uniqid "
                . "WHERE t.cart_uniqid = '$sid'";
        if( $database->num_rows( $query ) > 0 )
        {
            list( $total ) = $database->get_row( $query );
        }else{
            $total = 0;
        }

        $val_arr = array('cart_total' => $total);

        echo json_encode($val_arr);
    }
    // Cart Items
    if ($getact == "cart-items"){
        $val_arr = array();
        $query_list = "SELECT t.product_uniqid, p.product_name FROM products AS p "
                . "INNER JOIN tmp_orders AS t ON p.product_uniqid = t.product_uniqid "
                . "WHERE t.cart_uniqid = '$sid'";
        $results = $database->get_results( $query_list );
        foreach( $results as $row )
        {
            $prodname = nohtml($row["product_name"]); 
            $name = substr($prodname,0,15); 
            $name = substr($prodname,0,strrpos($name," "));
            $val_arr[] = $name;
        }
        echo json_encode($val_arr);  
    }
//}
?>