<?php get_header(); ?>
<?php get_template_part( "menu-panel" ); ?>
<?php get_template_part( "masthead" ); ?>

<section id="latest">
  <div class="container">

    <article class="page">
      <h2><?php the_title(); ?></h2>
      <hr>
      <?php
      //The loop
      if ( have_posts() ){
        while ( have_posts()){
          the_post();
            ?>
            <p><?php the_content(); ?></p>
            <?php
      //End the loop
          };
        };
      ?>
    </article>

  </div>
</section>
<?php get_footer(); ?>
