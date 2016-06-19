<?php
get_header();
get_template_part( "menu-panel" );
get_template_part( "masthead" );

if ( have_posts() ){
  while( have_posts() ){
    the_post();

    $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $feat = $feat[0];
?>
<div class="container single">
  <article>
      <h3><?php the_category(); ?></h3>
      <h2><?php the_title(); ?></h2>
      <img src="<?php echo $feat; ?>"/>
      <h5><?php the_date();?> &middot; By <?php the_author_posts_link(); ?> &middot; <?php reading_time(); ?></h5>
      <hr>
      <div class="content">
        <p><?php the_content(); ?></p>
          <?php
        };
        }
        ?>
      </div>
          <?php comments_template( $file, $separate_comments ); ?>
  </article>
  <div class="sidebar">

    <?php get_template_part( "posts-widget" ); ?>

    <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar' ); ?>
    <?php endif; ?>
  </div>
</div>
<?php get_footer(); ?>
