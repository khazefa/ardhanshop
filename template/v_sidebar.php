    <div class="col-md-3">
      <!-- MENUS AND FILTERS-->
      <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
          <h3 class="h4 panel-title">Kategori</h3>
        </div>
        <div class="panel-body">
          <ul class="nav nav-pills flex-column text-sm category-menu">
            <?php
                $query = "SELECT pc.category_id, pc.category_name, COUNT(p.product_uniqid) AS Qty FROM products_category AS pc "
                        . "LEFT JOIN products AS p ON p.category_id = pc.category_id "
                        . "GROUP BY pc.category_name";
                $results = $database->get_results( $query );
                foreach( $results as $row )
                {
                    echo '<li class="nav-item"><a href="?page=kategori&seq='.(int)$row["category_id"].'" class="nav-link d-flex align-items-center justify-content-between"><span>'.nohtml($row["category_name"]).'</span> <span class="badge badge-secondary">'.(int)$row["Qty"].'</span></a></li>';
                }
            ?>  
            
          </ul>
        </div>
      </div>
      
      <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
          <h3 class="h4 panel-title">Brand</h3>
        </div>
        <div class="panel-body">
          <ul class="nav nav-pills flex-column text-sm category-menu">
            <?php
                $query = "SELECT pb.brand_id, pb.brand_name, COUNT(p.product_uniqid) AS Qty FROM products_brand AS pb "
                        . "LEFT JOIN products AS p ON p.brand_id = pb.brand_id "
                        . "GROUP BY pb.brand_name";
                $results = $database->get_results( $query );
                foreach( $results as $row )
                {
                    echo '<li class="nav-item"><a href="?page=merk&seq='.(int)$row["brand_id"].'" class="nav-link d-flex align-items-center justify-content-between"><span>'.nohtml($row["brand_name"]).'</span> <span class="badge badge-secondary">'.(int)$row["Qty"].'</span></a></li>';
                }
            ?>  
            
          </ul>
        </div>
      </div>
      <div class="heading">
        <h4>Big Sale</h4>
      </div>
      <div class="banner">
        <?php
            $statement = "products WHERE product_disc = (SELECT MAX(product_disc) FROM products) ORDER BY RAND()";
            $query = "SELECT * FROM {$statement} LIMIT 1";
            $results = $database->get_results( $query );
            foreach( $results as $row )
            {
                $funiqid = nohtml($row["product_uniqid"]);
                $fprice = format_IDR($row["product_price"]);
                $disc_state = (int)$row["product_disc"] > 0 ? TRUE : FALSE;
                $disc = ((int)$row["product_disc"]/100)*$row["product_price"];
                $disc_price = format_IDR(($row["product_price"]-$disc));

                $img_path = UPLOADS_DIR . 'products' . DIRECTORY_SEPARATOR;
                $pict = !empty($row["product_pict"]) ? '<img class="img-fluid" src="'.$img_path.$row["product_pict"].'" alt="'.nohtml($row["product_name"]).'">' : '<img src="http://placehold.it/900x600" alt="" class="img-fluid">';
                
                echo '<div class="col-lg-12 col-md-6">';
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
    </div>