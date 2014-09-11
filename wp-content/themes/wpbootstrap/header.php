<?php defined( 'ABSPATH' ) or die( "No direct access!" ) ; ?>

<!DOCTYPE html> 
<html <?php esc_attr( language_attributes( 'html' ) ) ; ?>>
  <head>
    <meta charset="<?php esc_attr( bloginfo( 'charset' ) ) ; ?>" >
    <title>
      <?php
        if ( ! has_filter( 'wp_title' ) ) {
          wp_title( '|' , true , 'right' ) ; bloginfo( 'name' ) ;
        } else {
          wp_title( '' ) ;
        }
      ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ) ; ?>" >
    <!-- style.css enqueued in functions.php using get_stylesheet_uri() -->
    <?php wp_head(); ?>
  </head>
  <body <?php echo esc_attr( body_class() ) ; ?>>
    <?php bwp_maybe_get_top_nav() ; ?>
    <div class="container">




