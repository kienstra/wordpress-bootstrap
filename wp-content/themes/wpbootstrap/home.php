<?php get_header(); ?>

<div class="row">
  <div class="col-md-8"> <!--span8 -->
    <h1>News</h1>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p><em><?php the_time('l, F jS, Y'); ?></em></p>
    <?php the_excerpt() ;?>
    <a href="<?php the_permalink(); ?>">More &raquo</a>
    <hr>
    <?php endwhile; else: ?>
    <p><?php _e('Sorry, there are no posts' ); ?></p>
    <?php endif; ?>
     <?php wp_reset_query() ; ?> 
    <?php wpbootstrap_paginate_links() ; ?>

  </div>
  <div class="col-md-4"> <!--span4 -->
       <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>
