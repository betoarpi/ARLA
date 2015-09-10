<?php
/**
 * The Header for our theme
 * @package WordPress
 * @subpackage ARLA_Design_Lab_Theme
 * @since ARLA Design Lab Theme 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="shortcut icon" href="<?php bloginfo( 'template_directory' ); ?>/assets/img/arla-favicon.ico" type="image/x-icon" />

	<!-- Hojas de Estilo -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/assets/css/theme.css">

	<!-- Respond.js -->
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/respond.js"></script>

    <!-- Hacks -->
    <!-- HTML5 shim para compatibilidad con IE -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
	  <style type="text/css">
			.gradient {
			   filter: none;
	    }
	  </style>
	<![endif]-->

	<!-- Modernizr -->
    <script src="<?php bloginfo( 'template_directory' ); ?>/assets/js/modernizr-2.6.2.min.js"></script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 7]>
	    <p class="chromeframe">Estas utilizando un navegador obsoleto. <a class="btn btn-primary" href="http://browsehappy.com/">Descarga un navegador actualizado</a> para una mejor experiencia en este sitio.</p>
	<![endif]-->

	<header class="header container-fuild">
		<div class="container">
			<div class="row">
				<nav class="main-nav col-sx-12">
					<figure class="logo">
						<a href="http://arladesignlab.com" title="inicio">
							<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/arla-design-lab-logo.png" alt="ARLA Design Lab">
						</a>
					</figure>
					<a href="#" class="glyphicon glyphicon-th-list devices-menu"></a>
					<ul>
						<li><a <?php if ( is_front_page() ) { ?>class="smooth"<?php } ?> data-role="none" href="<?php if ( ! is_front_page() ) { ?><?php bloginfo('siteurl'); ?><?php } ?>#servicios" title="servicios">servicios</a></li>
						<li><a <?php if ( is_front_page() ) { ?>class="smooth"<?php } ?> data-role="none" href="<?php if ( ! is_front_page() ) { ?><?php bloginfo('siteurl'); ?><?php } ?>#nuestro-proceso" title="nuestro proceso">nuestro proceso</a></li>
						<li><a <?php if ( is_front_page() ) { ?>class="smooth"<?php } ?> data-role="none" href="<?php if ( ! is_front_page() ) { ?><?php bloginfo('siteurl'); ?><?php } ?>#nosotros" title="acerca de nosotros">acerca de nosotros</a></li>
						<li><a <?php if ( is_front_page() ) { ?>class="smooth"<?php } ?> data-role="none" href="<?php if ( ! is_front_page() ) { ?><?php bloginfo('siteurl'); ?><?php } ?>#contactanos" title="contáctanos">contáctanos</a></li>
						<li>|</li>
						<li><a href="<?php bloginfo('siteurl'); ?>/blog" title="blog">blog</a></li>
					</ul>
				</nav><!-- ends Main Navigation -->
			</div>
		</div>
	</header><!-- ends Main Header -->

	<?php 
	// Display Sliding Banner in case is Front Page
	if ( is_front_page() ) { ?>
	<div class="sliding-banner container-fluid">
		<div class="bxslider-container">
			<ul class="bxslider">
				<li class="startups full-height">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<!-- <img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/sliding-banner/startups.png" alt="Potenciamos las PyMes y Startups"> -->
								<h1 class="banner-title">Somos una Agencia Creativa Digital.<br>
								<span>Potenciamos el crecimiento de las PyMes y Startups.</span></h1>
							</div>
						</div>
					</div>
				</li>
				<li class="tu-proyecto full-height">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<h1 class="banner-title">Tus ideas demandan<br>
								requerimientos únicos.<br>
								<span>Nosotros lo entendemos y le damos vida a tu proyecto.</span></h1>
							</div>
						</div>
					</div>
				</li>
				<li class="ideas full-height">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<h1 class="banner-title">Materializamos digitalmente<br>las ideas de nuestros clientes<br><span>sin importar cuan grande sea el reto.</span></h1>
							</div>
						</div>
					</div>
				</li>
			</ul>
			<a class="platicanos-btn smooth" href="#contactanos">¡Platícanos tu idea!</a>
		</div>
	</div><!-- ends Sliding Banner -->
	<?php } elseif ( ! is_front_page() ) { ?>
	<div class="blog-banner-cover">
		&nbsp;
	</div><!-- ends Blog Banner -->
	<?php } elseif ( ! is_front_page() && is_single() ) { ?>
	<div class="blog-banner-container container-fluid">
		<figure class="blog-banner">
			<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/blog/dinero.jpg" alt="dinero">
		</figure>
	</div><!-- ends Blog Banner -->
	<?php } ?>

