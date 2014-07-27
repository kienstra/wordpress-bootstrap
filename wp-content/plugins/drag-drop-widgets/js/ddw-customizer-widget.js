( function( $ ) {
  $( function() {

    $.fn.assignIdentifiersToSortableWidgets = function() {
      console.log( 'the length of this is: ' + this.length ) ;
      index = 0 ;
      this.children().map( function() {
	console.log( 'this is inside the map callback ' ) ;
	$( this ).data( 'ddw-id' , index ) ;
	console.log( 'the ddw-id is now ' + $( this ).data( 'ddw-id' ) ) ; 
	index++ ;
      } ) ;
      return this ; 
    }
      
     function getOrderOfSortableWidgets( $sortable_widgets_container ) {
       var order = [] ;
       $all_widgets = $sortable_widgets_container.children() ; 
       $all_widgets.each( function() {
	   order.push( $( this ).data( 'ddw-id' ) ) ;
       } ) ;
       return order ;
     }

     var sortable_selector = '.row' ;
     var $sortable_widgets = $( sortable_selector ).eq( 2 ) ;
     $sortable_widgets.sortable( {
	  axis: 'x' ,
	  containment : 'parent' ,
	  update : function( event , ui ) {} ,
     } ) ; 
     
     $sortable_widgets.assignIdentifiersToSortableWidgets() ; // in customizer and iframe

     $sortable_widgets.on( 'sortupdate' , function( event , ui ) {
       console.log( 'sortupdate event fired' ) ; 
       sidebar_id = $( this ).attr( 'id' ) ;
       sidebar_id = sidebar_id.replace( /-/g , '_' ) ;
       console.log( 'the id is: ' + sidebar_id ) ; 
       order_of_widgets_in_iframe = getOrderOfSortableWidgets( $( this ) ) ;
       data = { sidebar_id : sidebar_id ,
		order      : order_of_widgets_in_iframe 
	      } ;
       parent.jQuery( 'body' ).trigger( 'ddw-widget' , data ) ; 
	 //       triggerSortUpdateFor( '.ui-sortable' , { order : ddw_function_order } ) ;	 
//       find corresponding customize_controls widgets ;
//         .ddwReorder() ;
	 // call .each( function() { $( last li of widget customizer ).before( $that ) ; 
     } ) ; 

     function set_data_attribute_of_sortable_to_current_order( $element ) {
       $element.data( 'last-order' , $element.sortable( 'toArray' ) ) ;
     }

     function get_previous_order_of_sortable( $element ) {
       return $element.data( 'last-order' ) ;
     }

     $( '.control-section.accordion-section' , window.parent.document ).css( 'display' , 'block' ) ; 

//     reorder_customizer_sidebar_widgets( 'third_sidebar_test' , [ 3 , 2 , 1 , 0 ] ) ; 
								
//     interval = setInterval( triggerWidgetReorder , 2000 ) ;
     function triggerWidgetReorder() { 
//       $( sidebar_accordion_selector , window.parent.document ).trigger( 'change' ) ;
//       $( 'customize-control-widget_wle-6' ).trigger( 'change' ) ;
       console.log( 'triggering' ) ;
       console.log( 'the length of parent.jQuery ) is: ' + parent.jQuery ) ;
       triggerSortUpdateFor( 'third_sidebar_test' ) ;	 
//       parent.jQuery( 'body').trigger( 'ddw-widget' , { id :  ) ; 
       clearInterval( interval ) ; 
     }



     
      
//     content = jQuery( 'iframe' ).contents() ;
//     content.find ; 
     
      
     
//     $( '#save' ).val( 'Save & Publish' ).attr( 'disabled' , false ) ; 
      /*
     //     $widgets_in_sidebar.assignIdentifiersToSortableWidgets() ;
     var order = [ 3 , 1 , 0 , 2] ; 
     $widgets_in_sidebar.ddwReorder( order ) ;

//     $widgets_in_sidebar.insertAfter( $first_li_in_sidebar ) ;  

      
  var widgets_selector = '.customize-control-widget_form' ; 
  var $clone_of_widgets_in_sidebar = $sidebar.find( widgets_selector ).clone()  ;
  $sidebar.remove( widgets_selector ) ;
  $ordered_widgets = "" ;

  $sidebar.find( 'li' ).first().insertAfter( $ordered_widgets ) ;
      
  $sidebar.find( '.customize-control-sidebar_widgets' ).insertBefore( ordered_widgets ) ;

  return widgets_in_sidebar ;
*/
  } ) ; 
} )( jQuery )



