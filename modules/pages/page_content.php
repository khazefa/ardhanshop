<?php
    $key = htmlspecialchars($_GET["key"], ENT_QUOTES, 'UTF-8');
    $query = "SELECT pg_title, pg_slug, pg_content, pg_publish FROM site_pages WHERE pg_slug = '$key' ";
    if( $database->num_rows( $query ) > 0 )
    {
        list( $title, $slug, $content, $publish ) = $database->get_row( $query );
        $fcontent = nl2br($content, TRUE);
    }
?>

<div class="heading">
  <h2><?php echo $title; ?></h2>
</div>
<p class="lead">
    <?php echo $fcontent; ?>
</p>