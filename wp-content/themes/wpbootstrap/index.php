<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>

<?php endwhile; else: ?>
   <?php this should go to the 404 page or its child template */  ?> 
      <p><?php _e('Sorry, no posts matched your criteria' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>
