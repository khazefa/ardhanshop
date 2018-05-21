<?php
    $sid = md5("Joko Sukoco Belanja");
    $query = "SELECT SUM(t.cart_qty) as qty_total FROM tmp_orders AS t "
            . "RIGHT JOIN products AS p ON t.product_uniqid = p.product_uniqid";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $total ) = $database->get_row( $query );
    }
    
    $query_list = "SELECT p.product_name FROM products AS p "
            . "INNER JOIN tmp_orders AS t ON p.product_uniqid = t.product_uniqid "
            . "WHERE t.cart_uniqid = '$sid'";
    $results = $database->get_results( $query );
    foreach( $results as $row )
    {
        echo '<li class="dropdown-item">';
            echo '<span class="nav-link">';
            echo '<span class="pull-left"><b>'.nohtml($row["product_name"]).'</b></span>';
            echo '<span class="pull-right"><button class="btn btn-sm btn-danger">x</button></span>';
            echo '</span>';
        echo '</li>';
    }
    
//    $sql = mysql_query("SELECT SUM(jumlah*(harga-(diskon/100)*harga)) as total,SUM(jumlah) as totaljumlah FROM orders_temp, produk 
//                                    WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
	
    //$disc        = ($r[diskon]/100)*$r[harga];
    //$subtotal    = ($r[harga]-$disc) * $r[jumlah];
?>