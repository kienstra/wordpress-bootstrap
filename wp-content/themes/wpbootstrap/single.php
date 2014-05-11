<?php get_header(); ?>

<div class="row">
  <div class="col-md-8"> <!--span8 -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <p><em><?php the_time('l, F jS, Y'); ?></em></p>

      <?php the_content(); ?>

      <hr>
      <?php comments_template(); ?>
      <ul class="pager">
        <?php echo previous_post_link( '<li>%link</li>' , '<span class="glyphicon glyphicon-arrow-left"></span> %title' ) ; ?>
        <?php echo next_post_link( '<li>%link</li>' , '%title <span class="glyphicon glyphicon-arrow-right"></span>' ) ; ?>     	      

      </ul>
    <?php endwhile; else: ?>
      <p><?php _e('Sorry, this page does not exist' ); ?></p>
    <?php endif; ?>

  </div>
  <div class="col-md-4"> <!--span4 -->
       <?php get_sidebar(); ?>

  </div>
</div>

<?php get_footer(); ?>
