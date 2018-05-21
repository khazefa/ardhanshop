<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<p class="text-muted lead">Selamat datang, kami menawarkan produk-produk terbaik. Silahkan menghubungi kami jika Anda memiliki kesulitan dalam memilih produk yang tepat untuk Anda.</p>
<div class="row products products-big">
<?php
    $statement = "products ORDER BY product_id";
    $query = "SELECT * FROM {$statement} LIMIT 6";
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
        echo '<div class="col-lg-4 col-md-6">';
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