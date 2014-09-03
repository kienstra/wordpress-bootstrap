<?php 
/*
Template Name: With Sidebar
*/

defined('ABSPATH') or die( "No direct access!" ) ; 

get_header() ;
?>
  <div class="row">
    <div class="col-md-8">
      <?php bwp_query_for_page_content() ; ?>
    </div> <!-- col-md-8 -->
    <div class="col-md-4"> 
      <?php if ( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
    </div>
  </div> <!-- .row -->
<?php get_footer(); ?>
