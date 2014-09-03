<?php defined( 'ABSPATH' ) or die( "No direct access!" ) ; ?>

<!DOCTYPE html> 
<html>
  <head>
    <meta charset="<?php bloginfo( 'charset' ) ; ?>" >
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
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ; ?>" >
    <?php wp_head(); ?>
  </head>
  <body <?php echo body_class() ; ?>>
    <?php bwp_maybe_get_top_nav() ; ?>
    <div class="container">




