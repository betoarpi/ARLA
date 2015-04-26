<?php
/**
* The Header for our theme.
* Displays all of the <head> section and everything up till <div id="wrap">
*
* @package Seed
* @since Seed 1.0
*
*/
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php if ( get_theme_mod('enable_responsive') == '1' ) { ?>
	<!-- Mobile View -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php } ?>
	
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
	
	<?php get_template_part( 'style', 'options' ); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( bloginfo('pingback_url') ); ?>">
	
	<!-- Social Buttons -->
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!-- BEGIN #wrap -->
<div id="wrap">

	<!-- BEGIN .container -->
	<div class="container radius-full shadow">
	
		<!-- BEGIN #header -->
		<div id="header">
		
			<!-- BEGIN .row -->
			<div class="row" <?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) { ?>style="background-image: url(<?php header_image(); ?>);"<?php } ?>>
				
				<!-- BEGIN .sixteen columns -->
				<div class="sixteen columns">
				
				<?php if (is_home() || is_front_page() ) { ?>
				
					<?php if ( get_theme_mod( 'seed_logo' ) ) { ?>
					
						<h1 id="logo" <?php if (get_theme_mod('logo_align') == 'center') { ?>class="text-center"<?php } if (get_theme_mod('logo_align') == 'right') { ?>class="text-right"<?php } ?>>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'seed_logo' ) ); ?>" alt="" />
								<span class="logo-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></span>
							</a>
						</h1>
						
					<?php } else { ?>
					
						<div id="masthead" <?php if (get_theme_mod('title_align') == 'center') { ?>class="text-center"<?php } if (get_theme_mod('title_align') == 'right') { ?>class="text-right"<?php } ?>>
						
							<h1 class="site-title<?php if (get_theme_mod('title_color') == 'white') { ?> white<?php } ?>">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
							</h1>
							
							<h2 class="site-description<?php if (get_theme_mod('title_color') == 'white') { ?> white<?php } ?>">
								<?php echo wp_kses_post( get_bloginfo( 'description' ) ); ?>
							</h2>
							
						</div>
						
					<?php } ?>
					
				<?php } else { ?>
				
					<?php if ( get_theme_mod( 'seed_logo' ) ) { ?>
					
						<h4 id="logo" <?php if (get_theme_mod('logo_align') == 'center') { ?>class="text-center"<?php } if (get_theme_mod('logo_align') == 'right') { ?>class="text-right"<?php } ?>>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( get_theme_mod( 'seed_logo' ) ); ?>" alt="" />
								<span class="logo-text"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></span>
							</a>
						</h4>
						
					<?php } else { ?>
					
						<div id="masthead" <?php if (get_theme_mod('title_align') == 'center') { ?>class="text-center"<?php } if (get_theme_mod('title_align') == 'right') { ?>class="text-right"<?php } ?>>
						
							<h4 class="site-title<?php if (get_theme_mod('title_color') == 'white') { ?> white<?php } ?>">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_kses_post( get_bloginfo( 'name' ) ); ?></a>
							</h4>
							
							<h5 class="site-description<?php if (get_theme_mod('title_color') == 'white') { ?> white<?php } ?>">
								<?php echo wp_kses_post( get_bloginfo( 'description' ) ); ?>
							</h5>
							
						</div>
						
					<?php } ?>
					
				<?php } ?>
				
				<!-- END .sixteen columns -->
				</div>
			
			<!-- END .row -->
			</div>
			
			<!-- BEGIN .row -->
			<div class="row">
			
				<!-- BEGIN #navigation -->
				<nav id="navigation" class="navigation-main<?php if ( ! empty( $header_image ) ) { ?> radius-bottom<?php } else { ?> radius-full<?php } ?>" role="navigation">
				
					<span class="menu-toggle"><i class="fa fa-bars"></i></span>
		
					<?php if ( has_nav_menu( 'header-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'title_li' => '',
							'depth' => 4,
							'container_class' => '',
							'menu_class'      => 'menu'
							)
						);
					} else { ?>
						<div class="menu-container"><ul class="menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul></div>
					<?php } ?>
		
				</nav><!-- END #navigation -->
				
			<!-- END .row -->
			</div>
		
		<!-- END #header -->
		</div>