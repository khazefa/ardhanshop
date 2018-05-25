    <!-- Navbar Start-->
    <header class="nav-holder make-sticky">
        <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
            <div class="container">
              <a href="<?php echo $baseurl; ?>" class="navbar-brand home"><img src="assets/img/logo.png" alt="logo" class="d-none d-md-inline-block"><img src="assets/img/logo-small.png" alt="logo" class="d-inline-block d-md-none"><span class="sr-only">go to homepage</span></a>
              <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
              <div id="navigation" class="navbar-collapse collapse">
                <ul class="nav navbar-nav ml-auto">
                  <li class="nav-item"><a href="<?php echo $baseurl; ?>">Home</a></li>
                  <!-- ========== About Us dropdown ==================-->
                  <!--
                  <li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">About Us <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item"><a href="profile.html" class="nav-link">Profile</a></li>
                      <li class="dropdown-item"><a href="vision.html" class="nav-link">Vision</a></li>
                    </ul>
                  </li>
                  -->
                  <!-- ========== About Us dropdown end ==================-->
                  <li class="nav-item"><a href="?page=produk">Produk</a></li>
                  <li class="nav-item"><a href="?page=static&q=tentang-kami">Tentang Kami</a></li>
                  <li class="nav-item"><a href="?page=static&q=cara-pembayaran">Cara Pembayaran</a></li>
                  <li class="nav-item"><a href="?page=kontak-kami">Kontak Kami</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item"><a href="?page=keranjang-belanja"><i class="fa fa-shopping-cart"></i> <span id="cart_total">0</span> - Items<b class="caret"></b></a></li>
                    <!--
                    <li class="nav-item dropdown">
                        <a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle"> <i class="fa fa-shopping-cart"></i> <span id="cart_total">7</span> - Items<b class="caret"></b></a>
                        <ul class="dropdown-menu" id="cart_items">
                            <div class="dropdown-divider"></div>
                            <li class="dropdown-item">
                                <a href="#" class="nav-link text-center">Keranjang Belanja</a>
                            </li>
                        </ul>
                    </li>
                    -->
                </ul>
              </div>
              <div id="search" class="collapse clearfix">
                <form role="search" class="navbar-form">
                  <div class="input-group">
                    <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                      <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </header>
    <!-- Navbar End-->