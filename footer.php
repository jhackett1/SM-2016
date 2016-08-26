<footer>
  <div class="container">
    <hr>
    <nav>
      <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
    </nav>

    <p>© University of Westminster Students' Union <?php echo date("Y"); ?> &middot; Developed by <a href="http://joshuahackett.com">Joshua Hackett</a></p>

    <a href="http://uwsu.com" target="blank"><img id="union-logo" src="<?php echo get_template_directory_uri(); ?>/img/uwsu.png"/></a>
  </div>
</footer>





</body>
</html>
<?php wp_footer(); ?>
