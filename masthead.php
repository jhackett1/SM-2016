<section id="masthead">
  <div class="container">
    <!-- The website masthead and frontpage navigation -->

    <div id="menu-on"><i class="fa fa-bars"></i> Sections</div>

    <a href="<?php bloginfo("url"); ?>">

      <?php if ( get_theme_mod( 'themeslug_logo' ) ) : ?>
            <img src='<?php echo esc_url( get_theme_mod( 'themeslug_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
      <?php else : ?>
          <h1 id="site-title"><?php bloginfo('title'); ?></h1>
      <?php endif; ?>



    </a>

    <div id="search-button"><i class="fa fa-search"></i>Search</div>
  </div>
</section>

<div id="spacer"></div>
