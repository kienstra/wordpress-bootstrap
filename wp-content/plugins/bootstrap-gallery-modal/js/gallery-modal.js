( function( $ ) {
  $( document ).ready( function() { 

    $( '.gallery-item' ).on('click' , function(){
      var gallery_id = $(this).parents('div.gallery').attr( 'id' ) ;  
      var image_index = $( this ).parents( '#' + gallery_id ).find( '.gallery-item' ).index( this ) ; 

      $( '.carousel' ).carousel( 'pause' ) ;
      $( '.gallery-modal .carousel-inner .active' ).removeClass( 'active' ) ;
      $( '.gallery-modal .carousel-indicators .active' ).removeClass( 'active' ) ;
      var carousel_gallery_id = 'carousel-' + gallery_id ;     

      $( '#' + carousel_gallery_id +  ' .carousel-inner img' ).eq( image_index ).parents( '.item' ).addClass( 'active' ) ;
      $( '#' + carousel_gallery_id +  ' .carousel-indicators li' ).eq( image_index ).addClass( 'active' ) ;

      $( '#' + carousel_gallery_id + ' .carousel' ).carousel() ;
      $( '#' + carousel_gallery_id + '.modal' ).modal() ;
      return false ;
    } ) ;

    // copied from http://lazcreative.com/blog/how-to/how-to-adding-swipe-support-to-bootstraps-carousel/
    $( '.gallery-modal' ).swiperight( function() {  
      $( this ).carousel('prev');  
    } ) ;  
    $( '.gallery-modal' ).swipeleft(function() {  
	$( this ).carousel('next');  
    } ) ;
 
  } ) ;
} )( jQuery ) 
