<?php
// wp_bootstrap functions and definitionns
// @package wpbootstrap

add_action('after_setup_theme', 'bwp_text_domain');
function bwp_text_domain() { 
  load_theme_textdomain( 'wpbootstrap' , get_template_directory() . '/languages' ) ;
}

add_action( 'after_setup_theme', 'bwp_support_setup' ) ;
function bwp_support_setup() {
  add_theme_support( 'automatic-feed-links' ) ;
  add_theme_support( 'menus' ) ;
  add_theme_support( 'post-thumbnails' ) ;
  add_theme_support( 'post-formats', array( 'aside', 'image',
					    'video', 'quote', 'link' ) ) ;
  add_theme_support( 'custom-background' ) ;
}

add_action( 'after_setup_theme', 'wpbootstrap_menu_setup' ) ;
if ( ! function_exists( 'wpbootstrap_menu_setup' ) ) {
  function wpbootstrap_menu_setup() {
    register_nav_menu( 'main', __( 'Main Menu', 'wpbootstrap' ) ) ;
  }
}

function bwp_maybe_get_top_nav() {
  if ( should_page_have_top_and_bottom_navs() ) { 
    get_template_part( 'navbar-top' ) ; 
    get_template_part( 'top-banner' ) ;
  }
}

function bwp_maybe_get_bottom_nav() {
  if ( should_page_have_top_and_bottom_navs() ) {
    get_template_part( 'navbar-bottom' ) ;
  }
}

function should_page_have_top_and_bottom_navs() {
  if ( is_page() && ( strpos( get_page_template() , 'no-nav' ) ) ) {
    return false ;    
  }
  return true ;
}

require_once( get_template_directory() . '/inc/wp_bootstrap_navwalker.php' ) ;

add_action( 'wp_enqueue_scripts', 'bwp_enqueue_styles' ) ;
function bwp_enqueue_styles() {
  $main_bootstrap_css_path = apply_filters( 'bwp_css_for_bootstrap' , get_template_directory_uri() . '/bootstrap/css/bootstrap-basic.min.css' ) ;
  wp_enqueue_style( 'bootstrap_css' , $main_bootstrap_css_path ) ;
  wp_enqueue_style( 'main_css' , get_template_directory_uri() . '/style.css' ) ;
}

add_action( 'wp_enqueue_scripts', 'bwp_enqueue_js' ) ;
function bwp_enqueue_js() { 
  global $wp_scripts ;
  wp_register_script( 'html5_shiv' , 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js' , '' , '' , false ) ;
  $wp_scripts->add_data( 'html5_shiv' , 'conditional' , 'lt IE 9' ) ;  
  wp_register_script( 'respond_js' , 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js' , '' , '' , false ) ;
  $wp_scripts->add_data( 'respond_js' , 'conditional' , 'lt IE 9' ) ;
  wp_enqueue_script( 'jquery' ) ;
  
  $main_bootstrap_js_path = apply_filters( 'bwp_js_for_bootstrap' , get_template_directory_uri() . '/bootstrap/js/new-bootstrap.min.js' ) ;
  wp_enqueue_script( 'bootstrap_js' , $main_bootstrap_js_path , array( 'jquery' ) , '' , true ) ;
}

if ( ! isset( $content_width ) ) {
   $content_width = 600 ;
}

add_action( 'comment_form' , 'bwp_maybe_enqueue_comment_reply' ) ;  // comment_form_before
function bwp_maybe_enqueue_comment_reply() {
  if ( get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' ) ;
  }
}

add_filter( 'login_errors', 'plain_error_message' ) ;
remove_action( 'wp_head', 'rsd_link' ) ;
remove_action( 'wp_head', 'wp_generator' ) ;
remove_action( 'wp_head', 'wlwmanifest_link' ) ;


function bwp_simple_copyright() {
  $name = apply_filters( 'bwp_name_next_to_copyright_in_footer' , sprintf( __( '%s' , 'wpbootstrap' ) , get_bloginfo( 'admin' ) ) ) ; 
  echo "&copy" . " " . $name . " " . date( 'Y' ) ;
}

function wpbootstrap_paginate_links() {
  global $wp_query ;
  $bwp_big = 999999999 ;
  
  $pagination_args = array( 
    'base' => str_replace( $bwp_big, '%#%', esc_url( get_pagenum_link( $bwp_big ) ) ),
    'format' => '/page/%#%',
    'type' => 'array' ,
    'current' => max( 1, get_query_var( 'paged' ) ),
    'total'  => $wp_query->max_num_pages,
    'prev_next' => True,
    'prev_text' => sprintf( __( '%sNewer' , 'wpbootstrap' ) , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ) ,
    'next_text' => sprintf( __( 'Older%s' , 'wpbootstrap' ) , '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ,
  ) ; 
  
  $pagination = paginate_links( $pagination_args ) ;  
  ?>
  <ul class="pagination pagination-med">
  <?php
  if ( $pagination ) {
    foreach ( $pagination as $page ) {
    $class = strpos( $page , 'href' ) ? 'active' : 'disabled' ;
      echo " <li class='$class'>$page</li> " ;
    }
  }
  ?>
  </ul>
<?php
}

function bwp_custom_wp_link_pages() {
  $bwp_link_pages_args = array(
    'before' => '<ul class="pagination">' ,
    'after'  => '</ul>' ,
    'link_before' => '<li>' ,
    'link_after' => '</li>' ,
    'previouspagelink' => sprintf( __( '%sBack' , 'wpbootstrap' ) , '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' ) ,
    'nextpagelink' => sprintf( __( 'Next%s' , 'wpbootstrap' ) , '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ,
    'next_or_number' => 'next' ,
  ) ; 
  wp_link_pages( $bwp_link_pages_args ) ;
}

add_filter( 'wp_link_pages_link' , 'bwp_pages_link_filter' ) ;
function bwp_pages_link_filter( $link_markup ) {
  $regex = '/(<a[^>]*?>).*?(<li[^>]??>)(.*)/' ;
  $replace_with = '$2$1$3' ; 
  $filtered_markup = preg_replace( $regex , $replace_with , $link_markup ) ;
  return $filtered_markup ;
}

function bwp_author_date_category_tag() {
  ?>
  <em>
    By:
    <?php the_author() ; ?>
    on:
    <?php the_time( get_option( 'date_format' ) ) ; ?>  
    in:
    <?php the_category( ', ' ) ; 
    if ( has_category() && has_tag() ) {
      echo ', ' ; 
    }
    the_tags( '' , ', ' , '' ) ; ?>
  </em>
  <?php
}

function rk_register_sidebar($name, $id, $description ) {
  register_sidebar(array(
	 'name'		=> __( $name ) ,
	 'id'		=> $id ,
	 'description'	=> __( $description ) ,
	 'before_widget'	=> '<div id="%1$s" class="widget %2$s">' ,
	 'after_widget'	=> '</div> ' ,
	 'before_title'	=> '<h2>' ,
	 'after_title'	=> '</h2>' ,
  ) ) ;
}
  
add_action( 'widgets_init', 'wpbootstrap_widgets_init' ) ; 
function wpbootstrap_widgets_init() { 
  rk_register_sidebar( 'Main Sidebar' , 'main_sidebar', 'Diplays on News and Blog page' ) ;
}

add_filter( 'upload_mimes', 'cc_mime_types' );
function cc_mime_types( $mimes ){
	 $mimes['svg'] = 'image/svg+xml';
	 return $mimes;
}


/*
add_action( 'login_enqueue_scripts' , 'bwp_login_logo' ) ; 
function bwp_login_logo() {
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

*/

add_filter( 'login_header_url' , 'bwp_login_logo_url' ) ; 
function bwp_login_logo_url() { 
  return get_bloginfo( 'url ' ) ; 
}

add_filter( 'login_headertitle' , 'bwp_login_logo_url_title' ) ;
function bwp_login_logo_url_title() { 
  return sprintf( __( '%s' , 'wpbootstrap' ) , bloginfo( 'name' ) ) ; 
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

add_filter( 'comment_reply_link' , 'bwp_reply_link' ) ;
function bwp_reply_link( $link_class ) {
  $link_class = str_replace( "class='comment-reply-link" , "class='comment-reply-link btn btn-default btn-med" , $link_class ) ;
  return $link_class ;
}

function bwp_comment_list( $comment , $arguments , $depth ) {
  $_GLOBALS[ 'comment' ] = $comment ;

  ?>
  <li <?php echo comment_class( 'media' ) ; ?> id="comment-<?php echo comment_ID() ?>">
        <article>
	  <div class="meta-comment pull-left"> 
  	    <?php echo get_avatar( $comment , 96 ) ; ?>
	  </div> 
	  <div class="content-comment media-body">
	    <p class="date-comment pull-right text-right text-muted">
	      <?php echo human_time_diff( get_comment_time( 'U' ) , current_time( 'timestamp' ) ) ; ?> ago &nbsp;
	      <a class="permalink-comment" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ; ?>" title="Comment link">
	        <span class="glyphicon glyphicon-link"></span>
	      </a>
	    </p>
	    <?php if ( '0' == $comment->comment_approved ) : ?>	    
              <em>
	        <?php _e( 'The comment is in the queue for moderation' ) ; ?>
	      </em>
	    <?php endif ; ?>
	    <p><?php echo comment_author_link() ; ?></p>
	    <?php comment_text() ; ?>             
	    <div class="reply-comment pull-right">
	      <?php comment_reply_link( array_merge( $arguments , array(
	         'reply_text' => '<span class="glyphicon glyphicon-pencil"></span> &nbsp; Reply' ,
		 'depth'     =>  $depth ,
		 'max_depth' =>  $arguments[ 'max_depth' ] ,
	      ) ) ) ;
	      ?>
	    </div>
	  </div> <!-- content-comment -->
	</article>

<?php
}

add_filter( 'get_avatar' , 'bwp_class_avatar' ) ;
function bwp_class_avatar( $avatar_class ) {
  $avatar_class = str_replace( "class='avatar" , "class='avatar img-circle img-responsive media-object" , $avatar_class ) ;
  return $avatar_class ;
}
  
function bwp_echo_list_group_of_pages( $posts ) {
  echo '<div class="list-group">' ;	   
  foreach( $posts as $post ) {             
    echo '<a class="list-group-item" href="' . get_permalink( $post->ID ) . '">' . $post->post_title . '</a>' ;
  }
  echo '</div>' ;
}

add_filter( 'get_image_tag_class' , 'bwp_image_tag_class_filter' ) ;
function bwp_image_tag_class_filter( $classes ) {
  return $classes . ' img-responsive' ;
}


add_filter( 'single_cat_title' , 'bwp_filter_single_category_title' ) ;
function bwp_filter_single_category_title( $title ) {
  return sprintf( __( 'Category: %s ' , 'wpbootstrap' ) , ucwords( $title ) ) ; 
}

add_filter( 'wp_title' , 'bwp_filter_title' ) ;
function bwp_filter_title( $title ) {
  if ( is_archive() && ! is_category() ) {
    return sprintf( __( 'Archives: %s' , 'wpbootstrap' ) , get_the_date( 'F Y' ) ) ;  
  }
  return $title ;
}


// use to output body of pop-up
//add_filter( 'the_content' , 'bwp_content_filter' ) ;
function bwp_content_filter( $content ) {
  if ( is_page( 'home' ) ) {
    return "here is some more content" ;
  }
}

add_filter( 'wp_tag_cloud' , 'bwp_filter_tag_cloud' ) ; 
function bwp_filter_tag_cloud( $markup ) {
  $regex = '/(<a[^>]+?>)([^<]+?)(<\/a>)/' ;
  $replace_with = "$1<span class='label label-primary'>$2</span>$3" ;
  $markup = preg_replace( $regex , $replace_with , $markup ) ; 
  return $markup ;
}

add_filter( 'widget_archives_args' , 'bwp_limit_archives_count' ) ; 
function bwp_limit_archives_count( $args ) {
  $args[ 'limit' ] = '6' ;
  return $args ; 
}

add_filter( 'widget_categories_args' , 'bwp_widget_categories_filter' ) ;
function bwp_widget_categories_filter( $args ) {
  $args[ 'number' ] = 6 ;
  $args[ 'orderby' ] = 'count' ;      
  $args[ 'order' ] = 'DESC' ;
  return $args ; 
}
