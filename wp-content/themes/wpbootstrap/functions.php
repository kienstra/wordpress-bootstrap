<?php
// wp_bootstrap functions and definitionns
// @package wpbootstrap

require( get_template_directory() . '/inc/theme-options.php' ) ;

if( ! function_exists( 'wpbootstrap_setup' ) ) {
  function wpbootstrap_setup() {
    add_theme_support( 'automatic-feed-links' ) ;
    add_theme_support( 'post-thumbnails' ) ;
    add_theme_support( 'who_knows' ) ;
    add_theme_support( 'post-formats', array( 'aside', 'image',
                                              'video', 'quote', 'link' ) ) ;
    add_theme_support( 'custom-background' ) ;
  }
}

add_action( 'after_setup_theme', 'wpbootstrap_setup' ) ;

function simple_copyright() {
  echo "&copy" . " " . get_bloginfo( 'admin' ) . " " . date( 'Y' ) ;
}

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

add_filter( 'login_errors', 'plain_error_message' ) ;

remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;

function wpbootstrap_paginate_links() {
  global $wp_query ; 
  $big = 999999999 ;  

  echo paginate_links( array( 
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '/page/%#%',
    'current' => max( 1, get_query_var( 'paged' ) ),
    'total'  => $wp_query->max_num_pages,
    'prev_next' => True,
    'prev_text' => __( '<< Newer posts' ),
    'next_text' => __( 'Older posts >>' ),
    )    
  ) ;
}

function create_widget($name, $id, $description) {
	 register_sidebar(array(
                'name'		=> __( $name ),
                'id'		=> $id,
       	        'description'	=> __( $description ),
                'before_widget'	=> ' ',
                'after_widget'	=> ' ',
	        'before_title'	=> '<h2>',
                'after_title'	=> '</h2>'
        ));

}

function wpbootstrap_register_image_picker() { 
  require_once( 'image-widget.php' ) ;
  register_widget( 'Image_Picker' ) ;
}

//add_action('widgets_init', 'wpbootstrap_register_image_picker' ) ; 

function wpbootstrap_widgets_init() { 
  create_widget('Front Page: Left Side', 'copy_left', 'Displays in the left of the front page');
  create_widget('Front Page: Right Side', 'copy_right', 'Displays in the right of the front page');
  create_widget( 'Main Sidebar', 'main_sidebar', 'Diplays on News and Blog page' ) ;

}
add_action( 'widgets_init', 'wpbootstrap_widgets_init' ) ; 



class Image_Picker extends WP_Widget
{
  function Image_Picker() {
    $widget_ops = array('classname' => 'Image_Picker', 'description' => 'Pick 2 images from media library');
    $this->WP_Widget('Image_Picker', 'Image Picker', $widget_ops);
  }

  function form($instance) {
      //WIDGET BACK-END SETTINGS
      $instance = wp_parse_args((array) $instance, array('link1' => '', 'link2' => ''));
      $link1 = $instance['link1'];
      $link2 = $instance['link2'];
      $images = new WP_Query( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image' , 'posts_per_page' => -1 ) );
      if( $images->have_posts() ){ 
          $options = array();
          for( $i = 0; $i < 2; $i++ ) {
              $options[$i] = '';
              while( $images->have_posts() ) {
                  $images->the_post();
                  $img_src = wp_get_attachment_image_src(get_the_ID());
                  $the_link = ( $i == 0 ) ? $link1 : $link2;
                  $options[$i] .= '<option value="' . $img_src[0] . '" ' . selected( $the_link, $img_src[0], false ) . '>' . get_the_title() . '</option>';
              } 
         } ?>
      <select name="<?php echo $this->get_field_name( 'link1' ); ?>"><?php echo $options[0]; ?></select>
      <select name="<?php echo $this->get_field_name( 'link2' ); ?>"><?php echo $options[1]; ?></select><?php
      } else {
            echo 'There are no images in the media library. Click <a href="' . admin_url('/media-new.php') . '" title="Add Images">here</a> to add some images';
      }

  }

  function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['link1'] = $new_instance['link1'];
      $instance['link2'] = $new_instance['link2'];
      return $instance;
  }

  function widget($args, $instance) {
      $link1 = ( empty($instance['link1']) ) ? 0 : $instance['link1'];
      $link2 = ( empty($instance['link2']) ) ? 0 : $instance['link2']; ?>

      <!-- Display images --><?php 
      if( !( $link1 || $link2 ) ) {
          echo "Please configure this widget.";
      } else { 
          if($link1) { ?><div class="sidebar-image"><img src="<?php echo $link1; ?>" height="100%" width="100%" alt="" border="0"></div><?php }
          if($link1) { ?><div class="sidebar-image"><img src="<?php echo $link2; ?>" alt=""  border="0"></div><?php }
      } 
  }
}

// Add class for Random Posts Widget
add_action( 'widgets_init', create_function('', 'return register_widget("Image_Picker");') ) ;

add_filter('gettext', 'rename_admin_menu_items');
add_filter('ngettext', 'rename_admin_menu_items');
/**
 * Replaces wp-admin menu item names
 * @author Daan Kortenbach
 */
function rename_admin_menu_items( $menu ) {
	 $menu = str_ireplace( 'Customize', 'Front Page Content', $menu );
	 return $menu;
}
