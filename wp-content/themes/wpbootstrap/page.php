<?php get_header(); ?>

<div class="row">
  PAGE.PHP
  <div class="col-md-8">
    <h1><?php wp_title('') ; ?></h1>
  
  <?php if ( have_posts() ) :  while ( have_posts() ) : the_post() ; ?>
      <article class="post">
        <h2><a href="<?php the_permalink() ; ?>"><?php the_title() ; ?></a></h2>
      <p><em>
        By: <?php the_author() ; ?>
        on: <?php the_time( 'l, F jS, Y' ) ; ?>
	in: <?php the_category( ', ' ) ; ?>,
	<?php if ( have_comments() ) : ?>
	<a href="<?php comments_link() ; ?>"><?php comments_number() ; ?></a>
	<?php endif ; ?>
      </em></p>
      <?php the_excerpt() ; ?>
      <hr>
      </article>
  <?php  endwhile; else: ?>
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
