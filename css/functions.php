<?php

//Import stylesheet, icons and fonts

wp_enqueue_style( 'style', get_stylesheet_uri() );
wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Oswald:400,700,300|Lato:400,300,400italic,700');


//Import scripts, esp jQuery

function get_jquery()
{
    // Register the script
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.12.4.min.js' );
    // Then enqueue the script:
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'get_jquery' );
