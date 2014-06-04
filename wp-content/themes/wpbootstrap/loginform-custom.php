<?php 
/**
Template Name: Login template
*/

get_header() ;
?>
<div class="content">
  <h2>
    <?php the_title() ; ?>
  </h2>
</div>

<?php 

$args = array( 
  'echo'	=> true ,
  'redirect'	=> home_url() ,
  'form_id'	=> 'loginform-custom' ,
  'id_username' => 'user-login-custom' ,
  'id_password' => 'user-pass-custom' ,
  'id_remember' =>  'rememberme-custom' ,
  'id_submit'	=> 'wp-submit-custom' ,
) ;

wp_login_form( $args ) ; ?>
?>
  
<?php get_footer() ; ?>