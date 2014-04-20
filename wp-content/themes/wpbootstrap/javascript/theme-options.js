( function ($) { 
  wp.customize( 'copy_one', function( value ) {
      value.bind( function( to ) {
	  $( '.copy-one' ).html( to ) ;
                  } ) ;
  } ) ;

  wp.customize( 'copy_one_heading', function( value ) {
      value.bind( function( to ) {
	  $( '.copy-one-heading' ).html( to ) ;
                  } ) ;
  } ) ;  

  wp.customize( 'heading_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.heading-right-side' ).html( to ) ;
                  } ) ;
  } ) ;

  wp.customize( 'copy_right_side', function( value ) {
      value.bind( function( to ) {
	  $( '.copy-right-side' ).html( to ) ;
                  } ) ;
  } ) ;


  } )( jQuery ) ;
