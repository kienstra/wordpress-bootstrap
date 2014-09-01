<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header(); ?>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php wpbootstrap_paginate_links() ; ?>
  <?php endwhile; else: ?>
    <?php get_template_part( 'no-post-found' ) ; ?>
  <?php endif; ?>
<?php get_footer(); ?>

