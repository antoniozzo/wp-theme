<!doctype html>  
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<!--=== META ===-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--=== CSS ===-->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/css/app.min.css">
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/css/app.ie.css"><![endif]-->
	
	<!--=== ICONS ===-->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/57x57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/114x114.png">

	<!--=== SCRIPTS ===-->
	<script type="text/javascript">
		var ANZO = ANZO || {};
		ANZO.themePath = "<?php echo get_stylesheet_directory_uri(); ?>";
	</script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/js/main.js"></script>

	<!--=== TITLE ===-->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

	<!--=== WP_HEAD() ===-->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<header class="header">

		<nav class="header-nav">
			<?php
				wp_nav_menu(array(
					'theme_location' => 'top_menu',
					'container' => false
				));
			?>
		</nav>

	</header>
