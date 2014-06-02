<?php

add_action( 'admin_menu' , 'rkbc_plugin_page' ) ;
function rkbc_plugin_page() {
  add_options_page(
    'Boostrap Customization Settings' ,
    'Bootstrap Customization' ,	      
    'manage_options' ,
    'rkbc_options_page' ,
    'rkbc_plugin_options_page' ) ;
}

function rkbc_plugin_options_page() {
  ?>
  <div class="wrap">
    <?php screen_icon() ; ?>
    <h2>Bootstrap Customization Settings</h2>
    <form action="options.php" method="post">
      <?php settings_fields( 'rkbc_plugin_options' ) ; ?>
      <?php do_settings_sections( 'rkbc_options_page' ) ; ?>
      <input name="Submit" type="submit" value="Save Changes" />
    </form>
  </div>
  <?php
}

add_action( 'admin_init' , 'rkbc_settings_setup' ) ;
function rkbc_settings_setup() {

  register_setting( 'rkbc_plugin_options' , 'rkbc_plugin_options' , 'rkbc_plugin_validate_options' ) ;

  function rkbc_plugin_validate_options( $input ) {
    if ( is_numeric( $input[ 'column_amount' ] ) ) {
      $result[ 'column_amount' ] = $input[ 'column_amount' ] ;
    } else { $result[ 'column_amount' ] = "" ;
    }
    if ( is_numeric( $input[ 'output_css' ] ) ) {
      $result[ 'output_css' ] = $input[ 'output_css' ] ;
    } else { $result[ 'output_css'] = "" ;
    }
    return $result ;
  }
  
/*  function rkbc_plugin_validate_options_css( $input ) {
    if ( is_bool( $input[ 'output_css' ] ) ) {
      $result[ 'output_css' ] = $input[ 'output_css' ] ;
    } else { $result[ 'output_css' ] = "" ;
    }
    return $result ;
  }  
*/

  add_settings_section( 'rkbc_plugin_primary' , 'Bootstrap Customization Section',
			'rkbc_plugin_section_text', 'rkbc_options_page' ) ;
  add_settings_field( 'rkbc_plugin_output_css' , 'Output CSS?' , 'rkbc_plugin_setting_css_output' ,
		      'rkbc_options_page' , 'rkbc_plugin_primary' ) ;

  function rkbc_plugin_section_text() {
    echo '<p>Put your settings in here.</p>' ;
  }

  function rkbc_plugin_setting_css_output() {
    $options = get_option( 'rkbc_plugin_options' ) ;
    $text = $options[ 'output_css' ] ;
    ?>
     <input type='checkbox' id='rkbc_plugin_options' name='rkbc_plugin_options[output_css]' value='1' <?php checked( 1, $text ) ; ?> />
  <?php
  }

  add_settings_field( 'rkbc_plugin_number_columns' , 'Number of Columns' , 'rkbc_plugin_setting_column_output' ,
		      'rkbc_options_page' , 'rkbc_plugin_primary' ) ;

  function rkbc_plugin_setting_column_output() {
    $options = get_option( 'rkbc_plugin_options' ) ;
    $column_amount = $options[ 'column_amount' ] ;
    ?>
      <select id='rkbc_plugin_options' value="<?php echo $column_amount ; ?>" name='rkbc_plugin_options[column_amount]' >
	    <option value='2' <?php selected( $column_amount , 2 )?> >two</option>
	    <option value='3' <?php selected( $column_amount , 3 )?> >three</option>
	    <option value='4' <?php selected( $column_amount, 4 )?> >four</option>
	  </select>
    <?php
  }   	    
}

add_filter( 'plugin_action_links' , 'rkbc_settings_link' , 2 , 2 ) ;
function rkbc_settings_link( $actions, $file ) {
  if ( false !== strpos( $file, 'bootstrap-customization' ) ) {
    $actions[ 'settings' ] = '<a href="options-general.php?page=rkbc_options_page">Settings</a>' ;
    $actions[ 'customize' ] = '<a href="customize.php">Use Plugin</a>' ;
  }
  return $actions ;
}


