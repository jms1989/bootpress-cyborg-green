<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
     <!-- Static navbar -->
      <div class="navbar navbar-default navbar-static-top" role="navigation">
	  <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name') ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <?php wp_nav_menu(array(
			'container_class' => 'menu',
			'theme_location' => 'primary',
			'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav navbar-right">%3$s</ul>',
			'fallback_cb'    => 'bootpress_link_to_menu_editor',
			'depth' => 3,
			'walker' => new wp_bootstrap_navwalker,
		)); ?>
        </div><!--/.nav-collapse -->
		</div>
      </div>
<div class="container">
<div class="row row-offcanvas row-offcanvas-right">
<div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">View Sidebar</button>
          </p>