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

  register_setting('rkbc_plugin_options' , 'rkbc_plugin_options' ,
	   'rkbc_plugin_validate_options' ) ;
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
    $is_checked = ( true == $text || 1 == $text ) ? 'checked' : '' ;
    echo "<input id='text_string' name='' type='checkbox' '{${checked($text, 'true' ) }}' value={${checked( $text, true ) }} />";
  }

  add_settings_field( 'rkbc_plugin_number_columns' , 'Number of Columns' , 'rkbc_plugin_setting_column_output' ,
		      'rkbc_options_page' , 'rkbc_plugin_primary' ) ;

  function rkbc_plugin_setting_column_output() {
    $options = get_option( 'rkbc_plugin_options' ) ;
    $column_amount = $options[ 'column_amount' ] ;
    ?>
      <select id='column_amount' name='rkbc_plugin_options[column_amount]' >
	    <option value='two' <?php selected( $column_amount, 'two' )?> >two</option>
	    <option value='three' <?php selected( $column_amount, 'three' )?> >three</option>
	    <option value='four' <?php selected( $column_amount, 'four' )?> >four</option>
	  </select>
    <?php
  }   	    
}

    

