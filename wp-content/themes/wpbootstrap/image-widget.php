<?php

class Image_Picker extends WP_Widget
{
function Image_Picker() {
$widget_ops = array('classname' => 'Image_Picker', 'description' => 'Pick 2 images from media library');
$this->WP_Widget('Image_Picker', 'Image Picker', $widget_ops);
}
function form($instance) {
//WIDGET BACK-END SETTINGS
$instance = wp_parse_args((array) $instance, array('link1' => '', 'link2' => ''));
$link1 = $instance['link1'];
$link2 = $instance['link2'];
$images = new WP_Query( array( 'post_type' => 'attachment', 'post_status' => 'inherit', 'post_mime_type' => 'image' , 'posts_per_page' => -1 ) );
if( $images->have_posts() ){
$options = array();
for( $i = 0; $i->have_posts() ; ) {
$images->the_post();
$img_src = wp_get_attachment_image_src(get_the_ID());
$the_link = ( $i == 0 ) ? $link1 : $link2;
$options[$i] .= '' . get_the_title() . '';
}
 ?>
<select name="<?php get_field_name( 'link1' ); ?>">
<select name="<?php get_field_name( 'link2' ); ?>">
<?php
} else {
echo 'There are no images in the media library. Click here to add some images';
}
wp_reset_postdata() ; 
}

function update($new_instance, $old_instance) {
$instance = $old_instance;
$instance['link1'] = $new_instance['link1'];
$instance['link2'] = $new_instance['link2'];
return $instance;
}
function widget($args, $instance) {
$link1 = ( empty($instance['link1']) ) ? 0 : $instance['link1'];
$link2 = ( empty($instance['link2']) ) ? 0 : $instance['link2']; 
?>
<img src="" alt="" width="203" height="271" border="0">
- See more at: http://www.eonlinegratis.com/2013/image-picker-widget/#sthash.VXzgd8yy.dpuf
<?php
}
}

?>
