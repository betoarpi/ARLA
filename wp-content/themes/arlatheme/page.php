<?php
/**
 * The template for displaying all pages
 * @package WordPress
 * @subpackage ARLA_Design_Lab_Theme
 * @since ARLA Design Lab Theme 1.0
 */

get_header(); ?>

	<?php if ( is_front_page() ) { ?>
	<div id="servicios" class="container-fluid">
		<div class="container">
			<!-- <div class="row">
				<div class="col-sm-4 servicio diseno-digital">
					<figure class="servicio-icono">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/diseno-digital.png" alt="Ícono Diseño Digital">
					</figure>
					<h2 class="title">Diseño Digital<hr></h2>
					<p>Comunicamos ideas y diseñamos experiencias para audiencias digitales.</p>
				</div>

				

				<div class="col-sm-4 servicio">
					<figure class="servicio-icono">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/marketing-digital.png" alt="Ícono Marketing Digital">
					</figure>
					<h2 class="title">Marketing Digital<hr></h2>
					<p>Creamos estrategias de marketing que enganchan a tu audiencia con tu marca y hacen crecer tu empresa.</p>
				</div>
				<div class="col-sm-4 servicio">
					<figure class="servicio-icono">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/posicionamiento.png" alt="Ícono Posicionamiento en Buscadores">
					</figure>
					<h2 class="title">Posicionamiento (SEO)<hr></h2>
					<p>Monitoreamos y analizamos el tráfico de tu página de internet para darte mayor presencia en la red.</p>
				</div>
			</div> -->
			
			<div class="row">
				<div class="col-sm-4 servicio">
					<figure class="servicio-icono">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/outsourcing.png" alt="Ícono Outsourcing">
					</figure>
					<h2 class="title">Outsourcing<hr></h2>
					<p>Nuestro servicio de outsourcing es el complemento creativo de tu equipo de trabajo.</p>
				</div>
				<div class="col-sm-4 servicio">
					<figure class="servicio-icono">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/desarrollo-web.png" alt="Ícono Desarrollo Web">
					</figure>
					<h2 class="title">Diseño y Desarrollo Web<hr></h2>
					<p>Desarrollamos sitios web responsivos que permiten que tus clientes se conecten rápidamente a tus productos o servicios.</p>
				</div>
				<div class="col-sm-4 servicio">
					<figure class="servicio-icono">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/consultoria-creativa.png" alt="Ícono Consultoría Creativa">
					</figure>
					<h2 class="title">Consultoría Creativa<hr></h2>
					<p>Entendemos las necesidades digitales de tu empresa, convirtiéndolas en fortalezas para lograr tus objetivos.</p>
				</div>
			</div>
		</div>
	</div><!-- ends Servicios -->

	<div id="nuestro-proceso" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="title TTUC">Nuestro Proceso</h2>
					<p class="Tcenter DB M0A w60 MB40"><em>Vivimos el diseño y la tecnología, nos enfocamos en brindar soluciones que integren tus servicios con las bondades tecnológicas de la red.</em></p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 proceso-columna">
					<figure class="process-icon">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/ideas-icon.png" alt="Lluvia de ideas">
					</figure>
					<h3 class="subtitle">Ideas<hr></h3>
					<p>Creamos una lluvia de ideas a partir del estudio, entendimiento y análisis, tanto del proyecto como de la empresa y público objetivo.</p>
				</div>
				<div class="col-sm-3 proceso-columna">
					<figure class="process-icon">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/planeacion-icon.png" alt="Planeación">
					</figure>
					<h3 class="subtitle">Planeación<hr></h3>
					<p>Elaboramos un plan de acción para ejecutar correctamente las distintas fases del proyecto.</p>
				</div>
				<div class="col-sm-3 proceso-columna">
					<figure class="process-icon">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/diseno-icon.png" alt="Diseño">
					</figure>
					<h3 class="subtitle">Diseño<hr></h3>
					<p>Diseñamos la comunicación visual de tu negocio materializando las ideas en fortalezas.</p>
				</div>
				<div class="col-sm-3 proceso-columna">
					<figure class="process-icon">
						<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/desarrollo-icon.png" alt="Desarrollo">
					</figure>
					<h3 class="subtitle">Desarrollo<hr></h3>
					<p>Le damos vida al proyecto, brindándole a tu cliente una nueva experiencia de consumo de tu servicio o producto.</p>
				</div>
			</div>
		</div>
	</div><!-- ends Nuestro Proceso -->

	<div id="nosotros" class="container-fluid">
		<div class="container">
			<div class="row">
				<article class="col-sm-8 col-sm-offset-2">
					<h2 class="title">Acerca de Nosotros<hr></h2>

					<p>Una de las razones por las que estamos en esta ruta es porque amamos el queso y el vino. Encontramos en San Juan del Río, Querétaro, todas las bondades de un pequeño poblado combinadas con los beneficios de las grandes ciudades. Somos una agencia creativa digital que potencia las ideas y crecimiento tanto de PyMes, de Startups como de proyectos personales. Hacemos equipo con otras agencias creativas que buscan complementar sus servicios con los nuestros.</p>

					<p><strong>ARLA Design Lab</strong> somos Mónica Lara y Rob Arroyo, dos Diseñadores Gráficos y entusiastas de la tecnología. Hemos trabajado con agencias digitales en proyectos para compañías nacionales e internacionales. La experiencia adquirida nos hace afrontar y entender los retos a los que cualquier empresa o emprendedor se enfrenta en esta actualidad cambiante.</p>

					<p>Somos el complemento que te hace falta para concretar tu idea. Queremos conocer tu proyecto.</p>

					<h3 class="Tcenter">¡Ponte en contacto!</h3>
				</article>
			</div>
		</div>
	</div><!-- ends Acerca de Nosotros -->
	<?php } elseif ( ! is_front_page() ) { ?>
	<section class="blog-post-container container-fluid">
		<div class="container">
			<div class="row">
				<figure class="post-icon">
					<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/blog-icon.png" alt="Ícono Blog">
				</figure>
				<article class="col-sm-8 col-sm-offset-2" role="main">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>    
					
					<h1 class="post-title"><?php the_title(); ?><hr></h1>
					<!-- <h4 class="post-subtitle"><?php // the_field('page_subtitle'); ?></h4> -->

					<?php the_content(); ?>
					
					<?php endwhile; ?>
				<?php endif; ?>
				</article>
			</div>
		</div>
	</section><!-- Blog Post Container -->
	<?php } ?>

<?php get_footer(); ?>
