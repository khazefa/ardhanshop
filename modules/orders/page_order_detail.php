<?php
    $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
    $pagetitle = "Detail Order #".$key;
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
<hr>
<?php
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $banks = array();
    $query = "SELECT o.order_id, o.order_uniqid, o.customer_uniqid, o.order_qty, o.order_subtotal, o.destination, s.shipping_dest, s.shipping_cost, o.order_status "
            . "FROM orders AS o "
            . "INNER JOIN shipping AS s ON o.shipping_id = s.shipping_id "
            . "WHERE o.order_uniqid = '$key' ";
if( $database->num_rows( $query ) > 0 )
{
    list( $id, $uniqid, $customer, $order_qty, $order_subtotal, $dest, $sdest, $scost, $status ) = $database->get_row( $query );
    $shippcost = $order_qty * $scost;
    $total = $order_subtotal + $scost;
    $total_qty = 0;
    
    if ($status=='invoiced'){
//        $sp = array(array('paid','Paid'),array('sent','Sent'),array('cancel','Cancel'));
        $sp = array(array('cancel','Cancel'));
    }
    elseif ($status=='paid'){
        $sp = array(array('sent','Sent'),array('cancel','Cancel'));
    }
    elseif ($status=='sent'){
        $sp = array(array('complete','Complete'));
    }
?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Produk</th>
                            <th></th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $qryp = "SELECT p.product_pict, p.product_name, od.qty, p.product_price, "
                                    . "od.discount, od.subtotal FROM orders_detail AS od "
                                    . "INNER JOIN products AS p "
                                    . "ON od.product_uniqid = p.product_uniqid "
                                    . "WHERE od.order_uniqid = '$key' ";
                            $results = $database->get_results( $qryp );
                            $no = 1;
                            foreach( $results as $row )
                            {
                                $img_path = UPLOADS_DIR . "products" . DIRECTORY_SEPARATOR;
                                $pict = !empty($row[product_pict]) ? "<img class='img-responsive' src='$img_path$row[product_pict]' width='100px'>" : "NO IMAGE";

                                $fdiscount = format_IDR($row["discount"]);
                                $total_qty = $total_qty + $row["qty"];
                                echo "<tr>";
                                    echo "<td class='text-center'>$pict</td>";
                                    echo "<td>$row[product_name]</td>";
                                    echo "<td>$row[qty]</td>";
                                    echo "<td>RP. ". format_IDR($row[product_price]) ."</td>";
                                    echo "<td>RP. ". $fdiscount ."</td>";
                                    echo "<td>RP. ". format_IDR($row[subtotal]) ."</td>";
                                echo "</tr>";
                            }
                            $fshipping_cost = $total_qty * $shippcost;
                            $ftotal = $total + $fshipping_cost;
                        ?>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <!--<label>Tujuan Pengiriman</label>-->
                        <table class="table">
                            <?php
                                $qryc = "SELECT customer_name, customer_email, customer_phone "
                                        . "FROM customers WHERE customer_uniqid = '$customer' ";
                                if( $database->num_rows( $qryc ) > 0 )
                                {
                                    list( $cname, $cmail, $cphone, $caddr, $ccity, $cpostcode ) = $database->get_row( $qryc );
                                }
                            ?>
                            <tr>
                                <td>Nama Penerima</td><td>: <?php echo $cname;?></td>
                            </tr>
                            <tr>
                                <td>Alamat Email</td><td>: <?php echo $cmail;?></td>
                            </tr>
                            <tr>
                                <td>No. Telepon</td><td>: <?php echo $cphone;?></td>
                            </tr>
                            <tr>
                                <td>Alamat Tujuan</td><td>: <?php echo $dest;?></td>
                            </tr>
                            <tr>
                                <td>Kota Tujuan</td><td>: <?php echo $sdest;?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td>Subtotal Order</td><td>: <?php echo "Rp. ".format_IDR($order_subtotal);?></td>
                            </tr>
                            <tr>
                                <td>Biaya Kirim</td><td>: <?php echo "Rp. ".format_IDR($fshipping_cost);?> <br>(Ongkir x (Total berat x Total Jumlah))</td>
                            </tr>
                            <tr>
                                <td>Total</td><td>: <?php echo "Rp. ".format_IDR($ftotal);?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='?page=riwayat-transaksi'"> Riwayat Transaksi</button>
            </div>
        </div>
    </div>
<?php
}
}
?>