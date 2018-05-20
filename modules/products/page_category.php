<?php
    $key = htmlspecialchars((int)$_GET["seq"], ENT_QUOTES, 'UTF-8');
    $query = "SELECT category_id, category_name FROM products_category WHERE category_id = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $id, $name ) = $database->get_row( $query );
    }
?>

<div class="heading">
  <h2><?php echo $name; ?></h2>
</div>
<div class="row products products-big">
<?php
    $page = (int) (!isset($_GET["nav"]) ? 1 : $_GET["nav"]);
    $limit = 6;
    $startpoint = ($page * $limit) - $limit;
        
    $statement = "products WHERE category_id = '$key' ORDER BY product_id DESC";
    $query = "SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}";
    $results = $database->get_results( $query );
    foreach( $results as $row )
    {
        $fprice = format_IDR($row["product_price"]);
        $disc_state = (int)$row["product_disc"] > 0 ? TRUE : FALSE;
        $disc = ((int)$row["product_disc"]/100)*$row["product_price"];
        $disc_price = format_IDR(($row["product_price"]-$disc));
        
        $img_path = UPLOADS_DIR . 'products' . DIRECTORY_SEPARATOR;
        $pict = !empty($row["product_pict"]) ? '<img class="img-fluid image1" src="'.$img_path.$row["product_pict"].'" alt="'.nohtml($row["product_name"]).'">' : '<img src="http://placehold.it/450x450" alt="" class="img-fluid image1">';
        echo '<div class="col-lg-4 col-md-6">';
            echo '<div class="product">';
                echo '<div class="image"><a href="#">'.$pict.'</a></div>';
                echo '<div class="text">';
                echo '<h3 class="h5"><a href="#">'.nohtml($row["product_name"]).'</a></h3>';
                if($disc_state){
                    echo '<p class="price"><del>Rp. '.$fprice.'</del>Rp. '.$disc_price.'</p>';
                }else{
                    echo '<p class="price">Rp. '.$fprice.'</p>';
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
    echo '<div class="pages">';
        echo '<nav aria-label="Page navigation example" class="d-flex justify-content-center">';
        echo pagination2($statement,$key,$limit,$page);
        echo '</nav>';
    echo '</div>';
?>  
</div>