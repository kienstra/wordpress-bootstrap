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
    
    public function __construct( $section_name , $customize ) { 
      $this->wp_customize =  $customize ;
      $this->add_section( $section_name ) ; 
      $this->image_with_slider( $section_name ) ;
      $this->heading_and_copy( $section_name ) ;
      self::$section_counter++ ;
    }

    public function add_section( $name ) {
      $capitalized_with_space = ucwords( str_replace( '_' , ' ', $name ) ) ;     
      $this->wp_customize->add_section( $name , array(
        'title'    => __( $capitalized_with_space , 'wpbootstrap' ) ,
        'priority' => self::$section_counter ,
     ) ) ;     
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

      public function heading_and_copy( $name ) { 
	$this->wp_customize->add_setting( "heading_$name", array(
			'default'    => '',
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
			'default'    => '',
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

add_action( 'customize_register' , 'rkbc_make_section', 11 ); 
function rkbc_make_section( $wp_customize ) {
  $options = get_option( 'rkbc_plugin_options' ) ; 
  $panels = $options[ 'panels' ] ; 
  foreach ( $panels as $panel_name ) {
    new RK_Customize_Section( $panel_name , $wp_customize ) ;
  }
}

