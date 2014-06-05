<?php 

add_action( 'wp_enqueue_scripts', 'google_map_setup_scripts' ) ;
function google_map_setup_scripts() { 
  wp_register_script( 'rk_google_map_script', plugins_url( 'javascript/rk_google_map_script.js' , __FILE__ ) ) ;
  wp_register_script( 'api_google_map_script', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCDjdcyZ6umNhcmaUGYO7AOnZaiz3wdbJ8&sensor=false' ) ; 
}

add_shortcode( 'google_map', 'rk_register_google_map' ) ;
function rk_register_google_map( $args ) { 
  $address = $args[ 'address' ] ; 
  wp_enqueue_script( 'api_google_map_script', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCDjdcyZ6umNhcmaUGYO7AOnZaiz3wdbJ8&sensor=false' ) ; 
  wp_enqueue_script( 'rk_google_map_script', plugins_url( 'javascript/rk_google_map_script.js', __FILE__ ) ) ;
?>
  <div id="map-container"> 
    <div id="map-canvas" data-address="<?php echo $address ; ?>"> 
    </div> 
  </div>
<?php
}