( function ($) { 

  // TODO : fallback for iframe 
  $('.customized-col').map( function() {
    id = $(this).attr('id') ;
    bind_panel( id ) ;
  } ) ;
  
  function bind_panel( panel_name ) {
      image_and_slider_bind( panel_name ) ;
      heading_and_copy_bind( panel_name ) ;
  }

  function image_and_slider_bind( panel_name ) {
    wp.customize( 'image_slider_' + panel_name , function( value ) {
      value.bind( function( to ) {
	    var percentage = String( to ) + "%" ; 
	    $( '.image_' + panel_name ).css( 'max-height' , ( to * 300 / 100 ) ) ;
      } ) ;
    } ) ; 

    wp.customize( 'image_' + panel_name , function( value ) {
	value.bind( function( to ) {
	    $( '.image_' + panel_name ).attr( 'src', to ) ;
		    } ) ;
    } ) ;
  }
 
  function heading_and_copy_bind( panel_name ) { 
      wp.customize( 'heading_' + panel_name , function( value ) {
       value.bind( function( to ) {
         $( '.heading_' + panel_name ).html( to ) ;
       } ) ;
      } ) ;
 
      wp.customize( 'copy_' + panel_name , function( value ) {
	  value.bind( function( to ) {
	      to = to.replace( /\n/g , '</br>' ) ;
	      $( '.copy_' + panel_name ).html( to ) ;
	  } ) ;
      } ) ;
   }

} )( jQuery ) ;