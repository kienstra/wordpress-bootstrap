  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('|',1,'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <!-- enqueue jumbotron custom styles? Jumbotron%20Template%20for%20Bootstrap_files/jumbotron.css -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

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
	<!-- just added -->
	  <ul class="nav navbar-nav">

	    <?php  wp_nav_menu( array( 
		    'menu' => 'main_menu' ,
	            'depth' => 2 ,
                    'container' => false ,
                    'menu_class' => 'nav navbar-nav' ,
                    'walker' => new wp_bootstrap_navwalker()
                   ) );
                                   
            ?>
	    <?php //wp_list_pages(array('title_li' => '', 'depth' => 1, 'exclude' => 4)); ?>  
	  </ul>
	  </div><!--/.navbar-collapse -->
      </div>
    </div>

    <div class="container">
