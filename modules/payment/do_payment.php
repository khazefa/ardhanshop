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

    $random = rand(000000,999999);
    $forder = isset($_POST["forder"]) ? filter_var($_POST['forder'], FILTER_SANITIZE_STRING) : null;
    $fcustomer = $_SESSION['vcUid'];
    $fbank_id = isset($_POST["fbank_id"]) ? filter_var($_POST['fbank_id'], FILTER_SANITIZE_NUMBER_INT) : null;
    $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
    $faccount = isset($_POST["faccount"]) ? filter_var($_POST['faccount'], FILTER_SANITIZE_STRING) : null;
    $fbank_name = isset($_POST["fbank_name"]) ? filter_var($_POST['fbank_name'], FILTER_SANITIZE_STRING) : null;
    $date = isset($_POST["fdate"]) ? filter_var($_POST['fdate'], FILTER_SANITIZE_STRING) : "01/01/1900";
    $getdate = explode("/", $date);
    $day = $getdate[1];
    $month = $getdate[0];
    $year = $getdate[2];
    $fdate = $year."-".$month."-".$day;
    $fupload = $_FILES['fupload'];
    
    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    /**
     * Checking to see if a value exists
     */
    $check_column = 'order_uniqid';
    $check_for = array( 'order_uniqid' => $forder );
    $exists = $database->exists( 'orders', $check_column,  $check_for );
    if( $exists )
    {   
        $arrValue = array();
        
        if(empty($fupload['tmp_name'])){
            $arrValue = array(
                'order_uniqid' => $forder,
                'customer_uniqid' => $fcustomer,
                'bank_acc_id' => $fbank_id,
                'payment_account' => $faccount,
                'payment_name' => $fname,
                'payment_date' => $fdate,
                'payment_bank' => $fbank_name,
                'created_date' => date("Y-m-d"),
                'payment_status' => "verified"
            );
        }else{
            uploadFile($fupload, $random, "receipt");
            $arrValue = array(
                'order_uniqid' => $forder,
                'customer_uniqid' => $fcustomer,
                'bank_acc_id' => $fbank_id,
                'payment_account' => $faccount,
                'payment_name' => $fname,
                'payment_date' => $fdate,
                'payment_bank' => $fbank_name,
                'created_date' => date("Y-m-d"),
                'payment_attach' => $random.$fupload['name'],
                'payment_status' => "verified"
            );
        }

//        var_dump($arrValue);exit();
        
        $add_query = $database->insert( 'payment', $arrValue );
        if( $add_query )
        {
            $arrValue2 = array(
                'order_status' => "paid"
            );
            //Add the WHERE clauses
            $arrWhere = array(
                'order_uniqid' => $forder
            );
            $updated = $database->update( 'orders', $arrValue2, $arrWhere, 1 );
            
            $url = $baseurl.'?page=riwayat-transaksi';
            echo "<script type='text/javascript'>window.location.href = '".$url."';</script>";
            exit();
        }
    }else{
        $url = $baseurl.'?page='.$furl;
        echo "<script type='text/javascript'>alert('Nomor Order yang Anda input tidak ada di sistem kami.');window.location.href = '".$url."';</script>";
        exit();
    }
}
?>