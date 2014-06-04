<?php get_header() ; 

wp_register_style( 'carousel', get_template_directory_uri() . '/bootstrap/css/carousel.css' ) ;
wp_enqueue_style( 'carousel' ) ;


?>
<!--
<a data-toggle="modal" id="image-modal" href="#gallery-modal" class="">
  <img data-src="http://localhost/wordpress/wp-content/uploads/2014/04/drwattz-two-150x1503.png" alt="Gallery launching image">
</a>


<div id="gallery-modal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true">
	  &times;
	</button>
nn	<h4>Carousel Inside Modal</h4>
      </div>
      <div>
-->
	<div id="gallery-carousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#gallery-carousel" data-slide-to="0" class="active"></li>
	    <li data-target="#gallery-carousel" data-slide-to="1"></li>
	    <li data-target="#gallery-carousel" data-slide-to="2"></li>
	  </ol>
	  <div id="carousel-inner">
	    <div class="item active">
	      <img data-src="http://localhost/wordpress/wp-content/uploads/2014/04/drwattz-three-300x1824.png">
	      <div class="container">
		<div class="carousel-caption">
		</div>
	      </div>
	    </div>
	    <div class="item">
	      <img data-src="http://localhost/wordpress/wp-content/uploads/2014/04/smells-like-bakin-one-279x3001.png">
<!--	      <div class="container">
		<div class="carousel-caption">
		</div>
	      </div>
-->
	    </div>
	    <div class="item">
	      <img src="http://localhost/wordpress/wp-content/uploads/2014/04/stopvisualpollution-two-150x150.png">
	      <div class="container">
		<div class="carousel-caption">
		</div>
	      </div>	    
	    </div>
	  </div>	    
         <a class="left carousel-content" href="#gallery-carousel" data-slide="prev">
	   <span class="glyphicon glyphicon-chevron-left"></span>
	 </a>        
         <a class="right carousel-content" href="#gallery-carousel" data-slide="next">
  	   <span class="glyphicon glyphicon-chevron-right"></span>
	 </a>        	 
   	</div>

      </div>
    </div>
<!--
    </div>
  </div>
</div>
-->

<script type="text/javascript">
  jQuery( document ).ready( function() { 
    jQuery( '.carousel' ).carousel()
  } ) ;
</script>
<?php
get_footer() ; 



