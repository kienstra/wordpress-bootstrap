<?php get_header() ; ?>

<?php $number_of_results = $wp_query->found_posts ; ?>
<div class="jumbotron">
  <div class="container">
    <h3>Search for:&nbsp;<span class="search-keyword">&ldquo;<?php the_search_query() ; ?>&rdquo; </span></h3>
    <?php if ( '' == $number_of_results || 0 == $number_of_results ) : ?>
      <p>
        <span class="label label-danger">
         <?php _e( 'No search results' ) ; ?> 
        </span>
	&nbsp; <?php _e( 'Try different terms.' ) ; ?>
      </p>
    <?php else : ?>
      <p>
        <span class="label label-success">
	  <?php echo $number_of_results . __( ' results' ) ; ?>
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
	    <h2 id="post-<?php the_ID() ; ?>">
	      <a href="<?php the_permalink() ; ?>">
		<?php the_title() ; ?>
	      </a>
	    </h2>
	    <div class="search-entry">
	      <p>
		<?php echo wp_trim_words( get_the_excerpt() , 25 , '...' ) ; ?>
	      </p>
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
       <?php else : // No search results ?>
         <p>
	   <?php _e( 'This might be useful:' ) ; ?>
	 </p>
	 <div class="row">
	   <div class="col-md-6 search-posts">
	     <h3>
	       <?php _e( 'Articles' ) ; ?>
	     </h3>
	     <?php
	       $arguments = array(
		 'numberposts' => '10' ,
		 'post_status' => 'publish'
	       ) ;
	       $recent_posts = wp_get_recent_posts( $arguments ) ;

	       echo '<div class="list-group">' ;
		 foreach( $recent_posts as $post ) {
		   echo '<a class="list-group-item" href="' . get_permalink( $post[ "ID" ] ) . '">' . $post[ "post_title" ] . '</a>' ;
		 }
	       echo '</div>' ; // .list-group

	     ?>
	   </div> <!-- .search-posts -->
           <div class="col-md-6 site-pages">
	     <h3>
	       <?php _e( 'Pages' ) ; ?>
	     </h3>
   
             <?php $pages = get_pages() ;
	     bwp_echo_list_group_of_pages( $pages ) ; 
	     ?>
	   
	   </div>
	 </div>
       <?php endif ; // have_posts ?>
     </div>
     <?php get_sidebar() ; ?>
   </div>
</div>
   
<?php get_footer() ; ?>		   
	
