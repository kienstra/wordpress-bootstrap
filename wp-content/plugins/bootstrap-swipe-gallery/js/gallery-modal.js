( function( $ ) {
  $( function() { 

    // When a gallery image is clicked, open the modal carousel that was built by gallery-modal-setup.php
    $( '.gallery-item' ).on('click' , function() {	  
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

      /* new */
      $('.type-post img' ).on( 'click' , function() {
	  console.log( 'created a carousel' ) ; 
	  reset_carousel() ; 
	  var post_image_index = $( this ).parents().find( 'img' ).index( this ) ;
	  console.log( 'the index is: ' + post_image_index ) ;
	  $( '.carousel .carousel-inner img' ).eq( post_image_index ).parents( '.item' ).addClass( 'active' ) ; // .carousel is too general
	  $( ' .carousel .carousel-indicators li' ).eq( post_image_index ).addClass( 'active' ) ;
	  $( '.carousel' ).carousel( { interval : false , wrap : true ,} ) ; 
          $( '.modal' ).modal() ;
	  return false ;
	  
      } ) ;

//      $( '.carousel-control' ).css( 'position' , 'static' ) ; 

    // work-around the data-slide-to and ol.carousel-indicators not working

    $( '.carousel .left' ).on( 'click' , function() {
      $( this ).parents( '.carousel' ).carousel( 'prev' ) ;
      return false ;	
    } )

    $( '.carousel .right' ).on( 'click' , function() {
      $( this ).parents( '.carousel' ).carousel( 'next' ) ;
      return false ;	
    } ) ;

    $( '.carousel-indicators li' ).on( 'click' , function() {
      var slide_to = $( this ).data( 'slide-to' ) ;
      $( this ).parents( '.carousel' ).carousel( slide_to ) ;
      return false ;
    } )

/*    

    // when the carousel slides, hide the controls
    $( '.carousel' ).on( 'slide.bs.carousel' , function() {
//      $( this ).find( '.carousel-inner .active' ).hide() ; 
      $( this ).find( '.carousel-control' ).hide() ;
    } ) ;

    // when the carousel is done sliding, show the controls

    $( '.carousel' ).on( 'slid.bs.carousel' , function() {
      $( this ).find( '.carousel-control' ).show() ;
//      $( this ).find( '.carousel-inner .item' ).show() ; 
    } ) ;
*/
      
    function reset_carousel() {	
      $( '.carousel' ).carousel( 'pause' ) ;
      $( '.carousel .carousel-inner .active' ).removeClass( 'active' ) ;
      $( '.carousel .carousel-indicators .active' ).removeClass( 'active' ) ;
      $( '.carousel .carousel-inner .item.next' ).removeClass( 'next' ) ;
      $( '.carousel .carousel-inner .item.left' ).removeClass( 'left' ) ;
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
        return ( .8 * $( window ).height() ) ;
      } )  
    } ;
    
  } ) ;
} )( jQuery ) 

