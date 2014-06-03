<?php
/**
Bootstrap Customizer Plugin Menu
**/

class BootstrapCustomization {

  protected static $version = '1.0.0' ;
  protected static $plugin_slug = 'bootstrap-customization' ;
  protected static $instance = null ;

  private function __construct() {
    $this->deactivate_if_early_wordpress_version() ;
    add_action( 'customize_preview_init' , array( $this, 'enqueue_styles_if_setting_allows' ) ) ;
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

  public function enqueue_styles_if_setting_allows() {
    $options = get_option( 'rkbc_plugin_optiions' ) ;
    if ( 1 == $options[ 'output_css' ] ) {
      wp_enqueue_style( self::$plugin_slug . '-styles' , plugins_url( self::$plugin_slug . '/css/style.css' , __FILE__ ) , array() , $this::$version ) ;
    }
  }
  
  public function enqueue_scripts() {
    wp_enqueue_script( $this::$plugin_slug . '-scripts', plugins_url( '/js/bc_script.js' , __FILE__ ) ,
      array( 'jquery' , 'customize-preview' ) , $this::$version, true ) ;
  }

  private function get_required_files() {
    require_once( plugin_dir_path( __FILE__ ) . 'includes/theme-options.php' ) ;
    require_once( plugin_dir_path( __FILE__ ) . 'includes/class-rkbc-shortcode-panel.php' ) ;
    require_once( plugin_dir_path( __FILE__ ) . 'includes/rkbc-options.php' ) ; 
  }

  private function deactivate_if_early_wordpress_version() {
    if ( version_compare( get_bloginfo( 'version' ) , '3.4' , '<' ) ) {
      deactivate_plugins( basename( __FILE__ ) ) ;
    }
  }
}



   