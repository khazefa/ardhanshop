<?php
//require("includes/constants.php");
//require_once("includes/class.db.php");
//$database = DB::getInstance();
$ts = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: $ts");
header("Last-Modified: $ts");
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

$funame = isset($_POST["runame"]) ? filter_var($_POST['runame'], FILTER_SANITIZE_STRING) : null;
$fpass = isset($_POST["rpass"]) ? filter_var($_POST['rpass'], FILTER_SANITIZE_STRING) : null;
$fname = isset($_POST["rname"]) ? filter_var($_POST['rname'], FILTER_SANITIZE_STRING) : null;
$femail = isset($_POST["remail"]) ? filter_var($_POST['remail'], FILTER_SANITIZE_STRING) : null;

/**
 * Checking to see if a value exists
 */
$check_column = 'user_email';
$check_for = array( 'user_email' => $femail );
$exists = $database->exists( 'users', $check_column,  $check_for );
if( $exists )
{
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Alamat email sudah ada!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $arrValue = array(
        'user_keyname' => $femail,
        'user_keypass' => md5($fpass),
        'user_fullname' => $fname,
        'user_email' => $femail,
        'level_id' => 2,
        'user_status' => 1,
    );
    $add_query = $database->insert( 'users', $arrValue );
    if( $add_query )
    {
        $url = $baseurl.'?page=enroll';
        echo "<script type='text/javascript'>alert('Registrasi sukses!');window.location.href = '".$url."';</script>";
        exit();
    }
}
?>