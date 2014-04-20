<?php 
// wp_bootstrap functions and definitionns
// @package prowordpress

if ( class_exists( 'WP_Customize_Control' ) ) {
  class PTD_Textarea_Control extends WP_Customize_Control {
    public function render_content() { 
      ?>
      <label>
	<span class="customize-control-title">
	  <?php echo esc_html( $this->label ) ; ?>
	</span>
	<textarea class="large-text" cols="20" rows="10" <?php $this->link() ; ?>>
	<?php echo esc_textarea( $this->value() ) ; ?>
	</textarea>
      </label>
      <?php 
      }
   }
}

function wpbootstrap_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'copy_one' )-> transport = 'postMessage' ;

      $wp_customize->add_setting( 'copy_one_heading', array( 
  		      		  	 'default' => '',
					 'type' => 'option', 		
					 'transport' => 'postMessage', 
					  )
    ) ;
    $wp_customize->add_control( 'marketing_heading_control', 
          array( 'label' => __( 'Marketing Heading', 'wpbootstrap' ),
    	   'section' => 'wpbootstrap_marketing_copy',
	   'settings' => 'copy_one_heading',
         )
    ) ;
    

    $wp_customize->add_section( 'wpbootstrap_marketing_copy', array( 
     	'title' => __( 'Marketing Copy', 'wpbootstrap' ) ,
	'description' => __( 'Front page marketing copy', 'wpbootstrap' ) ,
	'priority' => 21 ,
 	)
    ) ;

  $wp_customize->add_setting( 'copy_one', array( 
  		      		  	 'default' => '',
					 'transport' => 'postMessage', 
					  )
  ) ;
  
  $wp_customize->add_control( new PTD_Textarea_Control(
    $wp_customize, 'marketing_copy_control', 
      array( 'label' => __( 'Marketing Copy', 'wpbootstrap' ),
    	   'section' => 'content_wpbootstrap_marketing_copy',
	   'settings' => 'copy_one',
      )
    )
  ) ;

   $wp_customize->add_section( 'content_wpbootstrap_marketing_copy', array( 
     	'title' => __( 'Child Marketing Copy', 'wpbootstrap' ) ,
	'description' => __( 'Content of marketing copy', 'wpbootstrap' ) ,
	'priority' => 1 ,
	'parent' =>'marketing_copy'
 	)
    ) ;

  $wp_customize->add_section( 'marketing_two', array(
			'title'    => __( 'Marketing Copy, Right' ),
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



    $wp_customize->add_control( 'marketing_heading_control', 
          array( 'label' => __( 'Marketing Heading', 'wpbootstrap' ),
    	   'section' => 'wpbootstrap_marketing_copy',
	   'settings' => 'copy_one_heading',
         )
    ) ;
		$wp_customize->add_setting( 'copy_right_side', array(
			'default'    => '',
			'capability' => 'manage_options',
			'transport'  => 'postMessage'
		) );

		  $wp_customize->add_control( new PTD_Textarea_Control(
    $wp_customize, 'copy_right_side', 
      array( 'label' => __( 'Right Side Marketing Copy', 'wpbootstrap' ),
    	   'section' => 'marketing_two',
	   'settings' => 'copy_right_side',
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
				     