<?php
/**
Bootstrap Customizer Plugin Menu
**/

class BootstrapCustomization {

  protected static $version = '1.0.0' ;
  protected static $plugin_slug = 'bootstrap-customization' ;
  protected static $instance = null ;

  private function __construct() {
    add_action( 'customize_preview_init' , array( $this, 'enqueue_styles' ) ) ;
    add_action( 'customize_preview_init' , array( $this, 'enqueue_scripts' ) ) ;
    register_activation_hook( __FILE__ , array( $this, 'deactivate_if_early_version' ) ) ;
    register_activation_hook( __FILE__ ,  array( $this, 'install_with_default_options' ) ) ; 
    $this->get_required_files() ;
  }

  public static function get_instance() {
    if ( null == self::$instance )
    {
      self::$instance = new self ;
    }
    return self::$instance ;
  }

  public function enqueue_styles() {
    wp_enqueue_style( self::$plugin_slug . '-styles' , plugins_url( self::$plugin_slug . '/css/style.css' , __FILE__ ) , array() , $this::$version ) ;
	}
  
  public function enqueue_scripts() {
    wp_enqueue_script( $this::$plugin_slug . '-scripts', plugins_url( '/js/bc_script.js' , __FILE__ ) ,
      array( 'jquery' , 'customize-preview' ) , $this::$version, true ) ;
  }

  public function get_required_files() {
    require_once( plugin_dir_path( __FILE__ ) . 'includes/theme-options.php' ) ;
    require_once( plugin_dir_path( __FILE__ ) . 'includes/class-rkbc-shortcode-panel.php' ) ;
    require_once( plugin_dir_path( __FILE__ ) . 'includes/rkbc-options.php' ) ; 
  }

  public function deactivate_if_early_version() {
    if ( version_compare( get_bloginfo( 'version' ) , '3.4' , '<' ) ) {
      deactivate_plugins( basename( __FILE__ ) ) ;
    }
  }

  public function install_with_default_options() {
    $rkbc_plugin_options = array( 
      'output_css' => false ,
      'column_amount' => 2 ,
      'column_amount_to_names' => array(
          2 => array( 'left' , 'right' ) ,
	  3 => array( 'left', 'middle' , 'right' ) ,
	  4 => array( 'first' , 'second' , 'third' , 'fourth' ) ,
    ) ) ;
         
    delete_option( 'rkbc_plugin_options' ) ;
    add_option( 'rkbc_plugin_options' , $rkbc_plugin_options ) ;
    $options = get_option( 'rkbc_plugin_options' ) ;
    var_dump( $options ) ; 
  }
}
   

