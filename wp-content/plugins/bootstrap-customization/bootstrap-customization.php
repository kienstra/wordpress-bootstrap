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

register_activation_hook( __FILE__ , 'install_with_default_options' ) ;
function install_with_default_options() {
    $rkbc_plugin_options = array( 
      'output_css' => 0 ,
      'column_amount' => 3 ,
      'use_shortcode' => 0 ,
    ) ;
    add_option( 'rkbc_plugin_options' , $rkbc_plugin_options ) ;
    $options = get_option( 'rkbc_plugin_options' ) ;
    echo "the activation hook is executing" ;

}


require_once( plugin_dir_path( __FILE__ ) . 'class-bootstrap-customization.php' ) ;
BootstrapCustomization::get_instance() ;

  ?>