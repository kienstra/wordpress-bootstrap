<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header() ; ?>
  <div class="row">
    <div class="col-md-8">
      <h1><?php wp_title() ; ?></h1>
    <?php if ( have_posts() ) :  while ( have_posts() ) : the_post() ; ?>
	<article <?php post_class( 'post' ) ; ?>>
	  <?php the_content() ; ?>
	  <hr>
	</article>
    <?php endwhile; else: ?>
      <?php get_template_part( 'no-post-found' ) ; ?>
    <?php endif; ?>
    <?php wp_reset_query() ; ?> 
      <?php wpbootstrap_paginate_links() ; ?>
    </div> <!-- col-md-8 -->
    <div class="col-md-4"> 
      <?php if ( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
    </div>
  </div>
<?php get_footer(); ?>
