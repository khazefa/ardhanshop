<?php
    $pagetitle = "Edit Akun";

    $key = filter_var($_SESSION['vcMail'], FILTER_SANITIZE_EMAIL);
    $query = "SELECT * FROM customers WHERE customer_email = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $id, $uniqid, $name, $email, $phone, $address, $city, $postcode ) = $database->get_row( $query );
    }
?>

<div class="heading">
  <h2><?php echo $pagetitle; ?></h2>
</div>
<section class="bar pt-0">
  <div class="row">
    <div class="col-md-12">
        <form method="POST" action="?page=do_update_profile">
        <input type="hidden" name="fid" value="<?php echo $id;?>" readonly>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-6">
                    <input name="fname" id="fname" type="text" class="form-control" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input name="femail" id="femail" type="email" class="form-control" value="<?php echo $email;?>">
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
                <div class="col-sm-6">
                    <input name="fphone" id="fphone" type="text" class="form-control" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-5">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</section>