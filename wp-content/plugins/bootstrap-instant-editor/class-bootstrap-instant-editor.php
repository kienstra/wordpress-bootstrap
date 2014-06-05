<?php
/**
Bootstrap Instant Editor
**/

class BootstrapInstantEditor {

  protected static $version = '1.0.0' ;
  protected static $plugin_slug = 'bootstrap-instant-editor' ;
  protected static $instance = null ;

  private function __construct() {
    $this->deactivate_if_early_wordpress_version() ;
    add_action( 'wp_enqueue_scripts' , array( $this, 'enqueue_styles_based_on_setting' ) ) ;
    add_action( 'customize_preview_init' , array( $this, 'enqueue_scripts' ) ) ;    
    $this->get_required_files() ;
  }

  public static function get_instance() {
    if ( null == self::$instance )
    {
      self::$instance = new self ;
    }
    return self::$instance ;
  }

  public function enqueue_styles_based_on_setting() {
    wp_enqueue_style( self::$plugin_slug . '-style' , plugins_url( self::$plugin_slug . '/css/bie_style.css' ) ) ; 
    $options = get_option( 'bie_plugin_options' ) ;
    if ( 1 == $options[ 'output_css' ] ) {
      wp_enqueue_style( 'bootstrap-style' , plugins_url( self::$plugin_slug . '/css/bootstrap.min.css' ) ) ;
    }
  }
  
  public function enqueue_scripts() {
    wp_enqueue_script( $this::$plugin_slug . '-scripts', plugins_url( '/js/bie_script.js' , __FILE__ ) ,
      array( 'jquery' , 'customize-preview' ) , $this::$version, true ) ;
  }

  private function get_required_files() {
    require_once( plugin_dir_path( __FILE__ ) . 'includes/bie_customize_register.php' ) ;
    require_once( plugin_dir_path( __FILE__ ) . 'includes/bie_front_page_display.php' ) ;
    require_once( plugin_dir_path( __FILE__ ) . 'includes/bie_options.php' ) ; 
  }

  private function deactivate_if_early_wordpress_version() {
    if ( version_compare( get_bloginfo( 'version' ) , '3.4' , '<' ) ) {
      deactivate_plugins( basename( __FILE__ ) ) ;
    }
  }
}



   