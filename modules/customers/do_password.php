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
    $fnew_password = isset($_POST["fnew_password"]) ? filter_var($_POST['fnew_password'], FILTER_SANITIZE_STRING) : null;
    $fnewr_password = isset($_POST["fnewr_password"]) ? filter_var($_POST['fnewr_password'], FILTER_SANITIZE_STRING) : null;

    $furl = isset($_POST["furl"]) ? filter_var($_POST['furl'], FILTER_SANITIZE_STRING) : null;
    
    if (strcmp($fnew_password, $fnewr_password) !== 0){
        echo "<script type='text/javascript'>alert('Konfirmasi password tidak sama!');window.history.back();</script>";
        exit();
    }else{
        $update = array(
            'user_keypass' => md5($fnewr_password)
        );
        //Add the WHERE clauses
        $where_clause = array(
            'user_keyname' => $fid
        );
        $updated = $database->update( 'users', $update, $where_clause, 1 );
        if( $updated )
        {
            $url = $baseurl.'?page='.$furl;
            echo "window.location.href = '".$url."';</script>";
            exit();
        }
    }
}
?>