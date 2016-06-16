<?php

//Initial addition of responsive styling and jQuery
	wp_enqueue_style( 'Styles', get_stylesheet_uri() );
	wp_enqueue_style( 'FontAwesome', get_stylesheet_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.12.4.min');
	wp_enqueue_script( 'masonry', 'https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js');

//Adds in Google Web fonts
	function load_fonts() {
		wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Oswald:400,700,300|Lato:400,300,400italic,700');
		wp_enqueue_style( 'googleFonts');
		}
		add_action('wp_print_styles', 'load_fonts');

//Hide visual editor for everyone
add_filter('user_can_richedit' , create_function('' , 'return false;') , 50);

//Menu registration
	 register_nav_menus(array(
	   'top' => __('Smoke Media Menu'),
		 'primary' => __('Sections Menu'),
		 'social' => __('Social Menu'),
	   'footer' => __('Footer Menu'),
	 ));

//Allows featured images
	 add_theme_support( 'post-thumbnails' );

//Reduce excerpt length
			 function custom_excerpt_length( $length ) {
			return 15;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 15 );

//Custom read more
	function new_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
