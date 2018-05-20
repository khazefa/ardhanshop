<?php
    $key = htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8');
    $query = "SELECT pg_title, pg_slug, pg_content, pg_publish FROM site_pages WHERE pg_slug = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $title, $slug, $content, $publish ) = $database->get_row( $query );
        $fcontent = nl2br(html_entity_decode($content), TRUE);
    }
?>

<div id="heading-breadcrumbs">
  <div class="container">
    <div class="row d-flex align-items-center flex-wrap">
      <div class="col-md-12">
        <h1 class="h2"><?php echo $title; ?></h1>
      </div>
    </div>
  </div>
</div>
<p class="lead">
    <?php echo $fcontent; ?>
</p>