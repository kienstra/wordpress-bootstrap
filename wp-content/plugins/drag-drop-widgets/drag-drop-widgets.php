<?php

/*
Plugin Name: Drag And Drop Widgets 
Plugin URI: www.ryankienstra.com/drag-drop-widgets
Description: 

Version: 1.0.0
Author: Ryan Kienstra
Author URI: www.ryankienstra.com
License: GPL2

*/

if ( ! defined( 'WPINC' )  ) {
 die ;
}

define( 'DDW_PLUGIN_SLUG' , 'drag-drop-widgets' ) ;
define( 'DDW_PLUGIN_VERSION' , '1.0.0' ) ; 

register_activation_hook( __FILE__ , 'ddw_deactivate_if_early_wordpress_version' ) ;

function ddw_deactivate_if_early_wordpress_version() {
  if ( version_compare( get_bloginfo( 'version' ) , '3.8' , '<' ) ) {
    deactivate_plugins( basename( __FILE__ ) ) ;
  }
}

//add_action( 'plugins_loaded' , 'ddw_get_required_files' ) ;
function ddw_get_required_files() {
  require_once( plugin_dir_path( __FILE__ ) . 'includes/' ) ; 
  require_once( plugin_dir_path( __FILE__ ) . 'includes/' ) ; 
}

add_action( 'wp_enqueue_scripts' , 'ddw_enqueue_scripts_and_styles' ) ; 
function ddw_enqueue_scripts_and_styles() {

    // MIT license: https://jquery.org/license/
    wp_enqueue_script( DDW_PLUGIN_SLUG . '-jquery-mobile-sortable', plugins_url( '/js/jquery-ui.js' , __FILE__ ) , array( 'jquery' ) , DDW_PLUGIN_VERSION , true ) ;
    wp_enqueue_script( DDW_PLUGIN_SLUG . '-customizer-widget', plugins_url( '/js/ddw-customizer-widget.js' , __FILE__ ) , array( 'jquery' , DDW_PLUGIN_SLUG . '-jquery-mobile-sortable' ) , DDW_PLUGIN_VERSION , true ) ;
}

