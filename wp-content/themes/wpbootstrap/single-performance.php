<?php
get_header() ;


  $date = DateTime::createFromFormat( 'Ymd', get_field( 'performance_date' ) ) ;
  $formatted_date = $date->format( 'm/d/Y' ) ;
  $full_address = get_field( 'street_address' ) . get_field( 'city' ) . get_field( 'state' ) ;

  ?>

    <style>
      html, body, #map-canvas {
        height: 100%; 
        margin: 0px;
        padding: 0px
      }
      #map-container {
        height: 300px ;
	width: 400px ;
 	max-width: 100% ;
    </style>

  <div class="row">
    <div class="col-md-4">  
	<h3> 
	  <?php the_title() ; ?>
	</h3>
	<p>
	Venue : <?php echo get_post_meta( 'venue' ) ; ?>
	</p>
	<p>
	Date: <?php echo $formatted_date ; ?>
	</p>
	<p>
	<p>
	  <?php echo get_field( 'street_address' ) ?>
	</p>
	<p> 
	  <?php echo $full_address ;  ?>
	</p>
      <?php do_shortcode( "[google_map address='$full_address']" ) ; ?>
    </div> <!-- .col-md-4 -->
  </div> <!-- .row -->

<?php get_footer() ; 