  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('|',1,'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
  </head>
  <body>
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url();?>"><?php bloginfo('name'); ?></a> 
        </div>
        <div class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">
	    <?php  wp_nav_menu( array( 
		    'menu' => 'main_menu' ,
	            'depth' => 2 ,
                    'container' => false ,
                    'menu_class' => 'nav navbar-nav' ,
                    'walker' => new wp_bootstrap_navwalker()
                   ) );                                   
            ?>
	  </ul>
	  </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="container">
