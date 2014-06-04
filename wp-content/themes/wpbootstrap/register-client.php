<?php
/**
Template Name: Register Client 
*/
var_dump( $wp->query_vars ) ;
?>

<form action="<?php the_permalink() ; ?>" method="post">
  <label for="email-address">Enter you email to register</label>
  <input type="email" name="email_address" id="email-address" placeholder="name@example.com" required>
  <label for="username">Username</label>
  <input type="text" name="user_login" id="username" required>
  <label for="firstname">First name</label>
  <input type="text" name="first_name" id="firstname" required>  

  <input type="submit" name="full_registration" value="Register">
</form>








