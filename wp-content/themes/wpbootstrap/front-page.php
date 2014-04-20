<?php get_header(); ?>
<style type="text/css"> 
  div.navbar-header a.navbar-brand { color: rgb(51, 51, 51) } 
</style>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php the_content(); ?>
<?php endwhile; else: ?>
      <p><?php _e('Sorry, no posts matched your criteria' ); ?></p>
<?php endif; ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
<div class="container">
<h1>Hello, world!</h1>
<p>
This is a new template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.
</p>
<a class="btn btn-primary btn-lg" role="button">Learn</a>

</div>
</div>
<div class="container"><!-- Example row of columns -->
<div class="row">

<div class="col-md-6">
<h2 class="copy-one-heading">
  <?php echo get_theme_mod( 'copy_one_heading' ) ; ?>
</h2>
<span class="copy-one">
  <?php echo get_theme_mod( 'copy_one' ) ;?>
</span>
</br>
<a class="btn btn-default" role="button" href="#">View </a>
</div>

<div class="col-md-6">
  <h2 class="heading-right-side">
    <?php echo get_theme_mod( 'heading_right_side' ) ; ?>
  </h2>
  <span class="copy-right-side">
    <?php echo get_theme_mod( 'copy_right_side' ) ; ?>
  </span>
</br>
<a class="btn btn-default" role="button" href="#">View </a>

</div>

<!--
<div class="col-md-6">
<h2>Heading</h2>
Donec sed odio dui. Cras justo odio, dapibus ac facilisis
in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.
Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh,
ut fermentum massa justo sit amet risus.
</br>
<a class="btn btn-default" role="button" href="#">View </a>
</div>
-->

</div>  

<?php get_footer(); ?>
