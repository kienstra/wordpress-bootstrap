<?php
// wp_bootstrap functions and definitionns
// @package wpbootstrap

require( get_template_directory() . '/inc/theme-options.php' ) ;

if( ! function_exists( 'wpbootstrap_setup' ) ) :
  function wpbootstrap_setup() {
    add_theme_support( 'automatic-feed-links' ) ;
    add_theme_support( 'post-thumbnails' ) ;
    add_theme_support( 'who_knows' ) ;
    add_theme_support( 'post-formats', array( 'aside', 'image',
                                              'video', 'quote', 'link' )
    ) ;
}
endif ;

add_action( 'after_setup_theme', 'wpbootstrap_setup' ) ;

function simple_copyright() {
  echo "&copy" . " " . get_bloginfo( 'admin' ) . " " . date( 'Y' ) ;
}

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

add_filter( 'login_errors', 'plain_error_message' ) ;

remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;

function wpbootstrap_paginate_links() {
  global $wp_query ; 
  $big = 999999999 ;  

  echo paginate_links( array( 
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '/page/%#%',
    'current' => max( 1, get_query_var( 'paged' ) ),
    'total'  => $wp_query->max_num_pages,
    'prev_next' => True,
    'prev_text' => __( '<< Newer posts' ),
    'next_text' => __( 'Older posts >>' ),
    )    
  ) ;
}

function create_widget($name, $id, $description) {
	 register_sidebar(array(
                'name'		=> __( $name ),
                'id'		=> $id,
       	        'description'	=> __( $description ),
                'before_widget'	=> ' ',
                'after_widget'	=> ' ',
	        'before_title'	=> '<h2>',
                'after_title'	=> '</h2>'
        ));

}

function wpbootstrap_register_image_picker() { 
  require_once( 'image-widget.php' ) ;
  register_widget( 'Image_Picker' ) ;
}

//add_action('widgets_init', 'wpbootstrap_register_image_picker' ) ; 

function wpbootstrap_widgets_init() { 
  create_widget('Front Page: Left Side', 'copy_left', 'Displays in the left of the front page');
  create_widget('Front Page: Right Side', 'copy_right', 'Displays in the right of the front page');
  create_widget( 'Main Sidebar', 'main_sidebar', 'Diplays on News and Blog page' ) ;

}
add_action( 'widgets_init', 'wpbootstrap_widgets_init' ) ; 