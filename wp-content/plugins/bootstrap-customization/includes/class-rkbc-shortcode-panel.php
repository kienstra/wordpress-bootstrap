<?php

// Display content from customizer on front page, using either shortcode or a content filter

$options = get_option( 'rkbc_plugin_options' ) ;
$use_shortcode = $options[ 'use_shortcode' ] ;

if ( 1 == $use_shortcode ) {
  add_shortcode( 'rkbc_bootstrap' , array( 'RkbcMakeAllSections', 'init_and_get' ) ) ;
} else if ( 0 == $use_shortcode ) {
  add_action( 'the_content' , 'rkbc_content_filter' ) ;
}
function rkbc_content_filter( $content ) {
//  global $post ;
//  if ( $GLOBALS[ 'post' ]->post_name == "home"   page or posts
/*  $page_or_posts = get_option( 'show_on_front' ) ;
  $has_executed = false ;
  if ( 'posts' == $page_or_posts && false == $has_executed ) {
    $content = RkbcMakeAllSections::init_and_get() . $content ;
    $has_executed = true ;
  }
*/
  if ( is_front_page() && $GLOBALS[ 'post' ]->post_type == 'page' ) {
    $content = RkbcMakeAllSections::init_and_get() . $content ;
  }
  return $content ;
}

class RkbcMakeAllSections {
  private $section_types ;
  private static $instance ;
  private static $jumbotron_top = "<div class='jumbotron'>\n<div class='container'>\n" ;
  private static $jumbotron_bottom = "</div>\n</div>" ;
  private static $row_top = "<div class='container'>\n<div class='row'>\n" ;
  private static $row_bottom = "</div>\n" ;
  private $container ;

  private function __construct() {
    $this->container = '' ;
    $this->add_jumbotron_to_container() ;
    $this->add_row_to_container() ;
  }

  public function init_and_get() {
    self::$instance = new self() ;
    return self::$instance->container ;
  }

  private function add_jumbotron_to_container() {
    $this->container .= self::$jumbotron_top
      . RkbcMakePanel::init_and_get( 'top_jumbotron' )
      . self::$jumbotron_bottom ;	     
  }

  private function add_row_to_container() {
    $this->container .= self::$row_top
		     . RkbcMakeRowOfColumns::init_and_get()
		     .  self::$row_bottom ;
  }
}

class RkbcMakeRowOfColumns {
  private $col_top ;
  private static $col_bottom = "</div>\n" ;
  private $column_class ;
  private $container ;
  private $number_of_columns ;
  private $column_names ;
  private static $instance ;    

  public function __construct() {
    $options = get_option( 'rkbc_plugin_options' ) ;
    $this->number_of_columns = $options[ 'column_amount' ] ;
    $this->assign_html_class() ;
    $this->assign_column_names() ;
    $this->add_all_columns_to_container() ;      
  }

  public function init_and_get() {
    self::$instance = new self() ;
    return self::$instance->container ;
  }

  private function assign_html_class() {
    switch( $this->number_of_columns ) {
      case( 2 ) :
	$this->column_class = 'col-md-6' ;
	break ;
      case( 3 ) :
	$this->column_class = 'col-md-4' ;
	break ;
      case( 4 ) :
	$this->column_class = 'col-md-3' ;
	break ;
    }
  }

  private function assign_column_names() { 
    $this->column_names = get_panel_names() ;
  }

  public function add_all_columns_to_container() {
    $container = '' ;
    $col_top = "<div class='{$this->column_class}'>" ;
    $column_names = $this->column_names ;

    foreach( $column_names as $panel_name ) {
      if ( 'top_jumbotron' == $panel_name ) {
	continue;
      }
      $this->container .= $col_top
		       .  RkbcMakePanel::init_and_get( $panel_name ) 
		       .  self::$col_bottom ;
    }
  }     
}

class RkbcMakePanel {
  private static $instance ;
  private $panel_name ;
  private $container ;
  private $opening_div ;
  private static $closing_div = "</div>" ;

  public function __construct( $panel_name ) {
    $this->name = $panel_name ;
    $this->opening_div = "<div class='customized-col' id='{$this->name}'>" ;
    $this->make_full_section() ;
  }

  public static function init_and_get( $panel_name ) {
    self::$instance = new self( $panel_name ) ;
    return self::$instance->container ;
  }     

  public function make_full_section() {
    $this->add_opening_div_to_container() ; 
    $this->add_image_section_to_container() ;
    $this->add_heading_section_to_container() ;
    $this->add_copy_section_to_container() ;
    $this->add_closing_div_to_container() ; 
  }		 

  public function add_image_section_to_container() {
    $selector = 'image_' . $this->name ;
    $src = get_theme_mod( $selector ) ;
    $max_height = get_theme_mod( 'image_slider_' . $this->name ) ;
    $this->container .=
      "<div style='max-height:250px'><img class='img-customize img-rounded {$selector} img-responsive' src='{$src}' style='width: auto ; height: auto ; max-height:{$max_height}%' alt='{$selector}'>\n</div>" ;
  }

  public function add_heading_section_to_container() {
    $selector = 'heading_' . $this->name ;
    $default = $this->name . ' Heading' ;
    $heading_html =get_theme_mod( $selector , $default ) ;
    $this->container .=
      "<h2 class='{$selector}'>
	{$heading_html}
       </h2>\n" ;
  }

  public function add_copy_section_to_container() {
    $selector = 'copy_' . $this->name ;
    $default = $this->name . ' copy, enter text by selecting customize theme' ;
    $copy_html = get_theme_mod( $selector , $default ) ;
    $stripped_copy =  nl2br( strip_tags( $copy_html ) ) ;
    $this->container .=
      "<div class='copy'>
	<span class='{$selector}'>
	  {$stripped_copy}
	</span>
      </div>\n" ;
  }

  private function add_opening_div_to_container() {
    $this->container .= $this->opening_div ;
  }

  private function add_closing_div_to_container() {
    $this->container .= self::$closing_div ;
  } 
}



