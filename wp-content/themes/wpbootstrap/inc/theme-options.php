<?php 

// wp_bootstrap functions and definitionn
// @package prowordpress

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

    public function __construct( $section_name , $customize ) { 
      $this->wp_customize =  $customize ;
      $this->add_section( $section_name ) ; 
      $this->image_with_slider( $section_name ) ;
      $this->heading_and_copy( $section_name ) ;
    }

    public function add_section( $name ) {
      $capitalized_with_space = ucwords( str_replace( '_' , ' ', $name ) ) ;
      $this->wp_customize->add_section( $name , array(
        'title'    => __( $capitalized_with_space , 'wpbootstrap' ) ,
        'priority' => 0 ,
     ) ) ;     
    }

    public function image_with_slider( $name ) {
    
	$this->wp_customize->add_setting( "image_$name", array(
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

add_action( 'customize_register', 'wpbootstrap_customize_register' ) ;
function wpbootstrap_customize_register( $wp_customize ) {
  new RK_Customize_Section( 'right_panel' , $wp_customize ) ;  
  new RK_Customize_Section( 'left_panel' , $wp_customize ) ;
  new RK_Customize_Section( 'top_jumbotron' , $wp_customize ) ;
}

add_shortcode( 'panel_to_customize', 'rk_make_panel' ) ;
function rk_make_panel( $atts ) { 
    $name = $atts[ 'name' ] ; 
  ?>
    <div class="image-container" style="text-align: center">
	<img class="image_<?php echo $name ; ?> img-responsive" src='<?php echo get_theme_mod( "image_$name" ) ; ?>' width='<?php echo get_theme_mod( "image_slider_$name" ) . '%' ; ?>' >
      </div>
      <h2 class="heading_<?php echo $name ; ?>">
	<?php echo get_theme_mod( "heading_$name" ) ; ?>
      </h2>
      <span class="copy_<?php echo $name ; ?>">
 	<?php echo nl2br( get_theme_mod( "copy_$name" ) ) ; ?>         
      </span>
  <?php
}
    
function wpbootstrap_customizer_script() {
  wp_enqueue_script( 
    'wpbootstrap-customizer-script', 
    get_template_directory_uri() . '/javascript/refac-theme-options.js', 
    array( 'jquery', 'customize-preview' ), 
    '1', 
    true
  ) ;
}

add_action( 'customize_preview_init', 'wpbootstrap_customizer_script' ) ;
