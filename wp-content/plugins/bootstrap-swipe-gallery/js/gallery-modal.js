( function( $ ) {
  $( function() {

    // When a gallery image is clicked, open the modal carousel that was built by gallery-modal-setup.php
    $( '.gallery-item' ).on('click' , function() {
      var gallery_id = $(this).parents( '.gallery' ).attr( 'id' ) ;
      var image_index = $( this ).parents( '#' + gallery_id ).find( '.gallery-item' ).index( this ) ;
//      var parent_carousel = $( this ).parents( '.carousel' ) ;
      var carousel_gallery_id = 'carousel-' + gallery_id ;
      var $modal_carousel = $( '#' + carousel_gallery_id ) ;
      open_modal_carousel_with_image( $modal_carousel , image_index ) ;
      return false ;
    } ) ;

      /* new */
    var image_selector = 'img:not(.thumbnail)' ;

    $( '.type-post ' + image_selector ).on( 'click' , function() {
	if ( $( this ).parents( '.gallery-item' ).length > 0 ) {
	  return $( this ) ;
	}
	// this needs to have a selector like #post-image-carousel
	var $modal_carousel = $( '#carousel-non-gallery' ) ;
	var post_image_index = $( this ).parents().find( image_selector ).index( this ) ;
	console.log( 'the $modal_carousel id is: ' + $modal_carousel.attr( 'id' ) + ' and the index is: ' + post_image_index ) ; 
        open_modal_carousel_with_image( $modal_carousel , post_image_index ) ;	
/*
	var $carousel = $modal_carousel.find( '.carousel ' ) ;
	reset_carousel( $carousel ) ;
	$carousel.find( '.carousel-inner img' ).eq( post_image_index ).parents( '.item' ).addClass( 'active' ) ; // .carousel is too general
	$carousel.find( '.carousel-indicators li' ).eq( post_image_index ).addClass( 'active' ) ;
	$carousel.carousel( { interval : false , wrap : true ,} ) ;
	$modal_carousel.modal() ;
*/
	return false ;
    } ) ;

    function open_modal_carousel_with_image( $modal_carousel , image_index ) {
      var $carousel = $modal_carousel.find( '.carousel' ) ;
      reset_carousel( $carousel ) ;
      // Set the image in the modal carousel to "active" so it appears when it opens
      $carousel.find( '.carousel-inner img' ).eq( image_index ).parents( '.item' ).addClass( 'active' ) ;
      $carousel.find( '.carousel-indicators li' ).eq( image_index ).addClass( 'active' ) ;
      $carousel.carousel( { interval : false } ) ;
      $modal_carousel.modal() ;
    }      
    // work-around the data-slide-to and ol.carousel-indicators not working

    $( '.carousel .left' ).on( 'click' , function() {
      $( this ).parents( '.carousel' ).carousel( 'prev' ) ;
      return false ;
    } ) ;

    $( '.carousel .right' ).on( 'click' , function() {
      $( this ).parents( '.carousel' ).carousel( 'next' ) ;
      return false ;
    } ) ;

    $( '.carousel-indicators li' ).on( 'click' , function() {
      var slide_to = $( this ).data( 'slide-to' ) ;
      $( this ).parents( '.carousel' ).carousel( slide_to ) ;
      return false ;
    } ) ;

    function reset_carousel( $carousel ) {
      $carousel.carousel( 'pause' ) ;
      $carousel.find( '.carousel-inner .active' ).removeClass( 'active' ) ;
      $carousel.find( '.carousel-indicators .active' ).removeClass( 'active' ) ;
      $carousel.find( '.carousel-inner .item.next' ).removeClass( 'next' ) ;
      $carousel.find( '.carousel-inner .item.left' ).removeClass( 'left' ) ;
    }

    // Swipe support
    $( '.gallery-modal' ).swiperight( function() {
      $( this ).carousel( 'prev' );
    } ) ;
    $( '.gallery-modal' ).swipeleft(function() {
	$( this ).carousel( 'next' );
    } ) ;

    size_containing_div_of_image() ;
    $( window ).resize( size_containing_div_of_image ) ;

    function size_containing_div_of_image() {
      jQuery( '.gallery-modal .carousel.carousel-gallery .carousel-inner .item' ).css( 'height' , function() {
	return ( 0.8 * $( window ).height() ) ;
      } ) ;
    }

  } ) ;
} )( jQuery ) ;


