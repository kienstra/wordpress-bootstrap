( function( $ ) {
  $( function() {

   var sortable_selector = 'body > div.container .row' ; 
   $( sortable_selector ).sortable( {axis:'x',containment:'parent'} );      
/*    var sidebar_id = 'third_sidebar_test' ; 
  var $sidebar = $( '#accordion-section-sidebar-widgets-' + sidebar_id + ' .accordion-section-content' ) ;
  var widgets_selector = '.customize-control-widget_form' ; 
  var $clone_of_widgets_in_sidebar = $sidebar.find( widgets_selector ).clone()  ;
  $sidebar.remove( widgets_selector ) ;
  $ordered_widgets = ;

  $sidebar.find( 'li' ).first().insertAfter( $ordered_widgets ) ;
      
  $sidebar.find( '.customize-control-sidebar_widgets' ).insertBefore( ordered_widgets ) ;

  return widgets_in_sidebar ;
 */
  } ) ; 
} )( jQuery )



