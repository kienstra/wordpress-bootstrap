<?php
/**
Plugin Name: Widget Bootstrap Styling
Plugin Author: Ryan Kienstra
**/

add_filter( 'widget_pages_args' , 'rkwb_widget_filter' ) ;
function rkwb_widget_filter( $settings ) {
  $settings[ 'link_before' ] = "<div class='bootstrap-styling'>" ;
  $settings[ 'link_after' ] = "</div>" ;
  return $settings ;
  var_dump( $settings ) ; 
}

add_filter( 'widget_archives_args' , 'rkbc_archives_filter' ) ;
function rkbc_archives_filter( $args ) {
  $args[ 'before' ] = "<div class='bootstrap-styling'>" ;
  $args[ 'after' ] = "</div>" ;
  return $args ;
}

add_action( 'wp_enqueue_scripts' , 'rkwb_styles' ) ;
function rkwb_styles() {
  wp_enqueue_style( 'bootstrap-widget' , get_template_directory_uri() . '/bootstrap/css/bootstrap-widget.css' ) ;
}


