<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php // bloginfo('name'); ?><?php wp_title('|',true,''); ?></title>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.png">
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php bloginfo('stylesheet_url'); ?>" title="fcstandard2014" />
	<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_directory'); ?>/print.css" />
    <!-- Font -->
    <link href='http://fonts.googleapis.com/css?family=Pirata+One' rel='stylesheet' type='text/css'>
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php bloginfo('name') ?> RSS feed" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php bloginfo('name') ?> comments RSS feed" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_head() // Do not remove; helps plugins work ?>
</head>
<body class="<?php fcstandard2014_body_class() ?>">    
<div id="page" class="hfeed">
	<div class="hidden-xs">
		<div id="head" class="container">
    		<div class="col-sm-4"></div>
    		<div id="site-brand" class="col-sm-4">
        		<h1><a href="<?php echo get_settings('home') ?>/" title="<?php bloginfo('name') ?>"><img src="<?php bloginfo('template_directory'); ?>/images/HBC-logo.png" alt="<?php bloginfo('name') ?>" class="img-responsive" /></a></h1>
        	</div><!-- #site-brand -->
        	<div class="col-sm-4"></div>
    	</div>
		<div class="navbar navbar-default container hidden-xs navborders" role="navigation">
			<?php wp_nav_menu( array( 'container' => 'nav', 'menu_class' => 'nav nav-pills', 'theme_location' => 'primary_menu', 'walker'  => new bootstrap_submenu) ); ?>                            
    	</div>
	</div><!-- end desktop logo and nav-->
    <div class="navbar navbar-default container visible-xs" role="navigation">
    	<div class="row mobile-header">
        	<div class="col-xs-9">
            	<h1><a href="<?php echo get_settings('home') ?>/" title="<?php bloginfo('name') ?>"><img src="<?php bloginfo('template_directory'); ?>/images/HBC-logo.png" alt="<?php bloginfo('name') ?>" class="img-responsive" /> </a></h1>
            </div>
        	<div class="col-xs-2 pull-right mobile-nav">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      				<span class="sr-only">Toggle navigation</span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
      				<span class="icon-bar"></span>
   				</button>
        	</div>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <?php wp_nav_menu( array( 'container' => 'div', 
									'container_class' => 'nav-collapse nav-pills',
									'menu_class'      => 'nav',
									'echo'            => true,
          							'fallback_cb'     => 'wp_page_menu',
									'theme_location'  => 'primary_menu', 
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => -1,
									) ); ?>                      
        </div>
	</div>
     
            