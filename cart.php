<?php
session_start();
require("includes/constants.php");
require('includes/class.db.php');
$database = DB::getInstance();
require("includes/common_helper.php");
require("includes/global_helper.php");

if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
//    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');
    $sid = empty($_SESSION['isSession']) ? "" : md5($_SESSION['vcName']." Belanja");
    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    // Add to cart
    if ($getact == "add"){
        $funiqid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_STRING) : null;
        $fqty = isset($_POST["fqty"]) ? filter_var($_POST['fqty'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $fcartuniq = $sid;
        $fcarttime = $tgl_sekarang." ".$jam_sekarang;
        
        $query = "SELECT 1 FROM tmp_orders "
                . "WHERE product_uniqid='$funiqid' AND cart_uniqid='$fcartuniq'";
        if( $database->num_rows( $query ) < 1 )
        {      
            $arrValue = array(
                'product_uniqid' => $funiqid,
                'cart_uniqid' => $fcartuniq,
                'cart_qty' => $fqty,
                'cart_time' => $fcarttime
            );

            $add_query = $database->insert( 'tmp_orders', $arrValue );
            if( $add_query )
            {
                $url = $baseurl.'?page='.$furl;
                echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
                exit();
            }
        }else{
            $arrValue = array(
                'cart_qty' => $fqty,
                'cart_time' => $fcarttime
            );
            //Add the WHERE clauses
            $arrWhere = array(
                'cart_uniqid' => $fcartuniq,
                'product_uniqid' => $funiqid
            );
            $updated = $database->update( 'tmp_orders', $arrValue, $arrWhere, 1 );
            if( $updated )
            {
                $url = $baseurl.'?page='.$furl;
                echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
                exit();
            }
        }
    }
    // Update to cart
    elseif ($getact == "update"){
        $funiqid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_STRING) : null;
        $fqty = isset($_POST["fqty"]) ? filter_var($_POST['fqty'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $fcartuniq = $sid;
        $fcarttime = $tgl_sekarang." ".$jam_sekarang;
        
        $arrValue = array(
            'cart_qty' => $fqty,
            'cart_time' => $fcarttime
        );
        //Add the WHERE clauses
        $arrWhere = array(
            'cart_uniqid' => $fcartuniq,
            'product_uniqid' => $funiqid
        );
        $updated = $database->update( 'tmp_orders', $arrValue, $arrWhere, 1 );
        if( $updated )
        {
            $url = $baseurl.'?page='.$furl;
            echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
            exit();
        }
    }
    // Delete to cart
    elseif ($getact == "delete"){
        $funiqid = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
        $fcartuniq = $sid;
        
        //Add the WHERE clauses
        $arrWhere = array(
            'cart_uniqid' => $fcartuniq,
            'product_uniqid' => $funiqid
        );
        //Query delete
        $deleted = $database->delete( 'tmp_orders', $where_clause);
        if( $deleted )
        {
            $url = $baseurl.'?page='.$furl;
            echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
            exit();
        }
    }
}
?>