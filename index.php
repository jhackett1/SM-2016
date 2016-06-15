<?php get_header(); ?>

<section id="masthead">
  <!-- The website masthead and frontpage navigation -->
  <h1><?php bloginfo("name"); ?></h1>
  <hr>
  <h3><?php bloginfo("description"); ?></h3>
  <!-- <nav>
      <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
  </nav> -->

  <div id="container">
  	<a href="#">
  	<div class="bar">
  		<div class="color" id="one">
  			<h5>Views</h5>
  		</div>
  		<div class="spacer">
  		</div>
  	</div>
  	</a>
  		<a href="#">
  		<div class="bar">
  		<div class="color" id="two">
  			<h5>Culture</h5>
  		</div>
  		<div class="spacer">
  		</div>
  	</div>
  	</a>
  		<a href="#">
  		<div class="bar">
  		<div class="color" id="three">
  			<h5>Reviews</h5>
  		</div>
  		<div class="spacer">
  		</div>
  	</div>
  	</a>
  	<a href="#">
  	<div class="bar">
  		<div class="color" id="four">
  			<h5>Music</h5>
  		</div>
  		<div class="spacer">
  		</div>
  	</div>
  	</a>
  		<a href="#">
  		<div class="bar">
  		<div class="color" id="five">
  			<h5>Lifestyle</h5>
  		</div>
  		<div class="spacer">
  		</div>
  	</div>
  	</a>
  		<a href="#">
  		<div class="bar">
  		<div class="color" id="six">
  			<h5>Fashion</h5>
  		</div>
  		<div class="spacer">
  		</div>
  	</div>
  	</a>

  </div>

  <div id="bg" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/bg1.jpg)"></div>


</section>

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
          ?> <div class="post hero"> <?php
        } else {
          ?> <div class="post"> <?php
        };
          ?>
          <img src="<?php echo $feat; ?>" ?>
          <h5><?php the_category( ", " ); ?> | By <?php the_author(); ?></h5>
          <h3><?php the_title(); ?></h3>
          <hr>
          <p><?php the_excerpt(); ?></p>
        </div>

    <?php
    //Iterate the counter
    $counter++;
    //End the loop
        };
      };
    ?>
    </div>
  </div>
</section>

<section id="latest">
  <div class="container">

    <hr id="sides">
    <h2 id="divider">The latest</h2>

    <div class="postbox">
    <?php
    //Declares a counter variable, which will count only the first three posts
    //The loop
    if ( have_posts() ){
      while ( have_posts()){
        the_post();

        $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$feat = $feat[0];
          ?>
          <div class="post">
          <img src="<?php echo $feat; ?>" />
          <h5><?php the_category( ", " ); ?> | By <?php the_author(); ?></h5>
          <h3><?php the_title(); ?></h3>
          <hr>
          <p><?php the_excerpt(); ?></p>
        </div>
    <?php
    //End the loop
        };
      };
    ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
