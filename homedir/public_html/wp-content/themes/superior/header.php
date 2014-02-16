<!DOCTYPE html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>
		<?php if ( !is_front_page() ) { echo wp_title( ' ', true, 'left' ); echo ' | '; }
		  echo bloginfo( 'name' ); echo ' - '; bloginfo( 'description', 'display' );  
    ?> 
	</title>  

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php global $data;  
  $favicon = $data['favicon']; 
  ?>
  <link rel="icon" type="image/png" href="<?php echo $favicon ?>" />
  <?php wp_head(); ?>
  <?php get_wpbs_theme_options(); ?> 
        <!--[if lt IE 9]>
          <script src="<?php echo get_bloginfo('template_directory'); ?>/js/ie/html5shiv.js"></script>
          <script src="<?php echo get_bloginfo('template_directory'); ?>/js/ie/respond.min.js"></script>
          <script src="<?php echo get_bloginfo('template_directory'); ?>/js/ie/excanvas.js"></script>
        <![endif]-->
        
</head>
<body <?php body_class(); ?>>

<div>
  <div class="header">
    <div class="navbar navbar-fixed-top">
      <div class="container">
        <div class="row clearfix">
          <div class="col-sm-3"> 
            <a class="navbar-brand" href="<?php echo home_url(); ?>/">
							<?php
							global $data; 
							$logo = $data['logo'];
							if ($logo ) {
							 
							?>
							<img src="<?php echo $logo; ?>"  alt="logo"/>
							<?php } else { ?>
							<h1><?php bloginfo('name');?></h1>
							<?php } ?>
						</a>  
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="icon-align-justify"></i>
            </button></div>
        <div class="col-sm-9">
        
          <div class="main-menu navbar-collapse collapse">
		      <?php theme_main_menu(); ?> 
            <!--/.nav-collapse --> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>