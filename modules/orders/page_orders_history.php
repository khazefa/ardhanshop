<?php
    $pagetitle = "Riwayat Transaksi";
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
?>
<div id="customer-orders" class="col-md-12">
  <p class="text-muted lead">Riwayat transaksi Anda.</p>
  <div class="box mt-0 mb-lg-0">
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Pesanan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $fcustomer = $_SESSION['vcUid'];
            //select orders from last 7 days
            $query = "SELECT * FROM orders WHERE customer_uniqid = '".$fcustomer."' AND order_date >= DATE(NOW()) - INTERVAL 7 DAY ORDER BY order_date DESC";
//            $query = "SELECT * FROM orders WHERE customer_uniqid = '".$fcustomer."' ORDER BY order_date DESC";
            $results = $database->get_results( $query );
            foreach( $results as $row )
            {
                $btn_paid = ($row["order_status"] == "invoiced") ? '<a href="?page=konfirmasi-pembayaran&key='.$row["order_uniqid"].'" class="btn btn-warning btn-sm">Bayar</a>' : '';
                echo '<tr>';
                    echo '<th>#'.$row["order_uniqid"].'</th>';
                    echo '<td>'.tgl_indo($row["order_date"]).'</td>';
                    echo '<td>Rp. '.format_IDR($row["order_subtotal"]).'</td>';
                    echo '<td>'. strtoupper($row["order_status"]).'</td>';
                    echo '<td>'
                        . '<a href="?page=detail-transaksi&key='.$row["order_uniqid"].'" class="btn btn-template-outlined btn-sm">Lihat</a> '
                        . $btn_paid
                    . '</td>';
                echo '</tr>';
            }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php
}
?>