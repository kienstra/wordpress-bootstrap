<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header(); ?>
<div class="row">
  <div class="col-md-8">
    <h1><?php wp_title('') ; ?></h1>
  <?php if ( have_posts() ) :  while ( have_posts() ) : the_post() ; ?>
    <?php get_template_part( 'content' , 'post-preview' ) ; ?>
  <?php  endwhile; else: ?>
    <p><?php _e('Sorry, there are no posts' ); ?></p>
    <?php 
    endif; ?>
     <?php wp_reset_query() ; ?> 
    <?php bwp_paginate_links() ; ?>
  </div>
  <div class="col-md-4"> <!--span4 -->
    <?php if ( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
  </div>
</div>

<?php get_footer(); ?>
