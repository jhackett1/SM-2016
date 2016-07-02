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

<section class="related-pane mobilehide">
  <div class="container">
  <h3>Read next</h3>
  <hr>

  <div class="related-postbox">
  <?php
  // Related posts query
  $orig_post = $post;
  global $post;
  $categories = get_the_category($post->ID);
  if ($categories) {
  $category_ids = array();
  foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
  $args = array(
    'category__in' => $category_ids,
    'post__not_in' => array($post->ID),
    'posts_per_page'=> 4, // Number of related posts that will be displayed.
    'caller_get_posts'=>1,
    'orderby'=>'post_date' // Randomize the posts
  );
  $related_query = new WP_Query( $args );
  if ( $related_query->have_posts() ):
      while ( $related_query->have_posts() ): $related_query->the_post();
   $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'small' );
  $feat = $feat[0];
      ?>
        <div class="tile">
            <img src="<?php echo $feat; ?>"/>
            <div>
              <p><?php the_date(); ?></p>
              <h5><?php the_title(); ?></h5>

            </div>
            <a href="<?php the_permalink(); ?>"></a>
        </div>
      <?php endwhile;
      wp_reset_postdata();
    else : ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif;  }; ?>

</div>



  </div>
</section>

<?php get_footer(); ?>
