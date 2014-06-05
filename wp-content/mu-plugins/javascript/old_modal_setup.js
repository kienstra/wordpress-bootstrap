( function( $ ) { 

    function remove_thumbnail_dimensions( url ) {
      var dimension = url.match( /(-[0-9]{2,3}x[0-9]+)\.[A-Za-z]+/)[1] ;
      return url.replace( dimension, '' ) ;
    }

$( document ).ready( function() {
   $( 'dl.gallery-item a img' ).each( function( index ) {
     var image_src = $( this ).attr( 'src' ) ;
     var source_no_thumbnail_dimensions = remove_thumbnail_dimensions( image_src ) ;
     $( 'ol.carousel-indicators' ).append( $('<li data-target="#myCarousel">').attr('data-slide-to', index ).attr( 'data-src', source_no_thumbnail_dimensions ) ) ;
       
     $( 'div.carousel-inner' ).append( $( '<div>').addClass( 'item' )
        .append( $( '<div>' ).addClass( 'container' )
         .append( $( '<div>' ).addClass( 'carousel-caption' )
          .append( $( '<img>' ).attr( 'src', source_no_thumbnail_dimensions ) 

    ) ) ) ) } ) ;
  
 $( 'dl.gallery-item a').on( 'click', function() { 
   var source = $( this ).find( 'img' ).attr('src') ;
	var source_without_thumbnail_dimensions = remove_thumbnail_dimensions( source ) ;
	$( 'div.item' ).removeClass( 'active' ) ;
        $( '.item.next.left' ).removeClass( 'next left' ) ; 
	$( 'ol.carousel-indicators li' ).removeClass( 'active' ) ;
	$( 'div.item img[src="' + source_without_thumbnail_dimensions + '"]' )
	  .parents( 'div.item' )
	  .addClass( 'active' ) ;
	$( 'ol li[data-src="' + source_without_thumbnail_dimensions +'"]' ).addClass( 'active' ) ;
        $( '.carousel' ).carousel() ;
        $( '#gallery-modal' ).modal() ; 
     } ) ;

   $('dl.gallery-item a').attr( 'id', 'image-modal' ) 
                         .attr( 'href', "#" ) ;    
} ) ; 
  

} )( jQuery ) ;


