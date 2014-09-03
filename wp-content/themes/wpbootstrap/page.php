<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header() ; ?>
  <div class="row">
    <div class="col-md-8">
      <?php if ( have_posts() ) :  while ( have_posts() ) : the_post() ; ?>
        <?php get_template_part( 'content' , 'page' ) ; ?>
      <?php endwhile; else: 
        get_template_part( 'no-post-found' ) ; 
        get_template_part( 'bwp-posts-and-pages' ) ; 
      endif; 
      wp_reset_query() ;
      ?> 
    </div> <!-- col-md-8 -->
    <div class="col-md-4"> 
      <?php if ( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
    </div>
  </div> <!-- .row -->
<?php get_footer(); ?>
