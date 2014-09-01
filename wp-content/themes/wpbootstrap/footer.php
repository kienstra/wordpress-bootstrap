<?php defined('ABSPATH') or die( "No direct access!" ) ; ?>

</div> <!-- .container -->
  </div>
    <footer> 
      <div id="footer">
        <nav class="navbar navbar-default navbar-static-bottom" role="navigation">
          <div class="container">
	    <div class="navbar-form navbar-left">
	      <?php echo do_shortcode( '[mc4wp_form]' ) ; ?>
	    </div>
	   </div>
          <p class="copyright-text text-muted"><?php bwp_simple_copyright() ; ?></p>
        </nav>
      </footer>
    <?php wp_footer(); ?>
  </body>
</html>