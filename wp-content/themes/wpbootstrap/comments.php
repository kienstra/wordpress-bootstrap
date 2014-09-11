<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php if ( have_comments() ) : ?>
  <h3 id="comments">
    <span class="glyphicon glyphicon-comment"></span> &nbsp;
    <?php comments_number( __( 'No comment' , 'wpbootstrap' ) , __( 'A comment' , 'wpbootstrap' ) , __( '% comments' , 'wpbootstrap' ) ) ; ?>
    <a class="add-comment btn btn-med btn-primary pull-right" href="#respond">
      <span class="glyphicon glyphicon-plus"></span> &nbsp;
      Comment
    </a>
  </h3>

  <ol class="comment-area media-list">
    <?php wp_list_comments( 'callback=bwp_comment_list' ) ; ?>
  </ol>
  <ul class="pager">
    <li>
      <?php previous_comments_link( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;' . __( "Previous comments" , "wpbootstrap" ) ) ; ?>
    </li>
    <li>
      <?php next_comments_link( __( "Next comments" , "wpbootstrap" ) . '&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>' ) ; ?>
    </li>
  </ul>
<?php endif ; ?>

<?php if ( comments_open() ) : ?>
  <div id="respond">
    <h4><?php comment_form_title( __( 'Leave a comment' , 'wpbootstrap' ) , __( 'Leave a comment for %' , 'wpbootstrap' ) ) ; ?></h4>
    <div class="cancel-reply-comment">
      <?php cancel_comment_reply_link() ; ?>
    </div>

    <?php if ( ( ! is_user_logged_in() ) && ( get_option( 'comment_registration' ) ) ) : ?>
	<p><?php _e( 'Please' , 'wpbootstrap' ) ; ?>&nbsp;<a href="<?php echo esc_attr( wp_login_url( get_permalink() ) ) ; ?>"><?php _e( 'log in' , 'wpbootstrap' ) ; ?></a>&nbsp;<?php _e( 'to make a comment.' , 'wpbootstrap' ) ; ?></p>
    <?php else : ?>
	<form class="form-horizontal" role="form" action="<?php echo esc_url( site_url( 'wp-comments-post.php' ) ) ; ?>" method="post" id="comment-form">
      <? if ( is_user_logged_in() ) : ?>
	<p>
	  <?php _e( 'Welcome,' , 'wpbootstrap' ) ;?>&nbsp;<a href="<?php echo esc_url( site_url( 'wp-admin/profile.php' ) ) ; ?>"><?php echo $user_identity ; ?></a>.
	  <a href="<?php esc_url( wp_logout_url( get_permalink() ) ) ; ?>" title="<?php _e( 'Log out' , 'wpbootstrap' ) ; ?>"><?php _e( 'Log out' , 'wpbootstrap' ) ; ?></a>
	</p>
      <?php else : ?>
	<div class="form-group">
	  <label for="author" class="sr-only"><?php _e( 'Name' , 'wpbootstrap' ) ; ?></label>
	  <div class="col-md-5">
	    <input type="text" id="author" class="form-control" name="author" value="<?php echo esc_attr( $comment_author ) ; ?>" tabindex="1" placeholder="<?php _e( 'Name' , 'wpbootstrap' ) ; ?>" <?php if ( $req ) echo "aria-required='true'" ; ?> />
	  </div>
	</div>
	<div class="form-group">
	  <label for="email" class="sr-only"><?php _e( 'Email' , 'wpbootstrap' ) ; ?></label>
	  <div class="col-md-5">
	    <input type="text" id="email" name="email" class="form-control" value="<?php echo esc_attr( $comment_author_email ) ; ?>" tabindex="2" placeholder="<?php _e( 'Email' , 'wpbootstrap' ) ; ?>" <?php if ( $req ) echo "aria-required='true'" ; ?> />
	  </div>
	</div>
	<div class="form-group">
	  <label for="url" class="sr-only"><?php _e( 'Url' , 'wpbootstrap' ) ; ?></label>
	  <div class="col-md-5">
	    <input type="text" id="url" name="url" class="form-control" value="<?php echo esc_attr( $comment_author_url ) ; ?>" tabindex="3" placeholder="<?php _e( 'Url' , 'wpbootstrap' ) ; ?>" />
	  </div>
	</div>
      <?php endif ; /* ! is_user_logged_in() */ ?>
    <div class="form-group">
      <label class="sr-only" for="comment"><?php _e( 'Comment' , 'wpbootstrap' ) ; ?></label>
      <div class="col-md-10">
        <textarea class="input-lg form-control" id="comment" name="comment" tabindex="4" placeholder="<?php _e( 'Comment' , 'wpbootstrap' ) ; ?>"></textarea>
      </div>
    </div> 
    <div class="form-group">
      <div class="col-md-10">
        <input type="submit" class="btn btn-primary btn-sm" tabindex="5" value="Post comment"/>
	<?php comment_id_fields() ; ?>
      </div> 
    </div>
    <?php do_action( 'comment_form' , $post->ID ) ; ?>
  </form> <!-- form -->
  <?php endif ; ?>        
  </div> <!-- #respond -->
<?php endif ;
do_action( 'bwp_after_comments' ) ; 
