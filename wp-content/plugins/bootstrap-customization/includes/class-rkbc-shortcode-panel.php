<?php

// Shortcode logic
  

  class RkbcShortcodePanel {
    private static $instance ;
    private $name ;
    private $container ;
    private $opening_div ;
    private static $closing_div = "</div>" ;

    public function __construct( $name ) {
      $this->name = $name ;
      $this->opening_div = "<div class='customized-col' id='{$this->name}'>" ;
      $this->make_full_section() ;
    }

    public static function init_and_get( $name ) {
      self::$instance = new self( $name ) ;
      return self::$instance->container ;
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
      $selector = 'heading_' . $this->name ;
      $default = $this->name . ' Heading' ;
      $heading_html =get_theme_mod( $selector , $default ) ;
      $this->container .=
	"<h2 class='{$selector}'>
	  {$heading_html}
	 </h2>\n" ;
    }

    public function make_copy_section() {
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

    private function add_opening_div() {
      $this->container .= $this->opening_div ;
    }

    private function add_closing_div() {
      $this->container .= self::$closing_div ;
    } 
  }



function make_panel_wrapper( $args ) {
  $name = $args[ 'name' ] ;
  RkbcShortcodePanel::init_and_get( $name ) ;  
}


  class RkbcMakeColumns {
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
      $this->make_all_columns() ;      
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
    
    public function make_all_columns() {
      $container = '' ;
      $col_top = "<div class='{$this->column_class}'>" ;
      $column_names = $this->column_names ;

      foreach( $column_names as $name ) {
        if ( 'top_jumbotron' == $name ) {
	  continue;
	}
	$this->container .= $col_top
			 .  RkbcShortcodePanel::init_and_get( $name ) 
			 .  self::$col_bottom ;
      }
    }     
  }

  class RkbcFullSections {
    private $section_types ;
    private static $instance ;
    private static $jumbotron_top = "<div class='jumbotron'>\n<div class='container'>\n" ;
    private static $jumbotron_bottom = "</div>\n</div>" ;
    private static $row_top = "<div class='container'>\n<div class='row'>\n" ;
    private static $row_bottom = "</div>\n" ;
    private $container ;
    
    public function __construct() {
      $this->container = '' ;
      $this->add_jumbotron_to_container() ;
      $this->add_row_to_container() ;
    }

    public function init_and_get() {
      self::$instance = new self() ;
      echo self::$instance->container ;
    }
    
    private function add_jumbotron_to_container() {
      $this->container .= self::$jumbotron_top
        . RkbcShortcodePanel::init_and_get( 'top_jumbotron' )
	. self::$jumbotron_bottom ;	     
    }

    private function add_row_to_container() {
      $this->container .= self::$row_top
      		       . RkbcMakeColumns::init_and_get()
      		       .  self::$row_bottom ;
    }
  }


add_shortcode( 'panel_to_customize', array( 'RkbcFullSections', 'init_and_get' ) ) ;
