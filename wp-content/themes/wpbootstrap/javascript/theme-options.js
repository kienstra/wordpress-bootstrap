( function ($) { 
  wp.customize( 'heading_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.heading-right-side' ).html( to ) ;
                  } ) ;
  } ) ;

  wp.customize( 'copy_right_side', function( value ) {
      value.bind( function( to ) {
	  to = to.replace( /\n/g , '</br>' ) ;
	  $( '.copy-right-side' ).html( to ) ;
	  console.log( 'the length is: ' +  $( '.copy-right-side' ).html().length ) ;
   	         } ) ;
  } ) ;

  wp.customize( 'image_slider_right_side', function( value ) {
    value.bind( function( to ) {
	  var percentage = String( to ) + "%" ; 
	  console.log( "percentage is: " + percentage ) ; 
	  $( '.image-right-side' ).attr( 'width', percentage ) ;
                  } ) ;
  } ) ; 

  wp.customize( 'image_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.image-right-side' ).attr( 'src', to ) ;
                  } ) ;
  } ) ;

} )( jQuery ) ;
