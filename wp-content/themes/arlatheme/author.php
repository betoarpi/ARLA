<?php
/**
 * The template for displaying Author archive pages
 * @package WordPress
 * @subpackage ARLA_Design_Lab_Theme
 * @since ARLA Design Lab Theme 1.0
 */

get_header(); ?>
	<div class="blog-post-container container-fluid">
		<figure class="post-icon">
			<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/blog-icon.png" alt="Ícono Blog">
		</figure>
		<div class="container">
			<div class="row PT20">
				<section class="col-sm-9 MT20" role="main">  
					<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<div class="row MB20">
						<figure class="col-sm-1 user-avatar">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 240 ); ?>
						</figure>

						<div class="col-sm-11">
							<span class="autor"><?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></span>
							<span class="autor-title">Diseñador Gráfico &amp; Desarrollador de Interfaces</span>
							<?php the_author_meta( 'description' ); ?>
							<hr>

							
							<ul class="autor-social">
								<li>Sígueme a <?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></li>
								<li><a class="social-icon" href="<?php if ( is_author('rob') ) { ?>https://twitter.com/betoarpi<?php } ?>" target="_blank"><span class="icon-twitter2"></span></a></li>
								<li><a class="social-icon" href="<?php if ( is_author('rob') ) { ?>https://www.linkedin.com/pub/roberto-alonso-arroyo-pineda/42/44/433<?php } ?>" target="_blank"><span class="icon-linkedin2"></a></li>
							</ul>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( have_posts() ) : ?>
					<header>
						<h1 class="post-title">
							<?php
								/*
								 * Queue the first post, that way we know what author
								 * we're dealing with (if that is the case).
								 *
								 * We reset this later so we can run the loop properly
								 * with a call to rewind_posts().
								 */
								the_post();

								printf( __( 'All posts by %s', 'twentyfourteen' ), get_the_author() );
							?>
						<hr></h1>
					</header>

					<?php
						/*
						 * Since we called the_post() above, we need to rewind
						 * the loop back to the beginning that way we can run
						 * the loop properly, in full.
						 */
						rewind_posts();

						// Start the Loop.
						while ( have_posts() ) : the_post(); ?>
						<article class="post-preview">
							<figure class="post-preview-thumbnail">
								<a href="<?php the_permalink() ?>">
								<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('arla-thumb');
								}
									else {
										echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/assets/img/post-thumb.jpg" />';
								} ?>
								</a>
							</figure>
							<h2 class="post-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Link Permanente a <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<h5 class="post-subtitle"><?php the_field('post_subtitle'); ?></h5>
							<a href="<?php the_permalink() ?>" class="read-more">leer más <span class="glyphicon glyphicon-chevron-right"></span></a>
						</article>

						<?php endwhile;
							// Previous/next page navigation.
							twentyfourteen_paging_nav();

						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 newsletter-form">
							<h3>¿Te gustaría recibir más tips como <?php if ( is_author() ) { ?>estos?<?php } else {?> este?<?php } ?><hr></h3>
							<p class="Tcenter">Subscríbete a nuestro boletín de noticias y recibe los mejores tips para hacer crecer tu negocio.</p>
							<?php echo do_shortcode('[contact-form-7 id="12" title="Suscripción al Newsletter"]') ?>
						</div>
					</div>
				</section>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- Blog Post Container -->
<?php get_footer(); ?>
