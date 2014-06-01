<?php 

// wp_bootstrap functions and definitionn
// @package prowordpress

add_action( 'customize_register' , 'bc_register_classes', 10 ) ;
function bc_register_classes( $wp_customize ) {

if ( class_exists( 'WP_Customize_Control' ) ) {
  class RK_Customize_Image_Control extends WP_Customize_Control {
    public function render_content() {  
      ?>
       <label>
       <span class="customize-control-title">
         <?php echo esc_html( $this->label ) ; ?>
       </span>
      <?php
      $images_query = new WP_Query( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image' , 'posts_per_page' => -1 ) ) ;
      if ( $images_query->have_posts() ) :
      ?>
        <select <?php echo $this->get_link() ; ?> class="image-selector-right-side" >
	<?php
        while ( $images_query->have_posts() ) :
	  $images_query->the_post() ; 
       ?>
         <option value="<?php echo wp_get_attachment_url(); ?>" <?php selected( $this->value(), get_permalink(), false ) ; ?>> 
	   <?php the_title() ; ?>
	 </option>
       <?php
	endwhile; 
       ?>
	</select>
	</label>
	<?php wp_reset_postdata() ;
      endif; 
    }
  }
}

if ( class_exists( 'WP_Customize_Control' ) ) {
  class PTD_Textarea_Control extends WP_Customize_Control {  
    public function render_content() { 
      ?>
      <label>
	<span class="customize-control-title">
	  <?php echo esc_html( $this->label ) ; ?>
	</span>
      </label>
      <?php // $boot_textarea_link = $this->link() ; ?>
	<textarea class="<?php echo $this->name ; ?> large-text" cols="20" rows="15" <?php $this->link() ; ?>>
           <?php echo get_theme_mod( 'copy_right_side' ) ; ?>
	</textarea>	
     <?php       
     }
   }
}

if ( class_exists( 'WP_Customize_Control' ) ) {
  class RK_Customize_Image_Slider extends WP_Customize_Control {
    public function render_content() { 
      ?>
        <span class="customize-control-title">
	  <?php echo esc_html( $this->label ) ; ?>
	</span>
        <input type="range" <?php echo $this->link() ; ?> value="<?php get_theme_mod( 'image_slider_right_side' ) ; ?>" />
    <?php
    }
  }
}

class RK_Customize_Section {

    public $wp_customize ;
    public static $section_counter = 0 ;
    private static $section_names ;
    private static $section_titles ;
    private static $instance ;
    
    public function __construct( $wp_customize ) { 
      $this->wp_customize = $wp_customize ;
      $this->set_section_names() ;
      $this->set_section_titles() ;
    }
    
    public function init_and_create_all_sections( $wp_customize ) {
      self::$instance = new self( $wp_customize ) ;
      self::$instance->create_all_sections() ;
    }    

    private function create_all_sections() {
       $section_names = self::$section_names ; 
       $section_titles = self::$section_titles ;
       $array_size = sizeof( $section_names ) ;
       var_dump( $section_names ) ;       
       for( $i = 0 ; $i < $array_size ; $i++ ) {  
         $name = $section_names[ $i ] ;
         $title = $section_titles[ $i ] ;
         $this->make_full_section( $name , $title ) ;
       }
     }

    public function make_full_section( $section_name , $title ) {
      $this->initialize_section( $section_name, $title ) ; 
      $this->image_with_slider( $section_name ) ;
      $this->heading_and_copy( $section_name , $title ) ;
      self::$section_counter++ ;
    }

    public function initialize_section( $name , $title ) {
      // $capitalized_with_space = ucwords( str_replace( '_' , ' ', $name ) ) ;     
      $this->wp_customize->add_section( $name , array(
        'title'    => $title ,
        'priority' => self::$section_counter ,
     ) ) ;     
    }

    private function set_section_names() {
      self::$section_names = get_panel_names() ;
    }

    public function set_section_titles() {
      $amount_to_names = array(
	      2 => array( 'Left' , 'Right' ) ,
	      3 => array( 'Left' , 'Middle' , 'Right' ) ,
	      4 => array( 'First' , 'Second' , 'Third' , 'Fourth' ) ,
      ) ;
      $options = get_option( 'rkbc_plugin_options' ) ;
      $column_amount = $options[ 'column_amount' ] ;      
      $names = $amount_to_names[ $column_amount ] ;
      $result = array( 'Top Jumbotron' ) ;

      foreach( $names as $name ) {
	array_push( $result, $name . ' Panel' ) ;
      }
      self::$section_titles = $result ;
    }


    public function image_with_slider( $name ) { 

	$this->wp_customize->add_setting( "image_{$name}", array(
          'default'    =>  '',
          'capability' => 'manage_options',
          'transport'  => 'postMessage',
	) ) ;

        $this->wp_customize->add_control( new RK_Customize_Image_Control(
	  $this->wp_customize, "image_$name", 
	    array( 'label' => __( 'Image', 'wpbootstrap' ),
		 'section' => $name,
		 'settings' => "image_$name" ,
	  ) ) ) ;

	 $this->wp_customize->add_setting( "image_slider_$name", array(
	      'default'    =>  '',
	      'capability' => 'manage_options',
	      'transport'  => 'postMessage',
	 ) ) ;

	  $this->wp_customize->add_control( new RK_Customize_Image_Slider(
     	    $this->wp_customize, "image_slider_$name", 
	    array( 'label' => __( 'Image  Size', 'wpbootstrap' ),
		 'section' => $name,
		 'settings' => "image_slider_$name" ,
	   ) ) ) ; 
      }

      public function heading_and_copy( $name , $title ) { 
	$this->wp_customize->add_setting( "heading_$name", array(
			'default'    =>  $title . ' Heading',
			'capability' => 'manage_options' ,
			'transport'  => 'postMessage' ,		
		) );

	$this->wp_customize->add_control( "heading_$name", array(
			'label'      => __( 'Heading', 'wpbootstrap' ),
			'section'    => $name,
			'settings'    => "heading_$name" ,
			'capability' => 'manage_options',
		) );

	$this->wp_customize->add_setting( "copy_$name", array(
			'default'    => $title .  ' copy, edit this by clicking on '. $title . ' on the left',
			'capability' => 'manage_options',
			'transport'  => 'postMessage',
 			"class_name" => 'copy-right-side',
		) );

        $this->wp_customize->add_control( new PTD_Textarea_Control( $this->wp_customize, "copy_$name", 
          array( 'label'	=> __( 'Copy', 'wpbootstrap' ),
    	  	   'section'	=>  $name ,
	  	    'settings'	=> "copy_$name",
           ) ) ) ;    
     }
  } 
}
       
function get_panel_names() {
  $possible_names = array( 'one' , 'two' , 'three' , 'four' ) ;
  $options = get_option( 'rkbc_plugin_options' ) ;
  $column_amount = $options[ 'column_amount' ] ;
  $result = array( 'top_jumbotron' ) ;
  for ( $i = 0 ; $i < $column_amount ; $i++ ) {
    array_push( $result , $possible_names[ $i ] ) ;
  }
  return $result ;
}

add_action( 'customize_register' , array( 'RK_Customize_Section' , 'init_and_create_all_sections' ) , 11 ) ;
