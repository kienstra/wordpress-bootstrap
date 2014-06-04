<?php 
/*
Template Name: Performances
*/

get_header() ;
// bad hack:
wp_enqueue_style( 'gravity-fix' ) ;
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
<?php
//echo do_shortcode( '[google_map address="1219 W. 27th St Los Angeles,CA"]' ) ;
?>
  <h2>Upcoming Performances</h2>
<?php

  $args = array( 'post_type' => 'performance' ,
  	  	 'meta_key' => 'performance_date' ,
		 'posts_per_page' => -1 ,
		 'orderby' => 'meta_value_num' ,
		 'order' => 'ASC' ,
		 ) ;

  $perf_query = new WP_Query( $args ) ;
  if ( $perf_query->have_posts() ) : while ( $perf_query->have_posts() ) : $perf_query->the_post() ;

  $date = DateTime::createFromFormat( 'Ymd', get_field( 'performance_date' ) ) ;
  $formatted_date = $date->format( 'm/d/Y' ) ;
  $full_address = get_field( 'street_address' ) . get_field( 'city' ) . get_field( 'state' ) ;
  ?>
<div class="row" id="single-performance"> 
   <div class="col-md-6">

       <a href="<?php the_permalink() ; ?>">
	  <h3>
	    <?php the_title() ; ?>
	  </h3>
       </a>

     <p>
	<?php echo $formatted_date ; ?>
     </p>
       Venue : <?php echo get_post_meta( 'venue' ) ; ?>
     </p>
      <a href ="<?php the_permalink() ; ?>">
	<?php echo get_field( 'street_address' ) ?>
	<br>
	<?php echo get_field( 'city' ) . ", " . get_field( 'state' ) ?>
      </a>
    </div> <!-- col-md-6 -->
    <div class="col-md-6" id="performance-image" >
      <br>
      <img src="http://localhost/wordpress/wp-content/uploads/2014/04/drwattz-one-1024x5617-150x150.png" alt="Sample Image">
    </div>       
</div>

<?php
  endwhile ; 
  endif ;
  wp_reset_postdata() ;
?>
</div> <!-- div.col-md-8 -->


<div class="col-md-4">
  <?php if( dynamic_sidebar( 'main_sidebar' ) ) ; ?>
</div> 

</div> <!-- div.row -->
</div> <!-- div.container -->

<?php
get_footer() ; 

?>