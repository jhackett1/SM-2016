<?php get_header(); ?>

<?php get_template_part( "menu-panel" ); ?>

<?php get_template_part( "masthead" ); ?>

<section id="latest">
  <div class="container">
    <h2 id="archives">Results: <span><?php echo $s; ?></span></h2>
    <hr id="archives">

    <h5><?php
    global $search_query;
    $total_results = $wp_query->found_posts;
    ?></h5>

    <div class="postbox grid">
    <?php
    //The loop

    $s=get_search_query();
    $args = array(
    's' =>$s
    );
    // The Query
    $search_query = new WP_Query( $args );

    if ( $search_query->have_posts() ) {
    	while ( $search_query->have_posts() ) {
    		$search_query->the_post();

        $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $feat = $feat[0];
        ?>

    <div class="grid-item">
      <div class="post">
        <a class="cover" href="<?php the_permalink(); ?>"></a>
        <img src="<?php echo $feat; ?>" />
        <h5><?php the_category( ", " ); ?> | By <?php the_author(); ?></h5>
        <h3><?php the_title(); ?></h3>
        <hr>
        <p><?php the_excerpt(); ?></p>
      </div>
    </div>

<?php
    	}
    } else {
    	// no posts found
      echo "<p id='noresults'>No results found! Try a broader query</p>";
    }
    /* Restore original Post Data */
    wp_reset_postdata();

    ?>
    </div>
  </div>
  <div class="pagination">
    <?php previous_posts_link( '<i class="fa fa-caret-left"></i> Newer articles' ); ?>
    <?php next_posts_link( 'Older articles <i class="fa fa-caret-right"></i>' ); ?>
  </div>
</section>

<script>
 window.onload = function () {
jQuery('.grid').masonry({
// options
itemSelector: '.grid-item',
itemSelector: '.grid-item',
percentPosition: true
});
}
</script>

<?php get_footer(); ?>
