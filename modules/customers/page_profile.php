<?php
    $pagetitle = "Edit Akun";

    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $key = filter_var($_SESSION['vcMail'], FILTER_SANITIZE_EMAIL);

?>
<div class="heading">
  <h2><?php echo $pagetitle; ?></h2>
</div>
<?php
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $query = "SELECT * FROM customers WHERE customer_email = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $id, $uniqid, $name, $email, $phone, $address, $city, $postcode ) = $database->get_row( $query );
    }
?>
<section class="bar pt-0">
  <div class="row">
    <div class="col-md-12">
        <form method="POST" action="?page=do_update_profile">
        <input type="hidden" name="fid" value="<?php echo $uniqid;?>" readonly>
        <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-6">
                    <input name="fname" id="fname" type="text" class="form-control" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input name="femail" id="femail" type="email" class="form-control" value="<?php echo $email;?>" readonly="readonly">
                    <small>alamat email tidak dapat diganti</small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-6">
                    <textarea name="faddress" id="faddress" class="form-control"><?php echo nl2br($address);?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No. Telepon</label>
                <div class="col-sm-3">
                    <input name="fphone" id="fphone" type="text" class="form-control" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kota</label>
                <div class="col-sm-6">
                    <input name="fcity" id="fcity" type="text" class="form-control" value="<?php echo $city;?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Pos</label>
                <div class="col-sm-2">
                    <input name="fpostcode" id="fpostcode" type="text" class="form-control" value="<?php echo $postcode;?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8 text-right">
                    <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</section>
<div class="box mt-0">
<div class="heading">
  <h3 class="text-uppercase">Ganti password</h3>
</div>
<form method="POST" action="?page=do_update_password">
<input type="hidden" name="fid" value="<?php echo $_SESSION['vcUser'];?>" readonly>
<input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="fnew_password">Password baru</label>
        <input name="fnew_password" id="fnew_password" type="password" class="form-control">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="fnewr_password">Ulangi password baru</label>
        <input name="fnewr_password" id="fnewr_password" type="password" class="form-control">
      </div>
    </div>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> Update</button>
  </div>
</form>
</div>
<?php
}
?>