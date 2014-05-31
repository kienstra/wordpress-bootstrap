<?php

// Shortcode logic

if ( ! class_exists( 'BcMakePanel' ) ) {
  class RkbcShortcodePanel {
    private static $instance ;
    private $name ;
    private $container ;
    private $opening_div ;
    private static $closing_div = "</div>" ;

    public function __construct( $atts ) {
      $this->name = $atts[ 'name' ] ;
      $this->opening_div = "<div class='customized-col' id='{$this->name}'>" ;
      $this->make_full_section() ;
    }

    public function init_and_get( $atts ) {
      self::$instance = new self( $atts ) ;
      echo self::$instance->container ;
    }     

    public function make_full_section() {
      $this->add_opening_div() ; 
      $this->make_image_section() ;
      $this->make_heading_section() ;
      $this->make_copy_section() ;
      $this->add_closing_div() ; 
    }		 

    public function make_image_section() {
      $selector = 'image_' . $this->name ;
      $src = get_theme_mod( $selector ) ;
      $max_height = get_theme_mod( 'image_slider_' . $this->name ) * 3 ;
      $this->container .=
	"<img class='img-customize img-rounded {$selector} img-responsive' src='{$src}' style='width: auto ; max-height:{$max_height}px' alt='{$selector}'>\n" ;
    }

    public function make_heading_section() {
      $heading_html =get_theme_mod( 'heading_' . $this->name ) ;
      $this->container .=
	"<h2 class='heading_{$this->name}'>
	  {$heading_html}
	 </h2>\n" ;
    }

    public function make_copy_section() {
      $selector = 'copy_' . $this->name ;
      $copy_html = get_theme_mod( $selector ) ;
      $stripped_copy =  nl2br( strip_tags( $copy_html ) ) ;
      $this->container .=
	"<div class='copy'>
	  <span class='{$selector}'>
	    {$stripped_copy}
	  </span>
	</div>\n" ;
    }

    private function add_opening_div() {
      $this->container .= $this->opening_div ;
    }

    private function add_closing_div() {
      $this->container .= self::$closing_div ;
    } 
  }
}

if ( ! class_exists( 'RkcbMakeColumns' ) ) {
  class RkbcMakeColumns() {
    private $col_top ;
    private static $col_bottom = "</div>\n" ;
    private $column_class ;
    private $container ;
    private $number_of_columns ;
    private static $instance ;

    public function construct() {
    }

    public function init_and_get( $number_of_columns ) {
      self::$instance = new self() ;
      $this->assign_html_class() ;
      $this->make_all_columns() ;
      return $container ;
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

    public function make_all_columns() {
      $container = '' ;
      $col_top = "<div class='{$this->column_class}'>" ;
      foreach( $this->number_of_columns ) {
	$this->container .= $col_top
	  .= RkbcShortcodePanel->init_and_get()
	  .= $this->col_bottom ;
      }
    }     
  }
}
      
if ( ! class_exists( 'RkbcFullSections' ) ) {
  class RkbcFullSections() {
    private $section_types ;
    private static $instance ;
    private static $jumbotron_top = "<div class='jumbotron'>\n<div class='container'>\n" ;
    private static $jumbotron_bottom = "</div>\n</div>" ;
    private static $row_top = "<div class='container'>\n<div class='row'>\n" ;
    private static $row_bottom = "</div>\n</div>" ;
    private static $container ;
    
    public function construct( ) {
      $options = get_option( 'rkbc_plugin_options' ) ;
      $this->section_types = 3 ; // $options[ 'number_of_panels' ] ;
    }

    public function init_and_get() {
      self::$instance = new self() ;
      add_jumbotron_to_container() ;
      add_row_to_container() ;
      return $this->container ;
    }
    

    private function add_jumbotron_to_container() {
      $this->container .= self::$jumbotron_top
      	     .= RkbcMakePanel->init_and_get() ;
      	     .= self::$jumbotron_bottom ;
    }

    private function add_row_to_container() {
      $this->container .= $this->row_top
      		       .= RkbcMakeColumns->init_and_get(  $this->number_of_columns ) ;
      		       .= $this->row_bottom ;
    }
  }
}

add_shortcode( 'panel_to_customize', array( 'RkbcFullSections', 'init_and_get' ) ) ;
