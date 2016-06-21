<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|','true','right'); ?><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
  <?php wp_head(); ?>
</head>
<body>

<section id="overlay"></section>

<header id="normal" class="mobilehide">
  <div class="container">
    <nav>
      <?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
    </nav>
    <nav>
        <?php wp_nav_menu( array( 'theme_location' => 'social' ) ); ?>
    </nav>
  </div>
</header>

<?php get_template_part( "search-modal" ); ?>
