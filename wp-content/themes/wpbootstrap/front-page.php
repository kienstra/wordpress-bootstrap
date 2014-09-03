<?php defined('ABSPATH') or die( "No direct access!" ) ; 

get_header() ;

if ( have_posts() ) : while ( have_posts() ) : the_post() ; 
  the_content() ; 
  endwhile; else:
  ?>
    <p><?php _e('Sorry, no posts matched your criteria' ); ?></p>
<?php endif; ?>

<div class="row">
</div>

<?php get_footer(); ?>
