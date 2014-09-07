<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>
<?php get_header(); ?>

<div class="row">
  <div class="col-md-8"> <!--span8 -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content' , get_post_format() ) ; ?>
      <?php bwp_custom_wp_link_pages() ; ?>      
      <hr>
      <?php do_action( 'bwp_after_full_post_content' ) ; 
            bwp_maybe_echo_comments_template() ;
      ?>
      <ul class="pager">
	<?php echo previous_post_link( '<li>%link</li>' , '<span class="glyphicon glyphicon-chevron-left"></span> %title' ) ; ?>
	<?php echo next_post_link( '<li>%link</li>' , '%title <span class="glyphicon glyphicon-chevron-right"></span>' ) ; ?>     	      
      </ul>
    <?php endwhile; else:
      get_template_part( 'no-post-found' ) ;
      get_template_part( 'bwp-posts-and-pages' ) ;     
    endif ;
    ?>

  </div>
  <div class="col-md-4"> <!--span4 -->
       <?php if ( dynamic_sidebar( 'main_sidebar' ) ) : endif ; ?>

  </div>
</div>

<?php get_footer(); ?>
