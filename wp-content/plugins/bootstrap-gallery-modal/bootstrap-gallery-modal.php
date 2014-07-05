<?php

/*
Plugin Name: Bootstrap Gallery Modal
Plugin URI: www.ryankienstra.com/bootstrap-gallery-modal
Description: Creates a pop-up for each gallery. Swipe through pictures on touch devices. Must have Twitter Bootstrap. 

Version: 1.0.0
Author: Ryan Kienstra
Author URI: www.ryankienstra.com
License: GPL2

*/

if ( ! defined( 'WPINC' )  ) {
 die ;
}

define( 'BGM_PLUGIN_SLUG' , 'bootstrap-gallery-modal' ) ;
define( 'BGM_PLUGIN_VERSION' , '1.0.0' ) ; 


register_activation_hook( __FILE__ , 'bgm_activate_with_default_options' ) ;
register_activation_hook( __FILE__ , 'bgm_deactivate_if_early_wordpress_version' ) ;

function bgm_activate_with_default_options() {
  $bgm_plugin_options = array( 

  ) ;
  update_option( 'bgm_options' ) ;
  update_option( 'bgm_plugin_options' , $bgm_plugin_options ) ;
}

function bgm_deactivate_if_early_wordpress_version() {
  if ( version_compare( get_bloginfo( 'version' ) , '3.4' , '<' ) ) {
    deactivate_plugins( basename( __FILE__ ) ) ;
  }
}

require_once( plugin_dir_path( __FILE__ ) . 'includes/class-bgm-modal-carousel.php' ) ;
require_once( plugin_dir_path( __FILE__ ) . 'includes/gallery-modal-setup.php' ) ;


add_action( 'wp_enqueue_scripts' , 'bgm_enqueue_scripts_and_styles_if_page_has_gallery' ) ;
function bgm_enqueue_scripts_and_styles_if_page_has_gallery() {
  global $post ;
  $post_content = $post->post_content ;
  if ( strpos( $post_content , "[gallery" ) !== false ) {
    // the page has a gallery
    wp_enqueue_style( BGM_PLUGIN_SLUG . '-carousel' , plugins_url( '/css/bgm-carousel.css' , __FILE__ ) , BGM_PLUGIN_VERSION );

//    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false ) { 
      wp_enqueue_script( BGM_PLUGIN_SLUG . '-jquery-mobile-swipe', plugins_url( '/js/jquery.mobile.custom.min.js' , __FILE__ ) , array( 'jquery' ) , BGM_PLUGIN_VERSION , true ) ;
//    }
    wp_enqueue_script( BGM_PLUGIN_SLUG . '-modal_setup', plugins_url( '/js/gallery-modal.js' , __FILE__ ) , array( 'jquery' ) , BGM_PLUGIN_VERSION , true ) ;
  }
}
