<?php
/*
Plugin Name: Bootstrap Customization
Plugin URI: www.ryankienstra.com
Description: Enter content and see the page updated in real time. Must have Bootstrap.
Version: 1.0.0
Author: Ryan Kienstra
Author URI: www.ryankienstra.com
License: GPL2
*/

if ( ! defined( 'WPINC' )  )
{
 die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-bootstrap-customization.php' ) ;

BootstrapCustomization::get_instance() ;

?>