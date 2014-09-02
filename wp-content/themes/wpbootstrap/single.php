<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>
<?php get_header(); ?>

<div class="row">
  <div class="col-md-8"> <!--span8 -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article  <?php post_class() ; ?>>
	<h1><?php the_title(); ?></h1>
	<p><em><?php the_time( get_option( 'date_format' ) ) ; ?></em></p>

	<?php the_content(); ?>
	<div class="clearfix">
	</div>
      </article>
      <hr>
      <?php comments_template(); ?>
      <ul class="pager">
      
        <?php /******* bwp_custom_wp_link_pages instead? */ ?>
	
        <?php echo previous_post_link( '<li>%link</li>' , '<span class="glyphicon glyphicon-chevron-left"></span> %title' ) ; ?>
        <?php echo next_post_link( '<li>%link</li>' , '%title <span class="glyphicon glyphicon-chevron-right"></span>' ) ; ?>     	      
      </ul>
    <?php endwhile; else: ?>
      <p><?php _e('Sorry, this page does not exist' ); ?></p>
    <?php endif; ?>

  </div>
  <div class="col-md-4"> <!--span4 -->
       <?php if ( dynamic_sidebar( 'main_sidebar' ) ) : endif ; ?>

  </div>
</div>

<?php get_footer(); ?>
