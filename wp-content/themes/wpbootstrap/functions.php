<?php
// wp_bootstrap functions and definitionns
// @package wpbootstrap

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
}

function theme_js() { 
  global $wp_scripts ;
  wp_register_script( 'html5_shiv' , 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js' , '' , '' , false ) ;
  wp_register_script( 'respond_js' , 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' , '' , '' , false ) ;
  wp_enqueue_script( 'bootstrap_js' , get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js' , array( 'jquery' ) , '' , true ) ;
  $wp_scripts->add_data( 'html5_shiv' , 'conditional' , 'lt IE 9' ) ;
  $wp_scripts->add_data( 'respond_js' , 'conditional' , 'lt IE 9' ) ;
}
add_action( 'wp_enqueue_scripts', 'theme_js' ) ;

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

function rk_register_sidebar($name, $id, $description ) {
       register_sidebar(array(
	      'name'		=> __( $name ) ,
	      'id'		=> $id ,
	      'description'	=> __( $description ) ,
	      'before_widget'	=> '<div class="widget"> ' ,
	      'after_widget'	=> '</div> ' ,
	      'before_title'	=> '<h2>' ,
	      'after_title'	=> '</h2>' ,
      ) ) ;
}
  
add_action( 'widgets_init', 'wpbootstrap_widgets_init' ) ; 
function wpbootstrap_widgets_init() { 
  rk_register_sidebar( 'Main Sidebar' , 'main_sidebar', 'Diplays on News and Blog page' ) ;
  rk_register_sidebar( 'Sidebar Test' , 'sidebar_test' , 'Bootstrap row' ) ;
  rk_register_sidebar( 'Second Sidebar Test' , 'second_sidebar_test' , 'Bootstrap row' ) ;
  rk_register_sidebar( 'Third Sidebar Test' , 'third_sidebar_test' , 'Bootstrap row' ) ;   
}


			    

/**
 * Replaces wp-admin menu item names
 * @author Daan Kortenbach
 */
function rename_admin_menu_items( $menu ) {
	 $menu = str_ireplace( 'Customize', 'Front Page Content', $menu );
	 return $menu;
}

//add_filter('gettext', 'rename_admin_menu_items');

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
    


function replace_parenthesized_number_with_badge_number( $paren_number ) {
  $regex = '/\(([0-9]{1,3})\)/' ;
  if ( preg_match( $regex , $paren_number , $matches ) ) {
    $new_count_markup = "<span class='badge pull-right'>{$matches[ 1 ]}</span>" ;
    $badge_number = str_replace( $matches[ 0 ] , $new_count_markup , $paren_number ) ;
  }
  return $badge_number ; 
}  
  
add_filter( 'widget_title' , 'bgm_widget_title' ) ;
function bgm_widget_title( $args ) {
  echo "the title args are: " ;
  var_dump( $args )  ;
//  $args = str_replace( '<ul' , '<ul class="nav nav-pills nav-stacked"' , $args ) ;
  return $args ; 
}

//add_filter( 'widget_categories_args' , 'bgm_widget_categories_args' ) ;
function bgm_widget_categories_args( $args ) {
}

//add_filter( 'widget_archives_args' , 'bgm_widget_archives_args' ) ;
function bgm_widget_archives_args( $args ) {
 return $args ;
}



/******* original
function bgm_get_archives_link( $link ) {
  $link = replace_parenthesized_number_with_badge_number( $link ) ;
  $link = remove_li_tags( $link ) ;
  $link = add_list_group_class_to_anchor_tags( $link ) ;    
  $link = move_span_inside_anchor_closing_tag( $link ) ;
  return $link ;
  }
*/


function bgm_list_categories_args( $markup ) {
  $container = "" ; 
  $markup = replace_parenthesized_number_with_badge_number( $args ) ;
  echo "categories callback returns: ";
  var_dump( $parens_replaced_by_badges ) ; 
  return $markup ; 
}

add_filter( 'wp_list_categories' , array( 'BGM_Get_Categories_Link' , 'get_link' ) ) ; 
add_filter( 'get_archives_link' , array( 'BGM_Get_Archives_Link' , 'get_link' ) ) ;


class BGM_Get_Categories_Link extends BGM_Get_Link {
  private static $instance_count = 0 ;
  private static $instance ;
  public $markup ;
  
  private function __construct(  ) {
    $this->markup = "" ;
  }
}

class BGM_Get_Archives_Link extends BGM_Get_Link {
  private static $instance_count = 0 ;
  private static $instance ;
  public $markup ;
  
  private function __construct(  ) {
    $this->markup = "" ;
  }
}

class BGM_Get_Link {
  private static $instance_count = 0 ;
  private static $instance ;
  public $markup ;
  
  private function __construct() {
    $this->markup = "" ;
  }

  function get_link( $markup ) {
    self::$instance = new self() ; 
    self::$instance->close_ul_and_add_opening_div_if_first_call() ;
    self::$instance->markup .= $markup ;     
    self::$instance->replace_parenthesized_number_with_badge_number() ;
    self::$instance->remove_li_tags() ; 
    self::$instance->add_list_group_class_to_anchor_tags() ; 
    self::$instance->move_span_inside_anchor_closing_tag() ;
    self::$instance_count++ ;      
    return self::$instance->markup ;
  }

  function close_ul_and_add_opening_div_if_first_call() {
    if ( 0 == self::$instance_count ) {
      $this->markup .= '</ul><div class="list-group">' ;
    }
  }
  
  function replace_parenthesized_number_with_badge_number() {
  $regex = '/\(([0-9]{1,3})\)/' ;
  if ( preg_match( $regex , $this->markup , $matches ) ) {
    $new_count_markup = "<span class='badge pull-right'>{$matches[ 1 ]}</span>" ;
    $this->markup = str_replace( $matches[ 0 ] , $new_count_markup , $this->markup ) ;
    }
  }

  function remove_li_tags() {
    $regex = '/<li.*?>/' ;
    $this->markup =  preg_replace( $regex  , '' , $this->markup ) ;
  }

  function add_list_group_class_to_anchor_tags() {
    $this->markup = str_replace( '<a' , '<a class="list-group-item"' , $this->markup ) ;
  }

  function move_span_inside_anchor_closing_tag() {
    $regex = "/(<span.+?<\/span>)/" ; 
    if ( preg_match( $regex, $this->markup , $matches ) ) {
      $this->markup = str_replace( array( $matches[ 1 ] , '&nbsp;' ) , '' , $this->markup ) ;    
      $this->markup = str_replace( '</a>' , $matches[ 1 ] . '</a>' , $this->markup ) ;
    }
  }
}

add_filter( 'widget_archives_args' , 'rkbc_archives_filter' ) ;
function rkbc_archives_filter( $args ) {
  $args[ 'after_widget' ] = '</div>' ;
  return $args ;
}



function remove_li_tags( $markup ) {
  $markup = str_replace( '<li>' , '' , $markup ) ;
  return $markup ;
}

function add_list_group_class_to_anchor_tags( $markup ) {
  $markup = str_replace( '<a' , '<a class="list-group-item"' , $markup ) ;
  return $markup ;
}

function move_span_inside_anchor_closing_tag( $markup ) {
  $regex = "/(<span.+?<\/span>)/" ;  //"/(<\/a>).+?(<span)/" ; // [.]?(<span class='badge)/" ;
  if ( preg_match( $regex, $markup , $matches ) ) {
    $markup = str_replace( array( $matches[ 1 ] , '&nbsp;' ) , '' , $markup ) ;    
    $markup = str_replace( '</a>' , $matches[ 1 ] . '</a>' , $markup ) ;
  }
  return $markup ;
}
    


  
