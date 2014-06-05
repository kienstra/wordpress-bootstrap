<?php
/*
Plugin Name: Custom Type
Plugin URI: -
Description: Custom Post Type Setup
Version: 1.0
Author: Ryan Kienstra
Author URI: http://www.ryankienstra.com
License: GPLv2 or later
*/

add_action( 'init', 'register_wp_custom_types' ) ; 
function register_wp_custom_types() {     
  $labels = array( 
    'name'			=> __( 'Performances', 'performance' ),
    'singular_name'		=> __( 'Performance', 'performance' ),
    'add_new'			=> __( 'Add New', 'performance' ),
    'add_new_item'		=> __( 'Add New Performance', 'performance' ),
    'edit_item'		=> __( 'Edit Performances', 'performance' ),
    'new_item'		=> __( 'New Performance', 'performance' ) ,
    'view_item'		=> __( 'View Performance', 'performance' ),
    'search_items'		=> __( 'Search Performances', 'performance' ) ,
    'not_found'		=> __( 'No Performances Found', 'performance' ) ,
    'not_found_in_trash'	=> __( 'No Performance Found In Trash', 'performance' ) ,
    'parent_item_colon'	=> __( 'Parent Performance', 'performance' ) ,
    'menu_name'		=> __( 'Performances', 'performance' ) ,
   ) ;
  $args = array( 
    'labels'			=> $labels,
    'hierarchical'		=> false,
    'description'		=> __( 'Performance Details', 'performance' ),
    'supports'		=> array( 'title', 'editor', 'custom-fields', 'revisions' ) ,
    'register_meta_box_cb' 	=> 'wp_custom_types_meta',
    'public'			=> true ,
    'show_ui'			=> true ,
    'show_in_menu'		=> true ,
    'show_in_nav_menus'		=> true ,
    'publicly_queryable'	=> true ,
    'exclude_from_search'	=> false ,
    'has_archive'		=> true ,
    'query_var'			=> true ,
    'can_export'		=> true ,
    'rewrite'			=> true ,
    'capability_type'		=> 'post' ,
    'menu_position'		=> 5 ,
  ) ;
register_post_type( 'performance', $args ) ;
} 

function wpbootstrap_pre_get_posts( $query ) { 
  if ( is_admin() ) { 
    if ( isset( $query->query_vars[ 'post_type' ] ) ) {
      if ( $query->query_vars[ 'post_type' ] == 'performance' ) {
        $query->set( 'meta_key', 'performance_date' ) ;
	$query->set( 'orderby' , 'meta_value' ) ;
	$query->set( 'order' , 'ASC' ) ; 
	
	// Quick way to display only future events
	// $query->set( 'meta_compare', '>=' ) ;
	// $query->set( 'meta_value', time() ) ;
      }
    }
  }
}
add_filter( 'pre_get_posts', 'wpbootstrap_pre_get_posts' ) ;

add_filter( 'manage_performance_posts_columns', 'wpbootstrap_performance_table_head' ) ;
function wpbootstrap_performance_table_head( $defaults ) { 
  $defaults[ 'performance_date' ] = __( 'Performance Date', 'wpbootstrap' ) ;
  $defaults[ 'venue' ] = __( 'Performance Venue', 'wpbootstrap' ) ;
  unset( $defaults[ 'date' ] ) ;
  return $defaults ;
}
  
add_action( 'manage_performance_posts_custom_column', 'wpbootstrap_performance_table_content', 10, 2 ) ; 
function wpbootstrap_performance_table_content( $column_name, $post_ID ) { 

  if ( $column_name == 'performance_date' ) {
    $performance_date = get_post_meta( $post_ID, 'performance_date', true ) ;
    echo date( _x( 'F d, Y' , 'Event date format' , 'wpbootstrap' ), strtotime( $performance_date ) ) ;
  }
  if ( $column_name == 'venue' ) {
    echo get_post_meta( $post_ID, 'venue', true ) ;
  }
}