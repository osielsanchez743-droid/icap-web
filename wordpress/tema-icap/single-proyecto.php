<?php
declare(strict_types=1);
global $icap_contacto;
get_header();
?>
<section class="page-hero" aria-labelledby="page-title">
  <div class="shell">
    <p class="eyebrow">ICAP INGENIERÍA</p>
    <h1 id="page-title"><?php the_title(); ?></h1>
  </div>
</section>
<section class="section">
  <div class="shell">
    <?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
  </div>
</section>
<?php
get_footer();
