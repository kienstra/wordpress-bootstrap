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

add_action( 'plugins_loaded' , 'ddw_get_required_files' ) ;
function ddw_get_required_files() {
  require_once( plugin_dir_path( __FILE__ ) . 'includes/bootstrap-widgetized-rows.php' ) ; 
  require_once( plugin_dir_path( __FILE__ ) . 'includes/bwr-build-sidebar.php' ) ; 
}

add_action( 'customize_register' , 'ddw_enqueue_scripts_and_styles' ) ; // customize_controls_enqueue_scripts
function ddw_enqueue_scripts_and_styles() {
    // MIT license: https://jquery.org/license/  this could just enqueue jquery's sortable
    wp_enqueue_script( DDW_PLUGIN_SLUG . '-jquery-mobile-sortable', plugins_url( '/js/jquery-ui.js' , __FILE__ ) , array( 'jquery' ) , DDW_PLUGIN_VERSION , true ) ;
    wp_enqueue_script( DDW_PLUGIN_SLUG . '-customizer-widget', plugins_url( '/js/ddw-customizer-widget.js' , __FILE__ ) , array( 'jquery' , DDW_PLUGIN_SLUG . '-jquery-mobile-sortable' ) , DDW_PLUGIN_VERSION , true ) ;
    wp_enqueue_style( DDW_PLUGIN_SLUG . '-sortable-style', plugins_url( '/css/ddw-style.css' , __FILE__ ) , DDW_PLUGIN_VERSION , true ) ;    

}

add_action( 'customize_controls_enqueue_scripts' , 'ddw_enqueue_customize_control_scripts' ) ;
function ddw_enqueue_customize_control_scripts() {
  wp_enqueue_script( DDW_PLUGIN_SLUG . '-customize-controls-widgets', plugins_url( '/js/ddw-customize-controls-widgets.js' , __FILE__ ) , array( 'jquery' ) , DDW_PLUGIN_VERSION , true ) ;
}


// didn't work: wp_comment_reply , the_widget , wp_register_sidebar_widget
// interesting: dynamic_sidebar
//add_action( 'init' , 'ddw_widget_callback' ) ;
function ddw_widget_callback( $args ) {
  $active_sidebars =  $GLOBALS[ 'wp_registered_sidebars' ] ;
  echo "the active sidebars are: " ;
  var_dump( $active_sidebars ) ;
}