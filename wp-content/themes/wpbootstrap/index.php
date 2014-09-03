<?php defined('ABSPATH') or die( "No direct access!" ) ; 

get_header() ;
  ?>
  <div class="row">
    <div class="col-md-12">
      <h1><?php wp_title( '' ) ; ?></h1>
      <?php bwp_query_for_post_previews() ; ?>      
    </div>
  </div>
<?php get_footer(); ?>
