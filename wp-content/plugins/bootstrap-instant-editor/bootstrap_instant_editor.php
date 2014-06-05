<?php
/*
Plugin Name: Bootstrap Instant Editor
Plugin URI: www.ryankienstra.com/instant-editor
Description: See your full front page as you edit, with instant updates. Select any image, resize it, and enter text.
Version: 1.0.0
Author: Ryan Kienstra
Author URI: www.ryankienstra.com
License: GPL2

*/

if ( ! defined( 'WPINC' )  ) {
 die ;
}

register_activation_hook( __FILE__ , 'install_with_default_options' ) ;
function install_with_default_options() {
    $bie_plugin_options = array( 
      'output_css' => 0 ,
      'column_amount' => 3 ,
      'use_shortcode' => 0 ,
      'allow_vectors' => 0 ,
      'allow_buttons' => 0 ,
    ) ;
    add_option( 'bie_plugin_options' , $bie_plugin_options ) ;
    $options = get_option( 'bie_plugin_options' ) ;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-bootstrap-instant-editor.php' ) ;
BootstrapInstantEditor::get_instance() ;

?>