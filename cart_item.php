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
    $sid = empty($_SESSION['isSession']) ? "" : md5($_SESSION['vcMail'].md5(" Belanja"));
    
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
    elseif ($getact == "cart-items"){
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
    // Retrieve Courier
    elseif ($getact == "load-courier"){
        $val_arr = array();
        //get shipping list
        $fcity = htmlspecialchars($_GET["fcity"], ENT_QUOTES, 'UTF-8');
        $query = "SELECT s.shipping_id, s.shipping_courier FROM shipping AS s "
                . "WHERE s.shipping_dest = '$fcity'";
        if( $database->num_rows( $query ) > 0 )
        {
            $results = $database->get_results( $query );
            foreach( $results as $row )
            {
                $r["shipp_id"] = (int)$row["shipping_id"];
                $r["shipp_courier"] = nohtml($row["shipping_courier"]);
                $val_arr[] = $r;
            }
        }else{
            $val_arr = array();
        }
        
        echo json_encode($val_arr);
    }
    // Shipping Total
    elseif ($getact == "shipping-total"){
        $val_arr = array();
        //get shipping list
        $fcourier = htmlspecialchars($_GET["fcourier"], ENT_QUOTES, 'UTF-8');
        $fsubtotal = (int)$_GET["fsubtotal"];
        $fweight = (int)$_GET["fweight"];
        
        $query = "SELECT shipping_cost FROM shipping "
                . "WHERE shipping_id = '$fcourier'";
        if( $database->num_rows( $query ) > 0 )
        {
            list( $cost ) = $database->get_row( $query );
            $fcost = $cost * $fweight;
            $cost_rp = "Rp. ".format_IDR($fcost);
            $total = $fsubtotal + $fcost;
            $total_rp = "Rp. ".format_IDR($total);
            
            $val_arr = array('shipp_cost' => $fcost, 'shipp_cost_rp' => $cost_rp, 
                'orders_total' => $total, 'orders_total_rp' => $total_rp);
        }else{
            $val_arr = array();
        }
        
        echo json_encode($val_arr);
    }
    else{
        $url = $baseurl;
        echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
        exit();
    }
//}
?>