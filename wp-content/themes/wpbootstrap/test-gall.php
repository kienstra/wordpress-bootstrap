<?php
/**
** Template Name: Gallery Test
**/

get_header() ;



/*
javascript:


$( '.gallery .gallery-item img' ).on( 'click' , function() { 

  $( '.carousel-inner .active' ).removeClass( 'active' ) ; 
  $( '.carousel-indicators .active' ).removeClass( 'active' ) ;

  var full_size_src = $( this ).attr( 'data-src-full-width' ) ;
  var gallery_id = $( this ).find( '.gallery' ).attr( 'id' ) ;
  $( '#' + gallery_id + ' [data-src-full-width:' + full_size_src ).parent( 'item' ).addClass( 'active' ) ) ;

  $( '.carousel-indicators [data-src=' + full_size_src ).addClass( 'active' ) ; 

  $( '$gallery_id' ).modal() ;
  $( '$gallery_id .carousel' ).carousel() ; 
  return false ; 

} ) ;   
  
*/
?>

<div class="row">
<div class="col-md-8">
<?php

echo do_shortcode( "[gallery ids='211,209,210,194,197,201']" ) ;
//echo do_shortcode( "[gallery_modal]" ) ; 

$mod = new ModalCarousel( 'gallery-2' ) ;
$mod->add_image( 'http://lorempixel.com/600/400', 'http://lorempixel.com/600/400' ) ;
$mod->add_image( 'http://lorempixel.com/600/402', 'http://lorempixel.com/600/402' ) ;
$mod->add_image( 'http://lorempixel.com/600/403', 'http://lorempixel.com/600/403' ) ;
echo $mod->get() ;

/* $ = jQuery ; $('.item').last().addClass('active') ; $('.carousel-indicators li').last().addClass('active'); $('.modal').modal() ;  $('.carousel').carousel() ;
*/

?>
</div>
</div>

<?php get_footer() ;