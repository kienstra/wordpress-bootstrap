( function( $ ) {
  $( document ).ready( function() { 

    // When a gallery image is clicked, open the modal carousel that was built by gallery-modal-setup.php
    $( '.gallery-item' ).on('click' , function(){	
      var gallery_id = $(this).parents( '.gallery' ).attr( 'id' ) ;
      var image_index = $( this ).parents( '#' + gallery_id ).find( '.gallery-item' ).index( this ) ;

      $( '.carousel' ).carousel( 'pause' ) ;
      $( '.gallery-modal .carousel-inner .active' ).removeClass( 'active' ) ;
      $( '.gallery-modal .carousel-indicators .active' ).removeClass( 'active' ) ;
      $( '.gallery-modal .carousel-inner .item.next' ).removeClass( 'next' ) ;
      $( '.gallery-modal .carousel-inner .item.left' ).removeClass( 'left' ) ;	

      var carousel_gallery_id = 'carousel-' + gallery_id ;     

      // Set the image in the modal carousel to "active" so it appears when it opens
      $( '#' + carousel_gallery_id +  ' .carousel-inner img' ).eq( image_index ).parents( '.item' ).addClass( 'active' ) ;
      $( '#' + carousel_gallery_id +  ' .carousel-indicators li' ).eq( image_index ).addClass( 'active' ) ;

      $( '#' + carousel_gallery_id + ' .carousel' ).carousel( { interval : false } ) ;
      $( '#' + carousel_gallery_id + '.modal' ).modal() ;
      return false ;
    } ) ;

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
      jQuery( '.gallery-modal .carousel.carousel-gallery .carousel-inner .item' ).css('height' , function() {
        return ( .8 * $( window ).height() ) ;
      } )  
    } ;
    
  } ) ;
} )( jQuery ) 
