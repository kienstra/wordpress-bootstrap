<?php
// wp_bootstrap functions and definitionns
// @package wpbootstrap

require_once( get_template_directory() . '/inc/theme-options.php' ) ;
require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' ) ;

if( ! function_exists( 'wpbootstrap_support_setup' ) ) {
  function wpbootstrap_support_setup() {
    add_theme_support( 'automatic-feed-links' ) ;
    add_theme_support( 'menus' ) ;
    add_theme_support( 'post-thumbnails' ) ;
    add_theme_support( 'post-formats', array( 'aside', 'image',
                                              'video', 'quote', 'link' ) ) ;
    add_theme_support( 'custom-background' ) ;
  }
}
add_action( 'after_setup_theme', 'wpbootstrap_support_setup' ) ;

if ( ! function_exists( 'wpbootstrap_menu_setup' ) ) {
  function wpbootstrap_menu_setup() {
    register_nav_menu( 'main', __( 'Main Menu', 'wpbootstrap' ) ) ;
  }
}
add_action( 'after_setup_theme', 'wpbootstrap_menu_setup' ) ;
  

function simple_copyright() {
  echo "&copy" . " " . get_bloginfo( 'admin' ) . " " . date( 'Y' ) ;
}

add_action( 'wp_enqueue_scripts', 'theme_styles' ) ; 
function theme_styles() { 
  wp_enqueue_style( 'bootstrap_css' , get_template_directory_uri() . '/bootstrap/css/bootstrap-flatly.min.css' ) ;
  wp_enqueue_style( 'main_css' , get_template_directory_uri() . '/style.css' ) ;
  wp_enqueue_style( 'old-carousel', get_template_directory_uri() . '/bootstrap/css/old-carousel.css' ) ;
//  wp_enqueue_style( 'carousel', get_template_directory_uri() . '/bootstrap/css/carousel.css' ) ;
}

function theme_js() { 
  global $wp_scripts ;
  wp_register_script( 'html5_shiv' , 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js' , '' , '' , false ) ;
  wp_register_script( 'respond_js' , 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' , '' , '' , false ) ;
  wp_enqueue_script( 'bootstrap_js' , get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js' , array( 'jquery' ) , '' , true ) ;
  wp_enqueue_script( 'theme_js' , get_template_directory_uri() . '/js/theme.js' , array( 'jquery' , 'bootstrap_js' ) , '' , true ) ;  
  $wp_scripts->add_data( 'html5_shiv' , 'conditional' , 'lt IE 9' ) ;
  $wp_scripts->add_data( 'respond_js' , 'conditional' , 'lt IE 9' ) ;
}
add_action( 'wp_enqueue_scripts', 'theme_js' ) ;


/*

function wpbootstrap_scripts_with_jquery() {
	wp_enqueue_style( 'style_css' , get_template_directory_uri() . '/style.css' ) ; 
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
        wp_register_style( 'gravity-fix', get_template_directory_uri() . '/bootstrap/css/gravity-fix.css' ) ; 
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
*/

add_filter( 'login_errors', 'plain_error_message' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;

function wpbootstrap_paginate_links() {
  global $wp_query ; 
  $big = 999999999 ;  

  $pagination = paginate_links( array( 
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '/page/%#%',
    'type' => 'array' ,
    'current' => max( 1, get_query_var( 'paged' ) ),
    'total'  => $wp_query->max_num_pages,
    'prev_next' => True,
    'prev_text' => __( '&larr;Newer posts' ),
    'next_text' => __( 'Older posts &rarr;' ),
    )
  ) ;

  ?>
  <ul class="pagination">
  <?php
  if ( $pagination ) {
    foreach ( $pagination as $page ) { 
      $class = strpos( $page , 'href' ) ? 
		 'active' : 'disabled' ;
      echo " <li class='$class'>$page</li> " ;
    }
  }
  ?>
  </ul>
<?php
}

function create_widget($name, $id, $description) {
	 register_sidebar(array(
                'name'		=> __( $name ),
                'id'		=> $id,
       	        'description'	=> __( $description ),
                'before_widget'	=> '<div class="widget"> ',
                'after_widget'	=> '</div> ',
	        'before_title'	=> '<h2>',
                'after_title'	=> '</h2>'
        ));
}

function wpbootstrap_widgets_init() { 
  create_widget( 'Main Sidebar', 'main_sidebar', 'Diplays on News and Blog page' ) ;
}
add_action( 'widgets_init', 'wpbootstrap_widgets_init' ) ; 

/**
 * Replaces wp-admin menu item names
 * @author Daan Kortenbach
 */
function rename_admin_menu_items( $menu ) {
	 $menu = str_ireplace( 'Customize', 'Front Page Content', $menu );
	 return $menu;
}
add_filter('gettext', 'rename_admin_menu_items');
add_filter('ngettext', 'rename_admin_menu_items');


//add_action( 'init', 'remove_page_editor' ) ;
function remove_page_editor() { 
  remove_post_type_support( 'page', 'editor' ) ;
}

add_filter( 'upload_mimes', 'cc_mime_types' );
function cc_mime_types( $mimes ){
	 $mimes['svg'] = 'image/svg+xml';
	 return $mimes;
}

add_action( 'login_enqueue_scripts' , 'wpbootstrap_login_logo' ) ; 
function wpbootstrap_login_logo() {
?>
  <style type="text/css">
    .login #login {
      padding-top: 50px ;
    }
    #login h1 a {
      width: 100% ;
      height: 220px ;
      padding-bottom : 30px ;
      background : url( http://lorempixel.com/320/250 ) ;
      background-size : 320px 250px ;
    }
  </style>
<?php 
}

add_filter( 'login_header_url' , 'wpbootstrap_login_logo_url' ) ; 
function wpbootstrap_login_logo_url() { 
  return get_bloginfo( 'url ' ) ; 
}

add_filter( 'login_headertitle' , 'wpbootstrap_login_logo_url_title' ) ;
function wpbootstrap_login_logo_url_title() { 
  return "Bootstrap Media" ; 
} 

add_action( 'template_redirect' , 'wpbootstrap_process_simple_registration' ) ;
function wpbootstrap_process_simple_registration() {
  // Check that this is a post request
  if ( ( 'POST' === $_SERVER[ 'REQUEST_METHOD' ] ) && isset( $_POST ) && isset( $_POST[ 'simple_registration' ] ) ) {
    $email = $_POST[ 'email_address' ] ;
    if ( email_exists( $email ) || username_exists( $email ) ) { 
      wp_redirect( $_SERVER[ 'REQUEST_URI' ] . '?error=1' ) ;
      exit() ;
    } else { 
	$password = wp_generate_password( 8 ) ;
	$user = wp_create_user( $email, $password, $email ) ;
	if ( is_wp_error( $user ) ) { 
	  wp_redirect( $_SERVER[ 'REQUEST_URI' ] . '?error=1' ) ;
	  exit() ; 
	} else { 
	  wp_new_user_notification( $user, $password ) ;
	}
     }
  }  
}
  
add_action( 'template_redirect' , 'wpbootstrap_process_full_registration' ) ; 
  function wpbootstrap_process_full_registration () { 
    if ( ( 'POST' === $_SERVER[ 'REQUEST_METHOD' ] ) && isset( $_POST ) && isset( $_POST[ 'full_registration' ] ) ) {
      unset( $_POST[ 'full_registration' ] ) ;
      $userdata = array()  ;
      foreach( $_POST as $key => $value ) { 
        $userdata[ $key ] = $value ;
      }
      if ( email_exists( $userdata[ 'user_email' ] ) ) {
        wp_redirect( $_SERVER[ 'REQUEST_URI' ] . '?error=1' ) ;
	exit() ; 
      } elseif ( username_exists( $userdata[ 'user_login' ] ) ) { 
          wp_redirect( $_SERVER[ 'REQUEST_URI' ] . '?error=2' ) ; 
          exit() ; 
      } else {
          $user = wp_insert_user( $userdata ) ; 
	  if ( is_wp_error( $user ) ) { 
	    wp_redirect( $_SERVER[ 'REQUEST_URI' ] . '?error=3' ) ;
	    exit() ; 
	  } else {
	      wp_new_user_notification( $user ) ;
	      wp_signon() ; 
	      wp_redirect( home_url() ) ;
	      exit ; 
	  }
      }
    }
}

add_action( 'template_redirect' , 'wpbootstrap_process_update_user' ) ; 
function wpbootstrap_process_update_user() { 
  if ( ( 'POST' === $_SERVER[ 'REQUEST_METHOD' ] ) && isset( $_POST ) && isset( $_POST[ 'update_user_profile' ] ) ) {
   unset( $_POST[ 'update_user_profile' ] ) ; 
   $user_id = get_current_user_id() ; 
    $userdata = array( 'user_id' => $user_id ) ;
    foreach( $_POST as $key => $value ) { 
      $userdata[ $key ] = $value ; 
    }
    wp_update_user( $userdata ) ; 
    wp_redirect( $_SERVER[ 'REQUEST_URI' ] . '?update=1' ) ;
    exit() ; 
  }
}
    



