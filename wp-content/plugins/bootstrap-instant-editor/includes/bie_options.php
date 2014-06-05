<?php

add_action( 'admin_menu' , 'bie_plugin_page' ) ;
function bie_plugin_page() {
  add_options_page(
    'Bootstrap Instant Editor Settings' ,
    'Bootstrap Instant Editor' ,	      
    'manage_options' ,
    'bie_options_page' ,
    'bie_plugin_options_page' ) ;
}

function bie_plugin_options_page() {
  ?>
  <div class="wrap">
    <?php screen_icon() ; ?>
    <h2>Bootstrap Instant Editor</h2>
    <form action="options.php" method="post">
      <?php settings_fields( 'bie_plugin_options' ) ; ?>
      <?php do_settings_sections( 'bie_options_page' ) ; ?>
      <input name="Submit" type="submit" value="Save Changes" />
    </form>
  </div>
  <?php
}

add_action( 'admin_init' , 'bie_settings_setup' ) ;
function bie_settings_setup() {
  register_setting( 'bie_plugin_options' , 'bie_plugin_options' , 'bie_plugin_validate_options' ) ;

  function bie_plugin_validate_options( $input ) {
    if ( is_numeric( $input[ 'column_amount' ] ) ) {
      $result[ 'column_amount' ] = $input[ 'column_amount' ] ;
    } else { $result[ 'column_amount' ] = "" ;
    }
    if ( is_numeric( $input[ 'output_css' ] ) ) {
      $result[ 'output_css' ] = $input[ 'output_css' ] ;
    } else { $result[ 'output_css'] = "" ;
    }
    if ( is_numeric( $input[ 'use_shortcode' ] ) ) {
      $result[ 'use_shortcode' ] = $input[ 'use_shortcode' ] ;
    } else {
      $result[ 'use_shortcode' ] = "" ;
    }
    return $result ;
  }

  add_settings_section( 'bie_plugin_primary' , 'Settings',
			  'bie_plugin_section_text', 'bie_options_page' ) ;

  function bie_plugin_section_text() {
    echo '<p>Live-edit your front page using the <a href="customize.php">Customizer</a></p>' ;
  }
  
  add_settings_field( 'bie_plugin_number_columns' , _( 'Number of columns' ) , 'bie_plugin_setting_column_output' ,
		      'bie_options_page' , 'bie_plugin_primary' ) ;

  function bie_plugin_setting_column_output() {
    $options = get_option( 'bie_plugin_options' ) ;
    $column_amount = $options[ 'column_amount' ] ;
    ?>
      <select id='bie_plugin_options' value="<?php echo $column_amount ; ?>" name='bie_plugin_options[column_amount]' >
	    <option value='2' <?php selected( $column_amount , 2 )?> >two</option>
	    <option value='3' <?php selected( $column_amount , 3 )?> >three</option>
	    <option value='4' <?php selected( $column_amount, 4 )?> >four</option>
	  </select>
    <?php
    }   	    
  
  add_settings_field( 'bie_plugin_use_shortcode' , 'Show content on front page:' , 'bie_plugin_setting_shortcode_output' , 'bie_options_page' , 'bie_plugin_primary' ) ;

  function bie_plugin_setting_shortcode_output() {
    $options = get_option( 'bie_plugin_options' ) ;
    $use_shortcode = $options[ 'use_shortcode' ] ;
    ?>
      <input type="radio" id="automatically" <?php checked( $use_shortcode , '0' ) ; ?> value="0" name="bie_plugin_options[use_shortcode]" />
      <label for="automatically">Automatically</label>
      &nbsp; 
      <input type="radio" id="use_shortcode" <?php checked( $use_shortcode , '1' ) ; ?> value="1"  name="bie_plugin_options[use_shortcode]" />
      <label for="use_shortcode" >With Shortcode</label>
    <?php if ( $use_shortcode ) {
      echo "</br></br> Enter <strong>[bie_bootstrap]</strong> in the front page text editor." ;
    }
  }

  add_settings_field( 'bie_plugin_output_css' , 'Do you have Twitter Bootstrap?' , 'bie_plugin_setting_css_output' ,
			'bie_options_page' , 'bie_plugin_primary' ) ;

  function bie_plugin_setting_css_output() {
    $options = get_option( 'bie_plugin_options' ) ;
    $output_css = $options[ 'output_css' ] ;
    ?>
    <input type="radio" id="no_output_css" <?php checked( 0 , $output_css ) ; ?> name="bie_plugin_options[output_css]" value="0" />
    <label for="no_output_css" >Yes</label>
      &nbsp; 
    <input type="radio" id="yes_output_css" <?php checked( 1 , $output_css ) ; ?> name="bie_plugin_options[output_css]" value="1">
    <label for="yes_output_css" >No</label>
    <?php if ( 1 == $output_css ) {
    	     echo "<br><br>A Bootstrap stylesheet will be added to your front page." ;
  	  }
    
      $front_page_displays = get_option( 'show_on_front' ) ;
      if ( 'page' != $front_page_displays ) {
	$uri = 'options-reading.php' ;
	?>
     	  </br></br><font color="red">Please <a href="<?php echo $uri ; ?>" >set</a> "front page displays" to "static page"</font>
	<?php 
      }	  
  }

  
} /** End function bie_settings_setup */

// Add settings link on the main plugin page
add_filter( 'plugin_action_links' , 'bie_add_settings_link' , 2 , 2 ) ;
function bie_add_settings_link( $actions, $file ) {
if ( false !== strpos( $file, 'bootstrap-instant-editor' ) ) {
    $actions[ 'settings' ] = '<a href="options-general.php?page=bie_options_page">Settings</a>' ;
    $actions[ 'customize' ] = '<a href="customize.php">Use Plugin</a>' ;
  }
  return $actions ;
}


