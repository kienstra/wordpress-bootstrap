<?php
/**
* Pro WordPress functions and definitions
* 
* @package prowordpress
*
*/

if ( ! function_exists( 'prowordpress_setup' ) ) :
  function prowordpress_setup() {
   
    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Enable support for Post Thumbnails
    add_theme_support( 'post-thumbnails' );
  }

endif;  

// prowordpress setup
add_action( 'after_setup_theme', 'prowordpress_setup' );

//Enqueue scripts and styles
function prowordpress_scripts_and_styles() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', prowordpress_scripts_and_styles' ); 

?>


// Register the menu location in your functions.php file
register_nav_menus( array( 
		    'primary' => _( 'Primary Menu', 'prowordpress' ),
		    )
		  );
<?php
// To be able to access the menu in your templates through the wp_nav_menu function 
wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' )); 

?>


// Include category IDs in body_class and post_class

function add_category_classes( $classes ) {
  global $post;
	foreach( ( get_the_category( $post->ID ) ) as $category) {
		$classes [] = 'cat-' . $category->slug;
	}
	return $classes;
}

add_filter( 'post-class', 'add_category_classes' );

function get_the_post_slug( $id ) {
  $post_data = get_post( $id, ARRAY_A );
  $slug = $post_data[ 'post_name' ];
  return $slug;
}