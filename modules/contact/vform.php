<?php
    $pagetitle = "Kontak Kami";
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
<p class="lead">Untuk menjawab pertanyaan Anda lebih baik, Customer service kami akan dengan senang hati membantu anda menemukan produk ban murah.</p>
<section class="bar pt-0">
  <div class="row">
    <div class="col-md-12">
      <div class="heading text-center">
        <h2>Form Kontak</h2>
      </div>
    </div>
    <div class="col-md-8 mx-auto">
      <form method="POST" action="#">
        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="fname">Nama Anda</label>
              <input name="fname" id="fname" type="text" class="form-control">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="femail">Email</label>
              <input name="femail" id="femail" type="text" class="form-control">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="fsubject">Subject</label>
              <input name="fsubject" id="fsubject" type="text" class="form-control">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="fmessage">Message</label>
              <textarea name="fmessage" id="fmessage" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-template-outlined"><i class="fa fa-envelope-o"></i> Kirim</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>