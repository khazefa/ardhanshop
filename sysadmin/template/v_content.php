<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php
    // Checking if the string contains parent directory
    if (strstr($_GET['page'], '../') !== false) {
        throw new \Exception("Directory traversal attempt!");
    }

    // Checking remote file inclusions
    if (strstr($_GET['page'], 'file://') !== false) {
        throw new \Exception("Remote file inclusion attempt!");
    }

    $page_files = array( 
        'items'=>'modules/products/v_list.php',
        'items-cat'=>'modules/products-cat/v_list.php',
        'items-brand'=>'modules/products-brand/v_list.php',
        'customer-list'=>'modules/customers/v_list.php',
        'customer-orders'=>'modules/orders/v_list.php',
        'payment-list'=>'modules/payments/v_list.php',
        'bank-acc'=>'modules/bank-accounts/v_list.php',
        'courier-list'=>'modules/courier/v_list.php',
        'list-pages'=>'modules/pages/v_list.php',
        'list-banner'=>'modules/banner/v_list.php',
        'user-list'=>'modules/users/v_list.php',
        'dashboard'=>'modules/dashboard.php'
    );

    if (in_array($_GET['page'],array_keys($page_files))) {
        include $page_files[$_GET['page']];
    } else {
        include $page_files['dashboard'];
    }

    ?>

</div>	<!--/.main-->