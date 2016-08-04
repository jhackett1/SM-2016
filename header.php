<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title('|','true','right'); ?><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
  <?php wp_head(); ?>

  <!-- Open graph meta tags -->
    <?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>
    <!-- the default values -->
    <meta property="fb:app_id" content="1134129026651501" />
    <!-- <meta property="fb:admins" content="1179665522100430" /> -->

    <!-- if page is content page -->
    <?php if (is_single()) {

    $feat = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'ogimg' );
    $feat = $feat[0];
    ?>

      <meta property="og:url" content="<?php the_permalink() ?>"/>
      <meta property="og:title" content="<?php single_post_title(''); ?>" />
      <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
      <meta property="og:type" content="article" />
      <meta property="og:image" content="<?php echo $feat; ?>" />

      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@SmokeMag_">
      <meta name="twitter:creator" content="@SmokeMag_">
      <meta name="twitter:title" content="<?php the_title(); ?>">
      <meta name="twitter:description" content="<?php the_excerpt(); ?>">
      <meta name="twitter:image" content="<?php echo $feat; ?>">



      <!-- if not single -->
      <?php } else { ?>
      <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
      <meta property="og:description" content="<?php bloginfo('description'); ?>" />
      <meta property="og:type" content="website" />
      <meta property="og:image" content="logo.jpg" />

    <?php } ?>




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

<script>
  new WOW().init();
</script>
