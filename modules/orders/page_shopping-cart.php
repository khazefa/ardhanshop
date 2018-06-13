<?php
    $pagetitle = "Keranjang Belanja";
    $do_act = "cart.php";
?>

<div class="heading">
  <h2><?php echo $pagetitle; ?></h2>
</div>

<?php
if (empty($_SESSION['isSession'])){
    $url = $baseurl.'?page=enroll';
    echo "<script type='text/javascript'>alert('Harap login terlebih dahulu!');window.location.href = '".$url."';</script>";
    exit();
}else{
    $getpage = htmlspecialchars($_GET["page"], ENT_QUOTES, 'UTF-8');
    $sid = empty($_SESSION['isSession']) ? "" : md5($_SESSION['vcMail'].md5(" Belanja"));
    $query = "SELECT p.*, t.cart_id, t.cart_qty FROM products AS p "
        . "INNER JOIN tmp_orders AS t ON t.product_uniqid = p.product_uniqid "
        . "WHERE t.cart_uniqid = '$sid'";
    if( $database->num_rows( $query ) > 0 )
    {
        $results = $database->get_results( $query );
    
?>
    <div id="basket" class="col-lg-12">
      <div class="box mt-0 pb-0 no-horizontal-padding">
        <form method="POST" action="<?php echo $do_act;?>?act=update-all">
        <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly="readonly">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2">Produk</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Diskon</th>
                  <th colspan="2">Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $total = 0;
                    foreach( $results as $row )
                    {
                        $title = $row["product_name"];
                        $fid = (int)$row["cart_id"];
                        $funiqid = nohtml($row["product_uniqid"]);
                        $fqty = (int) $row["cart_qty"];
                        
                        $price = $row["product_price"];
                        $fprice = format_IDR($row["product_price"]);
                        
                        $disc = $row["product_disc"];
                        $disc_state = (int)$disc > 0 ? TRUE : FALSE;
                        $discount = ((int)$disc/100)*$price;
                        $fdiscount = format_IDR($discount);
                        $disc_price = format_IDR(($price-$discount));
                        
                        $subtotal = $fqty * ($price-$discount);
                        $fsubtotal = format_IDR($subtotal);
                        $total = $total + $subtotal;
                        $ftotal = format_IDR($total);

                        $pict = $row["product_pict"];
                        $img_path = UPLOADS_DIR . 'products' . DIRECTORY_SEPARATOR;
                        $pict_src = !empty($pict) ? '<img class="img-fluid" src="'.$img_path.$pict.'" alt="'.nohtml($title).'">' : '<img src="http://placehold.it/50x50" alt="" class="img-fluid">';   
                        
                        echo '<tr>';
                            echo '<td><a href="?page=produk-detail&q='.$funiqid.'">'.$pict_src.'</a></td>';
                            echo '<td><a href="?page=produk-detail&q='.$funiqid.'">'.$title.'</a></td>';
                            echo '<td>';
                                echo '<input type="hidden" name="fid[]" value="'.$fid.'">';
                                echo '<input type="hidden" name="fuid[]" value="'.$funiqid.'">';
                                echo '<input type="text" name="fqty[]" value="'.$fqty.'" class="col-sm-5" pattern="\d*">';
                            echo '</td>';
                            echo '<td>Rp. '.$fprice.'</td>';
                            echo '<td>Rp. '.$fdiscount.'</td>';
                            echo '<td>Rp. '.$fsubtotal.'</td>';
                            echo '<td><a href="'.$do_act.'?act=delete&key='.$fid.'"><i class="fa fa-trash-o"></i></a></td>';
                        echo '</tr>';
                    }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="5">Total</th>
                  <th colspan="2">Rp. <?php echo $ftotal; ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="box-footer d-flex justify-content-between align-items-center">
            <div class="left-col"><a href="?page=produk" class="btn btn-secondary mt-0"><i class="fa fa-chevron-left"></i> Lanjutkan belanja</a></div>
            <div class="right-col">
                <button type="submit" name="submit" class="btn btn-secondary"><i class="fa fa-refresh"></i> Update cart</button>
                <button type="button" class="btn btn-template-outlined" onclick="window.location.href='?page=checkout'">Checkout <i class="fa fa-chevron-right"></i></button>
            </div>
          </div>
        </form>
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