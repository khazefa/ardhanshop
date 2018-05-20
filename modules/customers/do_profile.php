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

    $fid = isset($_POST["fid"]) ? filter_var($_POST['fid'], FILTER_SANITIZE_STRING) : null;
    $fname = isset($_POST["fname"]) ? filter_var($_POST['fname'], FILTER_SANITIZE_STRING) : null;
    $femail = isset($_POST["femail"]) ? filter_var($_POST['femail'], FILTER_SANITIZE_STRING) : null;
    $faddress = isset($_POST["faddress"]) ? filter_var($_POST['faddress'], FILTER_SANITIZE_STRING) : null;
    $fphone = isset($_POST["fphone"]) ? filter_var($_POST['fphone'], FILTER_SANITIZE_STRING) : null;
    $fcity = isset($_POST["fcity"]) ? filter_var($_POST['fcity'], FILTER_SANITIZE_STRING) : null;
    $fpostcode = isset($_POST["fpostcode"]) ? filter_var($_POST['fpostcode'], FILTER_SANITIZE_STRING) : null;

    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    $update = array(
        'customer_name' => $fname,
        'customer_address' => $faddress,
        'customer_phone' => $fphone,
        'customer_city' => $fcity,
        'customer_postcode' => $fpostcode
    );
    //Add the WHERE clauses
    $where_clause = array(
        'customer_uniqid' => $fid
    );
    
    $updateU = array(
        'user_fullname' => $fname
    );
    //Add the WHERE clauses
    $where_clauseU = array(
        'user_email' => $femail
    );
    
    $updated = $database->update( 'customers', $update, $where_clause, 1 );
    if( $updated )
    {
        $updated2 = $database->update( 'users', $updateU, $where_clauseU, 1 );
        if( $updated2 ){
            $_SESSION['vcName'] = $fname;
            $url = $baseurl.'?page='.$furl;
            echo "<script type='text/javascript'>alert('Update sukses!');window.location.href = '".$url."';</script>";
            exit();
        }
    }
}
?>