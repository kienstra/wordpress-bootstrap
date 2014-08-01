( function( $ ) {
  // this loads in customizer iframe
  $( function() {

     $.fn.assignIdentifiersToSortableWidgets = function() {
       index = 0 ;
       sidebar_id = $( this ).attr( 'id' ) ;
       $( this ).children().map( function() {
	 $( this ).data( 'ddw-id' , index )
	          .data( 'ddw-parent-sidebar' , sidebar_id ) ;
	 console.log( 'the id is now: ' + $( this ).data( 'ddw-id' ) ) ; 
	 index++ ;
       } ) ;
       return this ; 
     }
 
     var sidebar_selector = '.bwr-row' ;
      
     sortableSidebarSetup( sidebar_selector ) ;
      
     function sortableSidebarSetup( sidebar_selector ) { 
       makeSidebarWidgetsSortable( sidebar_selector ) ;
       $( sidebar_selector ).map( function() {  /* this instead of sidebar_selector? */
	 $( this ).assignIdentifiersToSortableWidgets() ;
         if_sidebar_has_no_children_assign_class( $( this ) ) ;	 	   
       } ) ; 	 
     }
     
     function makeSidebarWidgetsSortable( sidebar_selector ) {
       $( sidebar_selector ).sortable( {  
	    cursor : 'move' ,
	    tolerance : 'pointer' ,
	    dropOnEmpty : true ,	   
	    connectWith : sidebar_selector ,
	    receive : function( event , ui ) {} ,
	    update : function( event , ui ) {} ,
	    over : function( event , ui ) {} , 
       } ) ;
     }
      
     $( sidebar_selector ).on( 'sortreceive' , function( event , ui ) {
	 assignBootstrapClassesToWidgets( sidebar_selector ) ;
	 sidebar_id = $( this ).attr( 'id' ) ;
         var parent_sidebar_of_each_widget = getParentSidebarsOfSortableWidgets( $( this ) ) ;
         var order_of_widgets_in_iframe = getOrderOfSortableWidgets( $( this ) ) ;
	 console.log( 'receive event for sidebar id: ' + sidebar_id ) ; 
	 console.log( 'the order of widgets is: ' + order_of_widgets_in_iframe ) ; 
	 
         data = { sidebar_id      : sidebar_id ,
		  order           : order_of_widgets_in_iframe ,
		  parent_sidebars : parent_sidebar_of_each_widget ,		
	        } ;
	 parent.jQuery( 'body' ).trigger( 'ddw-remove-and-insert-widget' , data ) ;
     } ) ;

     // when iframe's widgets are moved, trigger event to reorder them in the customizer controls      
     $( sidebar_selector ).on( 'sortupdate' , function( event , ui ) {
       var sidebar_id_with_underscores  = $( this ).attr( 'id' ) ;
       var sidebar_id = sidebar_id_with_underscores.replace( /-/g , '_' ) ;
       console.log( 'sortupdate event for sidebar_id: ' + sidebar_id ) ;	 
       var parent_sidebar_of_each_widget = getParentSidebarsOfSortableWidgets( $( this ) ) ;
       console.log( 'as triggered, the type of the parent sidebars are: ' + typeof parent_sidebar_of_each_widget ) ; 
       var order_of_widgets_in_iframe = getOrderOfSortableWidgets( $( this ) ) ;
       data = { sidebar_id      : sidebar_id ,
                parent_sidebars : parent_sidebar_of_each_widget ,
		order           : order_of_widgets_in_iframe 
	      } ;
       parent.jQuery( 'body' ).trigger( 'ddw-reorder-widgets' , data ) ;
     } );

     $( sidebar_selector ).on( 'sortover' , function( event , ui ) {
       console.log( 'over event in sidebar id: ' + $( this ).attr( 'id' ) ) ;
       assignBootstrapClassesToWidgets( sidebar_selector ) ;
     } ) ;

     parent.jQuery( 'body' ).bind( 'ddw-reassign-identifiers' , function( event , data ) {
       var sidebar_id = data[ 'sidebar_id' ] ;
       console.log( 'here is the reassign handler, with a sidebar_id of: ' +  sidebar_id ) ;
       $( '#' + sidebar_id ).assignIdentifiersToSortableWidgets() ; 
     } ) ;
      
     function assignBootstrapClassesToWidgets( sidebar_selector ) { 
        $( sidebar_selector ).each( function() {
	   var column_prefix = 'col-md-' ;
           if_sidebar_has_no_children_assign_class( $( this ) ) ; 
           var column_size = Math.floor( 12 / $( this ).children().length ) ;
           var new_column_class = column_prefix + column_size ;
           $( this ).children().each( function() {
	     var current_classes = $( this ).attr( 'class' ) ;
	     var new_classes = current_classes.replace( /col-md-[\d]+/ , new_column_class ) ; 
             $( this ).attr( 'class' ,  new_classes ) ;
           } ) ;
        } ) ;
     }
    
     function getOrderOfSortableWidgets( $sortable_widgets_container ) {
       var order = [] ;
       $sortable_widgets_container.children().each( function() {
	   order.push( $( this ).data( 'ddw-id' ) ) ;
       } ) ;
       return order ;
     }

     function getParentSidebarsOfSortableWidgets( $sortable_widgets_container ) {
       var sidebars = [] ;
       $sortable_widgets_container.children().each( function() {
	   sidebars.push( $( this ).data( 'ddw-parent-sidebar' ) ) ;
       } ) ;
       return sidebars ; 
     }

     function if_sidebar_has_no_children_assign_class( $sidebar ) { 
       if ( $sidebar.children().length === 0 ) {
	 $sidebar.addClass( 'bwr-empty' ) ;
       }
     }
      
     $( '.control-section.accordion-section' , window.parent.document ).css( 'display' , 'block' ) ; 

  } ) ; 
} )( jQuery )



