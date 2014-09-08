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
      create_and_echo_modal_carousel( $image_ids ) ;
    }
  }
}
 
function create_and_echo_modal_carousel( $image_ids , $carousel_id = '' ) {
  $modal_for_gallery = new BSG_Modal_Carousel( $carousel_id ) ;
  foreach( $image_ids as $image_id ) {
    $src_full_size = wp_get_attachment_image_src( $image_id , 'full', false ) ; 
    $src_full_size = $src_full_size[ 0 ] ;
    $modal_for_gallery->add_image( $src_full_size , '' ) ;
  }
  echo $modal_for_gallery->get() ;  
}

add_action( 'loop_end' , 'bsg_carousel_of_all_post_images' ) ;
function bsg_carousel_of_all_post_images() {
  global $post ; 
  if ( is_single( $post->ID ) ) {
    $images = bsg_get_images_in_post() ; 
    if ( $images ) {
      $image_ids = bsg_get_image_ids( $images ) ;
      create_and_echo_modal_carousel( $image_ids , 'non-gallery' ) ;    
    }
  }
}

function bsg_get_images_in_post() {
  global $post ;
  $images = get_posts( array( 'post_parent' => $post->ID ,
				 'post_type' => 'attachment' , 
				 'post_status' => null , 
				 'numberposts' => '-1' ,
				 'order' => 'ASC' ,
	    ) ) ;
  return $images ;
}

function bsg_get_image_ids( $images ) {
  $image_ids = array() ;
  foreach( $images as $image ) {
    array_push( $image_ids , $image->ID ) ;
  }
  return $image_ids ;
}