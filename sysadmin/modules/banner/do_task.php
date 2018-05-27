<?php
session_start();
$isLoggedIn = $_SESSION['isLoggedin'];

if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
    header('HTTP/1.1 403 Forbidden.', TRUE, 403);
    echo 'You dont have permissions to access this page! <a href="javascript:history.back()">Back</a>';
    exit(1); // EXIT_ERROR
}else{
    require("../../../includes/constants.php");
    require("../../../includes/common_helper.php");
    require_once("../../../includes/class.db.php");
//    include("../../../includes/verot_upload/class.upload.php");
    $database = DB::getInstance();

    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $getact = htmlspecialchars($_GET["act"], ENT_QUOTES, 'UTF-8');

    // Save data
    if ($getpage == "list-banner" AND $getact == "save"){
        $random = rand(000000,999999);
        $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
//        $fdesc = isset($_POST["fdesc"]) ? filter_var($_POST['fdesc'], FILTER_SANITIZE_STRING) : null;
        $fdesc = isset($_POST["fdesc"]) ? $_POST['fdesc'] : null;
        $fposition = isset($_POST["fposition"]) ? filter_var($_POST['fposition'], FILTER_SANITIZE_STRING) : null;
        $fupload = $_FILES['fupload'];
        
        $arrValue = array();
        
        if(empty($fupload['tmp_name'])){
            $arrValue = array(
                'banner_title' => $fname,
                'banner_desc' => $fdesc,
                'banner_position' => $fposition
            );
        }else{
            uploadFile($fupload, $random, "images");
            $arrValue = array(
                'banner_title' => $fname,
                'banner_desc' => $fdesc,
                'banner_position' => $fposition,
                'banner_pict' => $random.$fupload['name']
            );
        }

        $add_query = $database->insert( 'banner', $arrValue );
        if( $add_query )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Update data
    elseif ($getpage == "list-banner" AND $getact == "update"){
        $random = rand(000000,999999);
        $fkey = isset($_POST["fkey"]) ? filter_var($_POST['fkey'], FILTER_SANITIZE_STRING) : null;
        $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
//        $fdesc = isset($_POST["fdesc"]) ? filter_var($_POST['fdesc'], FILTER_SANITIZE_STRING) : null;
        $fdesc = isset($_POST["fdesc"]) ? $_POST['fdesc'] : null;
        $fposition = isset($_POST["fposition"]) ? filter_var($_POST['fposition'], FILTER_SANITIZE_STRING) : null;
        $fupload = $_FILES['fupload'];
        
        $arrValue = array();
        
        if(empty($fupload['tmp_name'])){
            $arrValue = array(
                'banner_title' => $fname,
                'banner_desc' => $fdesc,
                'banner_position' => $fposition
            );
        }else{
            uploadFile($fupload, $random, "images");
            $arrValue = array(
                'banner_title' => $fname,
                'banner_desc' => $fdesc,
                'banner_position' => $fposition,
                'banner_pict' => $random.$fupload['name']
            );
        }
        
        //Add the WHERE clauses
        $arrWhere = array(
            'banner_id' => $fkey
        );
        $updated = $database->update( 'banner', $arrValue, $arrWhere, 1 );
        if( $updated )
        {
            header('location:../../?page='.$getpage);
        }
    }
    // Delete data
    elseif ($getpage == "list-banner" AND $getact == "delete"){
        $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
        $query = "SELECT banner_pict FROM banner WHERE banner_id = '$key' ";
        //Add the WHERE clauses
        $where_clause = array(
            'banner_id' => $key
        );
        if( $database->num_rows( $query ) > 0 )
        {
            list( $pict ) = $database->get_row( $query );
        }
        if (!empty($pict)){
            //Query delete
            $deleted = $database->delete( 'banner', $where_clause);
            if( $deleted )
            {
                unlink("../../../uploads/images/$pict");
            }
             
        }
        else{
            //Query delete
            $deleted = $database->delete( 'banner', $where_clause);
        }
        header('location:../../?page='.$getpage);
    }
}
?>