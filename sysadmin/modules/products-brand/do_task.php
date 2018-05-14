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

    // Save data
    if ($getpage == "items-brand" AND $getact == "save"){
        $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
        
        $arrValue = array(
            'brand_name' => $fname
        );
        $add_query = $database->insert( 'products_brand', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "items-brand" AND $getact == "update"){
        $fid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_NUMBER_INT) : 0;
        $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
        
        $update = array(
            'brand_name' => $fname
        );
        //Add the WHERE clauses
        $where_clause = array(
            'brand_id' => $fid
        );
        $updated = $database->update( 'products_brand', $update, $where_clause, 1 );
        if( $updated )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Delete data
    elseif ($getpage == "items-brand" AND $getact == "delete"){
        $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
        $where_clause = array(
            'brand_id' => $key
        );
        //Query delete
        $deleted = $database->delete( 'products_brand', $where_clause);
        if( $deleted )
        {
            header('location:../../?page='.$getpage);
        }
    }
}
?>