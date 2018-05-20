<?php
    $pagetitle = "REGISTRASI / LOG IN";
?>

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-12">
        <h1 class="h2"><?php echo $pagetitle; ?></h1>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-6">
      <div class="box">
        <h2 class="text-uppercase">Registrasi</h2>
        <p class="lead">Anda belum terdaftar?</p>
        <hr>
        <form action="#" method="post">
          <div class="form-group">
            <label for="rname">Nama Lengkap</label>
            <input name="rname" id="rname" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label for="remail">Email</label>
            <input name="remail" id="remail" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label for="rpassword">Password</label>
            <input name="rpassword" id="rpassword" type="password" class="form-control">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i> Daftar</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="box">
        <h2 class="text-uppercase">Login</h2>
        <p class="lead">Apakah anda pelanggan kami?</p>
        <hr>
        <form role="form" method="POST" action="digi_auth.php">
          <div class="form-group">
            <label for="femail">Email</label>
            <input name="femail" id="femail" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label for="fpassword">Password</label>
            <input name="fpassword" id="fpassword" type="password" class="form-control">
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log in</button>
          </div>
        </form>
      </div>
    </div>
</div>