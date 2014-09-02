<?php defined('ABSPATH') or die( "No direct access!" ) ; 

get_header() ;
  if ( have_posts() ) : while ( have_posts() ) : the_post() ;
  ?>
    <h1><?php the_title() ; ?></h1>
  <?php the_content() ; 
  wpbootstrap_paginate_links() ;
  endwhile ; else : 
    get_template_part( 'no-post-found' ) ; 
    get_template_part( 'bwp-posts-and-pages' ) ; 
  endif ;
get_footer() ; 

