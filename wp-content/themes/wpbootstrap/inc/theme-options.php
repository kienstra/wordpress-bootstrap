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
         <option value="<?php echo wp_get_attachment_url(); ?>" <?php selected( $this->value(), get_permalink(), false ) ; ?>">
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

function wpbootstrap_customize_register( $wp_customize ) {

    $wp_customize->add_setting( 'image_right_side', array(
	'default'    =>  '',
	'capability' => 'manage_options',
	'transport'  => 'postMessage',
        )
   ) ;

    $wp_customize->add_control( new RK_Customize_Image_Control(
    $wp_customize, 'image_right_side', 
      array( 'label' => __( 'Image', 'wpbootstrap' ),
    	   'section' => 'marketing_two',
	   'settings' => 'image_right_side'
           ) ) ) ;

   $wp_customize->add_setting( 'image_slider_right_side', array(
	'default'    =>  '',
	'capability' => 'manage_options',
	'transport'  => 'postMessage',
        )
   ) ;

    $wp_customize->add_control( new RK_Customize_Image_Slider(
    $wp_customize, 'image_slider_right_side', 
      array( 'label' => __( 'Image  Size', 'wpbootstrap' ),
    	   'section' => 'marketing_two',
	   'settings' => 'image_slider_right_side'
           ) ) ) ;

                $wp_customize->add_section( 'marketing_two', array(
			'title'    => __( 'Right Panel' ),
			'priority' => 20,
		) ) ;

		$wp_customize->add_setting( 'heading_right_side', array(
			'default'    => '',
			'transport'  => 'postMessage'			
		) );

		$wp_customize->add_control( 'heading_right_side_control', array(
			'label'      => __( 'Heading', 'wpbootstrap' ),
			'section'    => 'marketing_two',
			'settings'    => 'heading_right_side'
		) );


		$wp_customize->add_setting( 'copy_right_side', array(
			'default'    => '',
			'capability' => 'manage_options',
			'transport'  => 'postMessage',
 			'class_name' => 'copy-right-side',
		) );

		  $wp_customize->add_control( new PTD_Textarea_Control(
    $wp_customize, 'copy_right_side', 
      array( 'label'	=> __( 'Copy', 'wpbootstrap' ),
    	   'section'	=>  'marketing_two',
	   'settings'	=> 'copy_right_side',
           ) ) ) ;    

  $wp_customize->get_setting( 'copy_one' )->transport = 'postMessage' ;
}

add_action( 'customize_register', 'wpbootstrap_customize_register' ) ;

function wpbootstrap_customizer_script() {
  wp_enqueue_script( 
    'wpbootstrap-customizer-script', 
    get_template_directory_uri() . '/javascript/theme-options.js', 
    array( 'jquery', 'customize-preview' ), 
    '1', 
    true
  ) ;
}

add_action( 'customize_preview_init', 'wpbootstrap_customizer_script' ) ;


function tinymce_marketing() {
	 $settings = array( 'tinymce' => array('theme_advanced_buttons9' => 'bold, italic, ul, min_size, max_size'), 'textarea_rows' => '30', 'quicktags' => false);
	 wp_editor( '', 'market-right', $settings );
}


function my_second_editor() {
	 $settings = array( 'textarea_rows' => '30', 'quicktags' => false);
	 wp_editor( '', 'made-up', $settings );
}				     

				     