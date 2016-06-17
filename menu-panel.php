<section id="menu">
  <i class="fa fa-times fa-2x"></i>
  <nav>
    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
  </nav>

  <nav>
    <?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
  </nav>

  <nav>
    <?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
  </nav>

</section>
