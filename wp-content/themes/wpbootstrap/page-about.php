<?php
/*
Template Name: About Page
*/
?>

<?php get_header(); ?>
<div class="row">
  <div class="col-md-8"> 
    <?php get_template_part( 'template', 'gallery' ) ; ?>
    <?php  echo do_shortcode( "[gallery ids='211,209,210']" ) ; ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>

  <?php endwhile; else: ?>
  <p><?php _e('Sorry, this page does not exist' ); ?></p>
  <?php endif; ?>

  </div>
  <div class="col-md-4">
    <?php get_sidebar() ;?>

  </div>
</div>

<?php get_footer(); ?>
