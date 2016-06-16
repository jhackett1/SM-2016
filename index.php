<?php get_header(); ?>

<?php get_template_part( "masthead" ); ?>

<!-- A section displaying three featured posts -->
<section id="featured">
  <div class="container">
    <div class="postbox">
    <?php
    //Declares a counter variable, which will count only the first three posts
    $counter = 0;
    //The loop
    if ( have_posts() ){
      while ( have_posts() && $counter<3 ){
        the_post();

        $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$feat = $feat[0];

        //Apply hero class to first post
        if ($counter==0){
          ?>
          <div class="spacer">
            <div class="post hero">
              <div class="img" style="background-image:url(<?php echo $feat; ?>) "></div>
              <div class="meta">
                <h5><?php the_category( ", " ); ?> | By <?php the_author(); ?></h5>
                <h3><?php the_title(); ?></h3>
                <hr>
                <p><?php the_excerpt(); ?></p>
              </div>
            </div>
          </div>
            <?php
        } else {
          ?>
          <div class="sidebyside">
            <div class="post trail" style="background-image:url(<?php echo $feat; ?>) ">
              <div class="grad"></div>
              <h3><?php the_title(); ?></h3>
            </div>
          </div>
          <?php
        };
          ?>


    <?php
    //Iterate the counter
    $counter++;
    //End the loop
  };
      };
    ?>

    <div style="clear:both;"></div>

    </div>
  </div>
</section>

<section id="latest">
  <div class="container">

    <hr id="sides">
    <h2 id="divider">The latest</h2>



    <div class="postbox grid">
    <?php
    //The loop
    if ( have_posts() ){
      while ( have_posts()){
        the_post();

        //Establish a counter variable and stop the loop if the specified value is reached
        static $count = 0;
        if ($count == "20") { break; }
        else {

        $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$feat = $feat[0];
          ?>
          <div class="grid-item">
            <div class="post">
              <img src="<?php echo $feat; ?>" />
              <h5><?php the_category( ", " ); ?> | By <?php the_author(); ?></h5>
              <h3><?php the_title(); ?></h3>
              <hr>
              <p><?php the_excerpt(); ?></p>
            </div>
          </div>
    <?php
  };
    //Iterate the counter
    $count++;
    //End the loop
        };
      };
    ?>
    </div>
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
