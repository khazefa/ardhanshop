<div id="content">
  <div class="container">
    <div class="row bar">
    <?php
    include("template/v_sidebar.php");
    ?>
    <div class="col-md-9">
    <?php
    // Checking if the string contains parent directory
    if (strstr($_GET['page'], '../') !== false) {
        throw new \Exception("Directory traversal attempt!");
    }

    // Checking remote file inclusions
    if (strstr($_GET['page'], 'file://') !== false) {
        throw new \Exception("Remote file inclusion attempt!");
    }

    if (empty($_SESSION['isSession'])){
        $page_files = array( 
            'produk'=>'modules/products/page_products.php',
            'produk-detail'=>'modules/products/product_detail.php',
            'kategori'=>'modules/products/page_category.php',
            'merk'=>'modules/products/page_brand.php',
            'static'=>'modules/pages/page_content.php',
            'kontak-kami'=>'modules/contact/vform.php',
            'enroll'=>'modules/customers/page_enroll.php',
            'do_registrasi'=>'modules/customers/do_register.php',
            'do_auth'=>'digi_auth.php',
            'profil-akun'=>'modules/customers/page_enroll.php',
            'do_update_profile'=>'modules/customers/page_enroll.php',
            'do_update_password'=>'modules/customers/page_enroll.php',
            'cart'=>'modules/customers/page_enroll.php',
            'keranjang-belanja'=>'modules/customers/page_enroll.php',
            'checkout'=>'modules/customers/page_enroll.php',
            'do_save_checkout'=>'modules/customers/page_enroll.php',
            'riwayat-transaksi'=>'modules/customers/page_enroll.php',
            'home'=>'modules/home.php'
        );
    }else{
        $page_files = array( 
            'produk'=>'modules/products/page_products.php',
            'produk-detail'=>'modules/products/product_detail.php',
            'kategori'=>'modules/products/page_category.php',
            'merk'=>'modules/products/page_brand.php',
            'static'=>'modules/pages/page_content.php',
            'kontak-kami'=>'modules/contact/vform.php',
            'enroll'=>'modules/customers/page_enroll.php',
            'profil-akun'=>'modules/customers/page_profile.php',
            'do_update_profile'=>'modules/customers/do_profile.php',
            'do_update_password'=>'modules/customers/do_password.php',
            'cart'=>'cart.php',
            'keranjang-belanja'=>'modules/orders/page_shopping-cart.php',
            'checkout'=>'modules/orders/page_checkout.php',
            'do_save_checkout'=>'modules/orders/do_checkout.php',
            'riwayat-transaksi'=>'modules/orders/page_orders_history.php',
            'home'=>'modules/home.php'
        );
    }

    if (in_array($_GET['page'],array_keys($page_files))) {
        include $page_files[$_GET['page']];
    } else {
        include $page_files['home'];
    }

    ?>
    </div>
        
    </div>
  </div>
</div>