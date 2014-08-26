
<?php if ( have_comments() ) : ?>
<h3 id="comments">
  <span class="glyphicon glyphicon-comment"></span> &nbsp;
  <?php comments_number( 'No comment' , 'A comment' , '% comments' ) ; ?>
  <a class="btn btn-sm btn-primary pull-right" href="#respond-post">
    <span class="glyphicon glyphicon-plus"></span> &nbsp;
    Comment
  </a>
</h3>

<ol class="comment-area media-list">
  <?php wp_list_comments( 'callback=bwp_comment_list' ) ; ?>
</ol>

<ul class="pager">
  <li>
    <?php previous_comments_link( '<span class="glyphicon glyphicon-chevron-left"></span> &nbsp; Previous comments' ) ; ?>
  </li>
  <li>
    <?php next_comments_link( '<span class="glyphicon glyphicon-chevron-right"></span> &nbsp; Next comments' ) ; ?>
  </li>
</ul>

<?php endif ; ?>

<?php if ( comments_open() ) : ?>

<div id="respond-post">
  <h4><?php comment_form_title( 'Leave a comment' , 'Leave a comment for %' ) ; ?></h4>
  <div class="cancel-reply-comment">
    <?php cancel_comment_reply_link() ; ?>
  </div>

  <?php if ( ( ! is_user_logged_in() ) && ( get_option( 'comment_registration' ) ) ) : ?>
    <p>Please <a href="<?php echo wp_login_url( get_permalink() ) ; ?>">log in</a> to make a comment.</p>
  <?php else : ?>
    <form class="form-horizontal" role="form" action="<?php echo site_url( 'wp-comments-post.php' ) ; ?>" method="post" id="comment-form">
    <?php if ( is_user_logged_in() ) : ?>
      <p>
        Welcome,&nbsp;<a href="<?php echo site_url( 'wp-admin/profile.php' ) ; ?>"><?php echo $user_identity ; ?></a>.
        <a href="<?php wp_logout_url( get_permalink() ) ; ?>" title="Log out">Log out</a>
      </p>
    <?php else : ?>
      <div class="form-group">
        <label for="author" class="sr-only">Name</label>
	<div class="col-md-5">
	  <input type="text" id="author" class="form-control" name="author" value="<?php echo esc_attr( $comment_author ) ; ?>" tabindex="1" placeholder="Name" <?php if ( $req ) echo "aria-required='true'" ; ?> />
        </div>
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">Email</label>
	<div class="col-md-5">
	  <input type="text" id="email" name="email" class="form-control" value="<?php echo esc_attr( $comment_author_email ) ; ?>" tabindex="2" placeholder="Email" <?php if ( $req ) echo "aria-required='true'" ; ?> />
	</div>
      </div>
      <div class="form-group">
        <label for="url" class="sr-only">Url</label>
	<div class="col-md-5">
	  <input type="text" id="url" name="url" class="form-control" value="<?php echo esc_attr( $comment_author_url ) ; ?>" tabindex="3" placeholder="Url" />
	</div>
      </div>
    <?php endif ; ?>
    <div class="form-group">
      <label class="sr-only" for="comment">Comment</label>
      <div class="col-md-10">
        <textarea class="input-lg form-control" id="comment" name="comment" tabindex="4" placeholder="Comment"></textarea>
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
  </div><!-- #respond-post -->
<?php endif ; ?>        










