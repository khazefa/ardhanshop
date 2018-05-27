<?php
    $pagetitle = "Konfirmasi Pembayaran";
    $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
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
?>
<div class="row col-lg-12">

    <div class="col-lg-12">
    <form method="POST" action="?page=do_save_payment" enctype="multipart/form-data">
    <input type="hidden" name="furl" value="<?php echo $getpage;?>" readonly>

    <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="forder">No Order</label>
          <input name="forder" id="forder" type="text" value="<?php echo $key;?>" class="form-control" required="required">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="fbank_id">Rekening Tujuan</label>
          <select name="fbank_id" class="form-control" required="required">
                <option value="0" selected>--</option>
                <?php
                    $query = "SELECT * FROM bank_acc ORDER BY bank_acc_bank";
                    $results = $database->get_results( $query );
                    foreach( $results as $row )
                    {
                        $detail = $row["bank_acc_bank"]." (".$row["bank_acc_no"]." - ".$row["bank_acc_name"].")";
                        echo '<option value="'.$row["bank_acc_id"].'">'.$detail.'</option>';
                        $banks[] = $row["bank_acc_bank"];
                    }
                ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="fname">Atas Nama</label>
          <input name="fname" id="fname" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="faccount">No Rekening</label>
          <input name="faccount" id="faccount" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <label for="fbank_name">Bank</label>
          <select name="fbank_name" id="fbank_name" class="form-control" required="required">
              <option value="0" selected>--</option>
              <?php
                foreach ($banks AS $d){
                    echo '<option value="'.$d.'">'.$d.'</option>';
                }
              ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="fdate">Tanggal Bayar</label>
          <input type="date" name="fdate" id="fdate" class="form-control" required="required" pattern="dd/mm/yyyy">
        </div>
      </div>
      <div class="col-sm-8">
        <div class="form-group">
          <label for="fupload">Upload Bukti</label>
          <input type="file" name="fupload" id="fupload" class="form-control" required="required" title="Harap melampirkan bukti pembayaran">
          <small>Harap melampirkan bukti pembayaran agar pemesanan Anda dapat segera kami proses secepatnya.</small>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <button type="submit" class="btn btn-template-main"> Kirim<i class="fa fa-chevron-right"></i></button>
        </div>
    </div>
    
    </form>
    </div>
</div>
<?php
}
?>