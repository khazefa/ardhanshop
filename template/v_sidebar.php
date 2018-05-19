    <div class="col-md-3">
      <!-- MENUS AND FILTERS-->
      <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
          <h3 class="h4 panel-title">Kategori</h3>
        </div>
        <div class="panel-body">
          <ul class="nav nav-pills flex-column text-sm category-menu">
            <?php
                $query = "SELECT pc.category_name, COUNT(p.product_uniqid) AS Qty FROM products_category AS pc "
                        . "LEFT JOIN products AS p ON p.category_id = pc.category_id "
                        . "GROUP BY pc.category_name";
                $results = $database->get_results( $query );
                foreach( $results as $row )
                {
                    echo '<li class="nav-item"><a href="#" class="nav-link d-flex align-items-center justify-content-between"><span>'.nohtml($row["category_name"]).'</span> <span class="badge badge-secondary">'.(int)$row["Qty"].'</span></a></li>';
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
                $query = "SELECT pb.brand_name, COUNT(p.product_uniqid) AS Qty FROM products_brand AS pb "
                        . "LEFT JOIN products AS p ON p.brand_id = pb.brand_id "
                        . "GROUP BY pb.brand_name";
                $results = $database->get_results( $query );
                foreach( $results as $row )
                {
                    echo '<li class="nav-item"><a href="#" class="nav-link d-flex align-items-center justify-content-between"><span>'.nohtml($row["brand_name"]).'</span> <span class="badge badge-secondary">'.(int)$row["Qty"].'</span></a></li>';
                }
            ?>  
            
          </ul>
        </div>
      </div>
      <div class="banner"><a href="#"><img src="http://placehold.it/900x600" alt="sales 2014" class="img-fluid"></a></div>
    </div>