<?php
/**
* Base Comment Template
**/
?>

<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<p>
  <em><?php the_time('l, F jS, Y'); ?></em>
</p>
<?php the_excerpt() ;?>
<a href="<?php the_permalink(); ?>">
  More &raquo
</a>
<hr>