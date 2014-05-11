<?php 
/*
Template Name: About Page
*/
wp_register_style( 'gravity-fix', get_template_directory_uri() . '/bootstrap/css/gravity-fix.css' ) ; 
wp_enqueue_style( 'gravity-fix' ) ;
get_header(); 

?>
<div class="row">
  <div class="col-md-8"> 

    <?php  echo do_shortcode( "[gallery ids='211,209,210,194,197,201']" ) ; ?>
    <?php echo do_shortcode( "[gallery_modal]" ) ; ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>

  <?php endwhile; else: ?>
  <p><?php _e('Sorry, this page does not exist' ); ?></p>
  <?php endif; ?>

  </div>
  <div class="col-md-4">
    <?php dynamic_sidebar( 'main_sidebar' ) ; ?>

  </div>
</div>

<?php get_footer(); ?>
