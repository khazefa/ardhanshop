<?php
    $pagetitle = "Checkout";
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
    $sid = empty($_SESSION['isSession']) ? "" : md5($_SESSION['vcMail'].md5(" Belanja"));
    $couriers = array();
    $destinations = array();
        
    $query = "SELECT p.product_price, p.product_disc, p.product_weight, t.cart_qty FROM products AS p "
        . "INNER JOIN tmp_orders AS t ON t.product_uniqid = p.product_uniqid "
        . "WHERE t.cart_uniqid = '$sid'";
    if( $database->num_rows( $query ) > 0 )
    {
        $results = $database->get_results( $query );
        $total = 0;
        $total_weight = 0;
        $total_qty = 0;
        foreach( $results as $row )
        {
            $fqty = (int) $row["cart_qty"];
            $total_qty = $total_qty + $fqty;

            $price = $row["product_price"];
            $fprice = format_IDR($row["product_price"]);

            $disc = $row["product_disc"];
            $disc_state = (int)$disc > 0 ? TRUE : FALSE;
            $discount = ((int)$disc/100)*$price;
            $fdiscount = format_IDR($discount);
            $disc_price = format_IDR(($price-$discount));
            $weight = $row["product_weight"];
            $total_weight = ($total_weight + $weight) * $fqty;
            
            $subtotal = $fqty * ($price-$discount);
            $fsubtotal = format_IDR($subtotal);
            $total = $total + $subtotal;
            $ftotal = format_IDR($total);
        }
        
        $key = filter_var($_SESSION['vcMail'], FILTER_SANITIZE_EMAIL);
        $queryC = "SELECT * FROM customers WHERE customer_email = '$key' ";
        if( $database->num_rows( $queryC ) > 0 )
        {
            list( $id, $uniqid, $name, $email, $phone, $address, $city, $postcode ) = $database->get_row( $queryC );
        }
        
        $queryS = "SELECT DISTINCT shipping_courier FROM shipping ORDER BY shipping_courier";
        $results2 = $database->get_results( $queryS );
        foreach( $results2 as $row2 )
        {
            $couriers[] = $row2["shipping_courier"];
        }
        
        $queryD = "SELECT DISTINCT shipping_dest FROM shipping ORDER BY shipping_dest";
        $results3 = $database->get_results( $queryD );
        foreach( $results3 as $row3 )
        {
            $destinations[] = $row3["shipping_dest"];
        }
?>

<div id="checkout" class="row col-lg-12">

    <div class="col-lg-8">
    <form method="POST" action="?page=do_save_checkout">
    <input type="hidden" name="furl" value="riwayat-transaksi" readonly>
    <input type="hidden" name="fcustomer" id="fcustomer" value="<?php echo $uniqid;?>" readonly>
    <input type="hidden" name="fqty_checkout" id="fqty_checkout" value="<?php echo $total_qty;?>" readonly>
    <input type="hidden" name="fsubtotal_checkout" id="fsubtotal_checkout" value="<?php echo $total;?>" readonly>
    <input type="hidden" name="fweight_checkout" id="fweight_checkout" value="<?php echo $total_weight;?>" readonly>
    <input type="hidden" name="fshipping_cost" id="fshipping_cost">
    <input type="hidden" name="forders_total" id="forders_total">
    
    <div class="heading">
      <h3 class="text-muted">Alamat Tujuan Pengiriman</h3>
    </div>
    <div class="row">
      <div class="col-sm-8">
        <div class="form-group">
          <label for="fname">Nama Lengkap</label>
          <input name="fname" id="fname" type="text" class="form-control" value="<?php echo $name;?>" readonly>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="fphone">No. Telepon</label>
          <input name="fphone" id="fphone" type="text" class="form-control" value="<?php echo $phone;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <label for="faddress">Alamat Akun</label>
          <textarea name="faddress" id="faddress" class="form-control" readonly><?php echo nl2br($address);?></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <label for="faddress2">Alamat Tujuan Baru</label>
          <textarea name="faddress2" id="faddress2" class="form-control"></textarea>
          <small>Harap memilih kota tujuan sesuai dengan alamat tujuan anda.</small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-6">
        <div class="form-group">
          <label for="fcity_checkout">Kota Tujuan</label>
          <select name="fcity_checkout" id="fcity_checkout" class="form-control">
              <option value="0" selected>--</option>
              <?php
                foreach ($destinations AS $d){
                    echo '<option value="'.$d.'">'.$d.'</option>';
                }
              ?>
          </select>
        </div>
      </div>
      <div class="col-sm-8 col-md-4">
        <div class="form-group">
          <label for="fcourier_checkout">Kurir</label>
          <select name="fcourier_checkout" id="fcourier_checkout" class="form-control">
              <option value="0" selected>--</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <label for="fnotes">Catatan</label>
          <textarea name="fnotes" id="fnotes" class="form-control"></textarea>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-6"><a href="?page=keranjang-belanja" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i> Keranjang Belanja</a></div>
      <div class="col-sm-6">
        <button type="submit" class="btn btn-template-main"> Checkout<i class="fa fa-chevron-right"></i></button>
      </div>
    </div>
    
    </form>
    </div>
    <div class="col-lg-4">
      <div id="order-summary" class="p-0">
        <div class="box-header mt-0">
            <h3>Ringkasan pesanan</h3><hr>
        </div>
        <p class="text-muted text-small">Pengiriman dan biaya tambahan dihitung berdasarkan kota tujuan dan pilihan kurir Anda.</p>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td>Total Jumlah</td>
                <th><?php echo $total_qty; ?> Items</th>
              </tr>
              <tr>
                <td>Subtotal</td>
                <th>Rp. <?php echo $ftotal; ?></th>
              </tr>
              <tr>
                <td>Total Berat</td>
                <th><?php echo $total_weight; ?> Kg</th>
              </tr>
              <tr>
                <td>Ongkos Kirim</td>
                <th><span id="fshipping_cost_html">Rp. 0</span></th>
              </tr>
              <tr class="total">
                <td>Total</td>
                <th><span id="forders_total_html">Rp. 0</span></th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


</div>



<?php
    }else{
        echo '<div class="col-lg-12">';
            echo '<p class="text-muted lead">Keranjang belanja anda masih kosong.</p>';              
        echo '</div>';
    }
?>

<?php
}
?>