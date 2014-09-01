<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

<?php get_header() ; ?>
  <?php $number_of_results = $wp_query->found_posts ; ?>
  <div class="jumbotron">
    <div class="container">
      <h3>Search for:&nbsp;<span class="search-keyword">&ldquo;<?php the_search_query() ; ?>&rdquo; </span></h3>
      <?php if ( '' == $number_of_results || 0 == $number_of_results ) : ?> 
	<p>
	  <span class="label label-danger">
	   <?php _e( 'Sorry, no search results.' , 'wpbootstrap' ) ; ?> 
	  </span>
	  &nbsp; <?php _e( 'Try different terms.' , 'wpbootstrap' ) ; ?>
	</p>      
      <?php else : ?>
	<p>
	  <span class="label label-success">
	    <?php printf( _n( '1 result' , '%s results' , $number_of_results , 'wpbootstrap' ) , $number_of_results ) ; ?>
	  </span>
	</p>
      <?php endif ; ?>
      <div class="row">
	<div class="col-md-5">
	  <?php get_search_form() ; ?>
	</div>
      </div>
    </div>
  </div>

  <div class="container" id="main-container">
    <div class="row">
      <div class="col-md-8">
	<?php if ( have_posts() ) : ?>
	  <h1><?php _e( 'Results' ) ; ?></h1>
	  <?php while ( have_posts() ) : the_post() ; ?>
	    <article <?php post_class() ; ?>>
	      <a href="<?php the_permalink() ; ?>">
		<?php the_post_thumbnail(
	      '' , array( 'class' => 'pull-right img-responsive img-rounded search-thumbnail' ) ) ; ?>
	      </a>
	      <h2 id="post-<?php the_ID() ; ?>">
		<a href="<?php the_permalink() ; ?>">
		  <?php the_title() ; ?>
		</a>    
	      </h2>
	      <div class="search-entry">
		<p>
		  <?php the_excerpt() ; ?>
		</p>
	      </div>
	      <div class="clearfix">
	      </div>
	    </article>
	    <hr/>
	  <?php endwhile ; ?>
	  <ul class="pager">
	    <li>
	      <?php next_posts_link( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Previous results' ) ; ?>
	    </li>
	    <li>
	      <?php previous_posts_link( 'Next results&nbsp;<span class="glyphicon glyphicon-chevron-right"</span>' ) ; ?>
	    </li>
	  </ul>
	 <?php else : /* No search results */ ?>
	   <?php get_template_part( 'bwp-posts-and-pages' ) ; ?>
	 <?php endif ; /* have_posts */ ?>
       </div>
       <?php get_sidebar() ; ?>
     </div>
  </div>
<?php get_footer() ; ?>		   
	
