<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header() ; ?>
  <div class="row">
    <div class="col-md-8">
      <h1>
        <?php the_title( ) ; ?>
	&nbsp;
	<?php
	  if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) {
	    edit_post_link( '<span class="glyphicon glyphicon-pencil"></span>' ) ;
	  }
	?>
      </h1>
      <?php if ( have_posts() ) :  while ( have_posts() ) : the_post() ; ?>
	<article <?php post_class( 'post' ) ; ?>>
	  <?php the_content() ; ?>
	  <?php bwp_custom_wp_link_pages() ; ?>
	  <hr>
	</article>
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
  </div>
<?php get_footer(); ?>
