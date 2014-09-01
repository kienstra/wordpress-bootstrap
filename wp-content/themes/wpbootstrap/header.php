<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<!DOCTYPE html> 
<html>

<head>
  <meta charset="<?php bloginfo( 'charset' ) ; ?>" >
  <title><?php wp_title( '|' , 1 , 'right' ) ; bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ; ?>" >
  <?php wp_head(); ?>
</head>

<body <?php echo body_class() ; ?>>
  <?php get_template_part( 'navbar' ) ; ?>
  <?php get_template_part( 'top-banner' ) ; ?>
  <div class="container">

