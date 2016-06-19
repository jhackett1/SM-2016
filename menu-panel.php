<section id="menu">
  <i class="fa fa-times fa-2x"></i>
  <nav>
    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
  </nav>



  <nav class="mobileshow">
    <?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
  </nav>



  <nav>
    <hr>
    <?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
    <p class="mobilehide">© University of Westminster Students' Union <?php echo date("Y"); ?></p>
  </nav>

</section>
