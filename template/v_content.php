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

    $page_files = array( 
        'items'=>'modules/products/items.php',
        'pages'=>'modules/pages/page_content.php',
        'home'=>'modules/home.php'
    );

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