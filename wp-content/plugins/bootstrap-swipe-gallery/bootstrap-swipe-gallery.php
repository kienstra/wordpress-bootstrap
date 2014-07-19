<?php

/*
Plugin Name: Bootstrap Swipe Gallery
Plugin URI: www.ryankienstra.com/swipe-gallery
Description: Swipe through gallery images on touch devices. Image sizes adjust to screen size. Must have Twitter Bootstrap 3. 

Version: 1.0.0
Author: Ryan Kienstra
Author URI: www.ryankienstra.com
License: GPL2

*/

if ( ! defined( 'WPINC' )  ) {
 die ;
}

define( 'BSG_PLUGIN_SLUG' , 'bootstrap-swipe-gallery' ) ;
define( 'BSG_PLUGIN_VERSION' , '1.0.0' ) ; 



register_activation_hook( __FILE__ , 'bsg_deactivate_if_early_wordpress_version' ) ;

function bsg_deactivate_if_early_wordpress_version() {
  if ( version_compare( get_bloginfo( 'version' ) , '3.8' , '<' ) ) {
    deactivate_plugins( basename( __FILE__ ) ) ;
  }
}

add_action( 'plugins_loaded' , 'bsg_get_required_files' ) ;
function bsg_get_required_files() {
  require_once( plugin_dir_path( __FILE__ ) . 'includes/class-bsg-modal-carousel.php' ) ;
  require_once( plugin_dir_path( __FILE__ ) . 'includes/gallery-modal-setup.php' ) ;
}

add_action( 'wp_enqueue_scripts' , 'bsg_enqueue_scripts_and_styles_if_page_has_gallery' ) ;
function bsg_enqueue_scripts_and_styles_if_page_has_gallery() {
  global $post ;
  $post_content = $post->post_content ;
  if ( strpos( $post_content , "[gallery" ) !== false ) {
    // the page has a gallery
    wp_enqueue_style( BSG_PLUGIN_SLUG . '-carousel' , plugins_url( '/css/bsg-carousel.css' , __FILE__ ) , BSG_PLUGIN_VERSION );

    // MIT license: https://jquery.org/license/
    wp_enqueue_script( BSG_PLUGIN_SLUG . '-jquery-mobile-swipe', plugins_url( '/js/jquery.mobile.custom.min.js' , __FILE__ ) , array( 'jquery' ) , BSG_PLUGIN_VERSION , true ) ;
    wp_enqueue_script( BSG_PLUGIN_SLUG . '-modal_setup', plugins_url( '/js/gallery-modal.js' , __FILE__ ) , array( 'jquery' , BSG_PLUGIN_SLUG . '-jquery-mobile-swipe' ) , BSG_PLUGIN_VERSION , true ) ;
  }
}

