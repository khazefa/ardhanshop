<?php
    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $key = htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8');
    $page = empty($_GET["q"]) ? "?" : $getpage."&q=".$key;
    $do_act = "cart.php";
    
    $query = "SELECT p.*, c.category_name, b.brand_name FROM products AS p "
            . "INNER JOIN products_category AS c ON p.category_id = c.category_id "
            . "INNER JOIN products_brand AS b ON p.brand_id = b.brand_id "
            . "WHERE p.product_uniqid = '$key'";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $id, $key, $category_id, $brand_id, $name, $desc, $price, $stock, $weight, $disc, $pict, $category, $brand ) = $database->get_row( $query );
        $pagetitle = $name;
        $funiqid = nohtml($key);
        $fprice = format_IDR($price);
        $disc_state = (int)$disc > 0 ? TRUE : FALSE;
        $discount = ((int)$disc/100)*$price;
        $disc_price = format_IDR(($price-$discount));
        $fdesc = nl2br(html_entity_decode($desc), TRUE);
        
        $img_path = UPLOADS_DIR . 'products' . DIRECTORY_SEPARATOR;
        $pict_src = !empty($pict) ? '<img class="img-fluid" src="'.$img_path.$pict.'" alt="'.nohtml($name).'">' : '<img src="http://placehold.it/600x800" alt="" class="img-fluid">';
    }
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

<div id="productMainC" class="row">
  <div class="col-sm-6 text-center mt-4">
    <?php echo $pict_src;?>
  </div>
  <div class="col-sm-6">
    <div class="box">
      <form action="<?php echo $do_act;?>?act=add" method="POST">
        <input type="hidden" name="fid" value="<?php echo $funiqid?>" readonly="readonly">
        <input type="hidden" name="furl" value="<?php echo $page;?>" readonly="readonly">
        <h3>Kategori: <?php echo '<a href="?page=kategori&seq='.$category_id.'">'.$category.'</a>'; ?></h3>
        <?php
            if($disc_state){
                echo '<p class="price"><del>Rp. '.$fprice.'</del><br>Rp. '.$disc_price.'</p>';
            }else{
                echo '<p class="price">Rp. '.$fprice.'</p>';
            }
        ?>
        
        <?php
            if($stock > 0){
                echo '<div class="col-md-4 mb-2">';
                    echo '<input type="number" name="fqty" class="form-control" value="1" required>';
                echo '</div>';
                echo '<div class="col-md-4 mb-2">';
                    echo '<button type="submit" class="btn btn-template-outlined"><i class="fa fa-shopping-cart"></i> Beli</button>';
                echo '</div>';
            }else{
                echo 'Stok Habis';
            }
        ?>
      </form>
    </div>
  </div>
</div>
<div id="details" class="box mb-4 mt-4">
  <h4>Detail Produk</h4>
  <?php
    echo $fdesc;
  ?>
  <p>Berat : <?php echo $weight." Kg";?></p>
<div class="row">
  <div class="col-lg-12">
    <div class="box text-uppercase mt-0 mb-small">
      <h3>Produk Terkait</h3>
    </div>
  </div>
<?php        
    $statement = "products WHERE (category_id = '$category_id' OR brand_id = '$brand_id') ORDER BY RAND()";
    $query = "SELECT * FROM {$statement} LIMIT 3";
    $results = $database->get_results( $query );
    foreach( $results as $row )
    {
        $funiqid = nohtml($row["product_uniqid"]);
        $fprice = format_IDR($row["product_price"]);
        $disc_state = (int)$row["product_disc"] > 0 ? TRUE : FALSE;
        $disc = ((int)$row["product_disc"]/100)*$row["product_price"];
        $disc_price = format_IDR(($row["product_price"]-$disc));
        
        $img_path = UPLOADS_DIR . 'products' . DIRECTORY_SEPARATOR;
        $pict = !empty($row["product_pict"]) ? '<img class="img-fluid image1" src="'.$img_path.$row["product_pict"].'" alt="'.nohtml($row["product_name"]).'">' : '<img src="http://placehold.it/450x450" alt="" class="img-fluid image1">';
        echo '<div class="col-lg-4 col-md-8">';
            echo '<div class="product">';
                echo '<div class="image"><a href="?page=produk-detail&q='.$funiqid.'">'.$pict.'</a></div>';
                echo '<div class="text">';
                echo '<h3 class="h5"><a href="?page=produk-detail&q='.$funiqid.'">'.nohtml($row["product_name"]).'</a></h3>';
                if($disc_state){
                    echo '<p class="price"><del>Rp. '.$fprice.'</del>Rp. '.$disc_price.'</p>';
                }else{
                    echo '<p class="price">Rp. '.$fprice.'</p>';
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
?>  
</div>