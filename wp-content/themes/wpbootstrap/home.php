<?php get_header(); ?>

<div class="row">
  <div class="col-md-8"> <!--span8 -->
    <h1>News</h1>

    <?php 
    if ( have_posts() ) : 
      while ( have_posts() ) : 
        the_post() ;
        get_template_part( 'content', 'post' ) ;
      endwhile; 
     else: ?>
    <p><?php _e('Sorry, there are no posts' ); ?></p>
    <?php 
    endif; ?>
     <?php wp_reset_query() ; ?> 
    <?php wpbootstrap_paginate_links() ; ?>

  </div>
  <div class="col-md-4"> <!--span4 -->
    <?php if ( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
  </div>
</div>

<?php get_footer(); ?>
