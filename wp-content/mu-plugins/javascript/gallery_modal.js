( function( $ ) {
  $( document ).ready( function() { 

$('.gallery-item img').on('click' , function(){
  var gallery_id = $(this).parents('div.gallery').attr( 'id' ) ; 
  var src_full_size =  $(this).parents('[data-src-full-size]').data('src-full-size' ) ;
  console.log( 'the gallery_id is: ' + gallery_id + ' and the src is ' + src_full_size ) ;
  $( '.carousel' ).carousel( 'pause' ) ;
  $( '.gallery-modal .carousel-inner .active' ).removeClass( 'active' ) ;
  $( '.gallery-modal .carousel-indicators .active' ).removeClass( 'active' ) ;

  $( '#' + gallery_id +  ' .carousel-inner img[src="' + src_full_size + '"]' ).parents( '.item' ).addClass( 'active' ) ;
  $( '#' + gallery_id +  ' .carousel-indicators li[data-src="' + src_full_size + '"]' ).addClass( 'active' ) ;
  $( '#' + gallery_id + ' .carousel' ).carousel() ;
  $( '#' + gallery_id + '.modal' ).modal() ;
  return false ;
  } ) ;
   } ) ;
 } )( jQuery ) 
