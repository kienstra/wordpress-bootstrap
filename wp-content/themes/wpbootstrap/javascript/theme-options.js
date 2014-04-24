( function ($) { 
  wp.customize( 'heading_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.heading-right-side' ).html( to ) ;
                  } ) ;
  } ) ;

  wp.customize( 'copy_right_side', function( value ) {
      value.bind( function( to ) {
	  to = to.replace( /\n/g , '</br>' ) ;
	  console.log("to is: " +  to ) ;
	  $( '.copy-right-side' ).html( to ) ;
   	         } ) ;
  } ) ;

  wp.customize( 'image_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.image-right-side' ).attr( 'src', to ) ;
                  } ) ;
  } ) ;

} )( jQuery ) ;
