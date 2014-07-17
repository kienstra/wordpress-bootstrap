<?php

// Set up a modal carousel for every gallery
add_action( 'loop_end' , 'bsg_echo_modal_carousel_for_each_gallery_in_post' ) ; 
function bsg_echo_modal_carousel_for_each_gallery_in_post() { 
  global $post ; 
  $galleries = get_post_galleries( $post->id , false ) ; 
  if ( isset( $galleries ) ) {
    foreach( $galleries as $gallery ) {
      $gallery_ids = $gallery[ 'ids' ] ;
      $image_ids = explode( ',' , $gallery_ids ) ;     
      create_and_echo_modal_carousel_for_gallery( $image_ids ) ;
    }
  }
}
 
function create_and_echo_modal_carousel_for_gallery( $image_ids ) {
  $modal_for_gallery = new BSG_Modal_Carousel() ;
  foreach( $image_ids as $image_id ) {
    $src_full_size = wp_get_attachment_image_src( $image_id , 'full', false ) ; 
    $src_full_size = $src_full_size[ 0 ] ;
    $modal_for_gallery->add_image( $src_full_size , '' ) ;
  }
  echo $modal_for_gallery->get() ;  
}