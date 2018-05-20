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

    if (!isset($_SESSION['isSession'])){
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