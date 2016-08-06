<?php get_header(); ?>

<?php get_template_part( "menu-panel" ); ?>

<?php get_template_part( "masthead" ); ?>



<section id="latest">
  <div class="container">

    <h2 id="archives"><?php
      if (is_category()) {
        single_cat_title();
    		?></h2><?php
      }
      else if (is_tag()){
    		echo 'Topic: ';
        single_tag_title();
        ?></h2><?php
      }
      else if (is_year()){
        echo get_the_date();
        ?></h2><?php
      }
      else if (is_month()){
        echo get_the_date('F Y');
        ?></h2><?php
      }
      else if (is_year()){
        echo get_the_date('Y');
        ?></h2><?php
      }
      else {
        echo 'Archives';
        ?></h2><?php
      }
    ?></h2>
    <hr id="archives">


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
              <a class="cover" href="<?php the_permalink(); ?>"></a>
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
