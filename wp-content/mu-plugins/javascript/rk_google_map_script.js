  var map ;
  var geocoder = new google.maps.Geocoder() ;      
      
  function initialize() {
    var address = document.getElementById( 'map-canvas' ).getAttribute( 'data-address' ) ;
   (function codeAddress() { 
    geocoder.geocode( { address : address }, function( results, status ) { 
      if ( google.maps.GeocoderStatus.OK == status ) { 
        var latlng = new google.maps.LatLng(-34.397, 150.644);
        mapOptions = {
                   zoom: 8,
		   center: results[0].geometry.location 
                   };

      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions) ;
//        map.setCenter( results[0].geometry.location ) ;
	var marker = new google.maps.Marker( { 
 	  map : map ,
	  position : results[ 0 ].geometry.location
	} ) 
      } else {
        alert( 'Geocode did not work because: ' + status ) ; 
      }
    } )
   }) () 
  }
  
google.maps.event.addDomListener(window, 'load', initialize ) ;
