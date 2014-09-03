<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header(); ?>
<div class="row">
  <div class="col-md-8">
    <h1><?php wp_title('') ; ?></h1>
  <?php if ( have_posts() ) :  while ( have_posts() ) : the_post() ; ?>
          <article <?php post_class( 'post-preview' ) ; ?>>
	    <a href="<?php the_permalink() ; ?>">
      	      <?php  the_post_thumbnail(
	      '' , array( 'class' => 'pull-right img-responsive img-rounded home-wp-post-image home-featured-image' ) ) ;  ?>
	    </a>
	    <h2>
	      <a href="<?php the_permalink() ; ?>"><?php the_title() ; ?></a>
      	    </h2>
	    <p>
	        <?php bwp_author_date_category_tag() ; ?>
		<a href=<?php the_permalink() ; ?>" class="mobile-post-permalink">
		  <span class="glyphicon glyphicon-chevron-right">
		</a>
	    </p>
	    <?php the_excerpt() ; ?>

         <hr>
        </article>	  
   
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
