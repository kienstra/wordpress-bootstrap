<?php
/**
Template Name: Client Login
*/

if ( is_user_logged_in() ) : 
else: 
  echo "Not logged in" ;
?>
<p>Please login to view the rest of the content:</p>
<?php if ( isset( $_GET[ 'login' ] ) && 'failed' === $_GET[ 'login' ] ) :
?>
  <div class="alert alert-error">
    <p><?php _e( 'Login failed. Please check your details and try again. ', 'wpbootstrap' ) ; ?></p>
  </div>
<?php endif ; 
  $args = array( 
    'form_id' => 'loginform-custom' ,
    'id_username' => 'user-login-custom' ,
    'id_password' => 'user_pass-custom' ,
    'id_rememeber' => 'rememberme-custom' ,
    'id_submit' => 'wp-submit-custom' ,
  ) ;

  wp_login_form( $args ) ; 
  endif;
?>