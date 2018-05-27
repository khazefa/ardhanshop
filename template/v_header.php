<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo WEB_TITLE; ?></title>
    <meta name="description" content="<?php echo WEB_DESC; ?>">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="assets/vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- owl carousel-->
    <link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="assets/css/style.blue.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
  <div id="all">
      <!-- Top bar-->
      <div class="top-bar">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-md-6 d-md-block d-none">
              <p>Kontak kami di 021-9999999 atau email ke hello@domain.com</p>
            </div>
            <div class="col-md-6">
              <div class="d-flex justify-content-md-end justify-content-between">
                <ul class="list-inline contact-info d-block d-md-none">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul>
                <div class="login">
                    <?php
                    if (!isset($_SESSION['isSession'])){
                        ?>
                        <a href="#" data-toggle="modal" data-target="#login-modal" class="login-btn"><i class="fa fa-sign-in"></i><span class="d-none d-md-inline-block">Log In</span></a>
                        <a href="?page=enroll" class="signup-btn"><i class="fa fa-user"></i><span class="d-none d-md-inline-block">Registrasi</span></a>
                        <?php
                    }else{
                        ?>
                        <div class="dropdown show">
                            <a class="login-btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php echo $_SESSION['vcName'];?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="?page=profil-akun">Edit Akun</a>
                              <a class="dropdown-item" href="?page=riwayat-transaksi">Riwayat Transaksi</a>
                              <a class="dropdown-item" href="?page=konfirmasi-pembayaran">Konfirmasi Pembayaran</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <ul class="social-custom list-inline">
                  <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Top bar end-->
      <!-- Login Modal-->
      <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Login Pelanggan</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" action="?page=do_auth">
                <div class="form-group">
                  <input name="femail" id="femail_pop" type="text" placeholder="email" class="form-control">
                </div>
                <div class="form-group">
                  <input name="fpassword" id="fpassword_pop" type="password" placeholder="password" class="form-control">
                </div>
                <p class="text-center">
                  <button class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Log in</button>
                </p>
              </form>
              <p class="text-center text-muted">Belum terdaftar?</p>
              <p class="text-center text-muted"><a href="?page=enroll"><strong>Daftar sekarang</strong></a>!</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Login modal end-->