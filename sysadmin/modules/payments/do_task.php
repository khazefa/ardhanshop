<?php
session_start();
$isLoggedIn = $_SESSION['isLoggedin'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    require("../../../includes/constants.php");
    require_once("../../../includes/class.db.php");
    $database = DB::getInstance();

    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');

    // Update data
    if ($getpage == "payment-list" AND $getact == "update"){
        $fid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $fkey = isset($_POST["fkey"]) ? filter_var($_POST['fkey'], FILTER_SANITIZE_STRING) : null;
        $fstatus = isset($_POST["fstatus"]) ? filter_var($_POST['fstatus'], FILTER_SANITIZE_STRING) : null;
        
        $update = array(
            'payment_status' => $fstatus
        );
        //Add the WHERE clauses
        $where_clause = array(
            'payment_id' => $fid
        );
        
        $update_order = array(
            'order_status' => 'paid'
        );
        //Add the WHERE clauses
        $where_clause_order = array(
            'order_uniqid' => $fkey
        );
        $updated = $database->update( 'payment', $update, $where_clause, 1 );
        if( $updated )
        {
            $updated_order = $database->update( 'orders', $update_order, $where_clause_order, 1 );
            if( $updated_order ){
                header('location:../../?page='.$getpage);
            }
        }
    }

}
?>