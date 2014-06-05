<?php

wp_register_style( 'carousel', get_template_directory_uri() . '/bootstrap/css/carousel.css' ) ;
wp_enqueue_style( 'carousel' ) ;
?>

<div id="gallery-modal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-content-gallery">
      <div class="modal-body">
        <a data-dismiss="modal" aria-hidden="true" href="#">
	  <span class="glyphicon glyphicon-remove-circle">
	  </span>
	</a>
      </div>
	<div id="myCarousel" class="carousel slide carousel-gallery" data-ride="carousel">
	<ol class="carousel-indicators">
	</ol>
	<div class="carousel-inner">
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>  <!-- .carousel -->
    </div> <!-- modal body -->
  </div>
</div>


