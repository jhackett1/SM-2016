<?php get_header(); ?>

<?php get_template_part( "menu-panel" ); ?>

<?php get_template_part( "masthead" ); ?>

<?php
  if ( have_posts() ){
    while( have_posts() ){
      the_post();

      $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$feat = $feat[0];

      ?>

        <section class="single-header">
          <div class="meta">
            <div class="container">
              <h3><?php the_category(); ?></h3>
              <h2><?php the_title(); ?></h2>
            </div>
          </div>
          <div class="img" style="background-image:url(<?php echo $feat; ?>) "></div>
        </section>

        <article>
          <div class="container">

            <h5><?php the_date();?> | By <?php the_author(); ?></h5>
            <p><?php the_content(); ?></p>
          </div>
        </article>

      <?php
  };
  }

?>

<?php get_footer(); ?>
