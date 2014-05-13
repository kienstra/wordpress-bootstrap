( function ($) { 

  wp.customize( 'heading_left_panel', function( value ) {
      value.bind( function( to ) {
	  $( '.heading_left_panel' ).html( to ) ;
                  } ) ;
  } ) ;

  wp.customize( 'copy_left_panel', function( value ) {
      value.bind( function( to ) {
	  to = to.replace( /\n/g , '</br>' ) ;
	  $( '.copy_left_panel' ).html( to ) ;
      } ) ;
  } ) ;

  wp.customize( 'image_slider_right_side', function( value ) {
    value.bind( function( to ) {
	  var percentage = String( to ) + "%" ; 
	  console.log( "percentage is: " + percentage ) ; 
	  $( '.image_right_side' ).attr( 'width', percentage ) ;
                  } ) ;
  } ) ; 

  wp.customize( 'image_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.image_right_side' ).attr( 'src', to ) ;
                  } ) ;
  } ) ;

} )( jQuery ) ;
