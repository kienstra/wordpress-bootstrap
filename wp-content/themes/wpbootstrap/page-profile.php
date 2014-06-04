<?php 
/**
Template Name: Profile Page
*/

get_header() ; ?>
  
  <?php if ( is_user_logged_in() ) : ?>
    <div class="content">
    <h2>Your profile</h2>
    <?php $userdata = wp_get_current_user() ; ?>
    <form action="<?php the_permalink() ; ?>" method="post">
      <label for="email-address">Email Address</label>
      <input type="email" name="user_email" id="email-address" value="<?php echo $userdata->user_email ; ?>" required>
      <label for="firstname">First Name</label>
      <input type="text" name="first_name" id="firstname" value=<?php echo $userdata->user_nicename ; ?> required>
      <label for="lastname">Last Name</label>
      <input type="text" name="last_name" id="lastname" value="<?php echo $userdata->last_name ; ?>" required>
      <label for="website">Website</label>
      <input type="url" name="user_url" id="website" value="<?php echo $userdata->url ; ?>">
      <input type="submit" name="update_user_profile" value="Update">
    </form> 

  <?php else : ?>
    <p>You need to be a registered member of the site to view your profile. Please either login below or <a href="/register">register here</a> to view your profile.</p>
  <?php 
    $args = array( 
      'redirect' => home_url() ,
      'form_id' => 'loginform-custom' ,
      'id_username' => 'user-login-custom' ,
      'id_password' => 'user-pass-custom' ,
      'id_remember' => 'rememberme-custom' ,
      'id_submit' => 'wp-submit-custom' 
    ) ;
    wp_login_form( $args ) ;
  ?>
  <p>
    <a class="forgot-pass-link" href="<?php echo wp_lost_password_url() ; ?>" title="<?php _e( 'Forgotten your password?', 'prowordpress' ) ; ?>"></php _e( 'Forgotten your password?' , 'prowordpress' ) ; ?></a>
  </p>
  <?php endif ; ?>
  </div>
<?php get_footer() ; ?>