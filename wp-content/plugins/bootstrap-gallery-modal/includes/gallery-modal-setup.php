<?php

add_action( 'loop_end' , 'bgm_gallery_modal_setup' ) ; // loop end
function bgm_gallery_modal_setup() {
  global $post ; 
  echo "this is the action and the post id is: " ; 
  var_dump( $post->id ) ; 
  $galleries = get_post_galleries( $post->id , false ) ; 
  if ( isset( $galleries ) ) {
    foreach( $galleries as $gallery ) {
      $gallery_ids = $gallery[ 'ids' ] ;
      $image_ids = explode( ',' , $gallery_ids ) ;     

      echo "the image_ids are: " ;
      var_dump( $image_ids ) ; 

      $modal_for_gallery = new BGM_Modal_Carousel() ;

      foreach( $image_ids as $image_id ) {
	$src_full_size = wp_get_attachment_image_src( $image_id , 'full', false ) ; 
	$src_full_size = $src_full_size[ 0 ] ;
	$modal_for_gallery->add_image( $src_full_size , '' ) ;
      }
      echo $modal_for_gallery->get() ;
    }
  }
}

