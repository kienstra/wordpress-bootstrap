<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
<?php endwhile; else: ?>
      <p><?php _e('Sorry, no posts matched your criteria' ); ?></p>
<?php endif; ?>

<div class="row">

<!-- 
  <div class="col-md-6">
    <hr>
    <h4><em>Featured Post</em></h4>
    <div>
      <?php
        $args = array(
	        'post_type'		=> 'post' ,
		'category_name'		=> 'Show On Front Page' ,
		'posts_per_page'	=> 1 ,
		'ignore_sticky_posts'   => 1 ,
	       ) ;
	$the_query = new WP_Query( $args ) ;
        if ( $the_query->have_posts() ) : 
	  while ( $the_query->have_posts()  ) : 
	    $the_query->the_post() ; 
	    get_template_part( 'content', 'post' ) ;
	  endwhile;
	endif ; 
      ?>       
    </div>
  </div>    

<div class="col-md-6">
-->

  </div>
</div>  

<?php get_footer(); ?>
