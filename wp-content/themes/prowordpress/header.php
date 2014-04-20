<?php
/**
* Pro WordPress header file
*
*/
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>

<!-- HTML5 SHIV for IE --><!-- If using Modernizr, you can remove -->
<!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <h1>
	<a href="<?php echo home_url(); ?>">
	Pro WordPress Theme Development 
	</a>
	</h1>
</header>
