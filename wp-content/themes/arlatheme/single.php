<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
	<div class="blog-post-container container-fluid">
		<div class="container MB40">
			<div class="row">
				<figure class="post-icon">
					<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/blog-icon.png" alt="Ícono Blog">
				</figure>
				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
				<div class="col-sm-8">
					<article class="col-sm-12">
						<h1 class="post-title"><?php the_title(); ?><hr></h1>
						<h5 class="post-subtitle"><?php the_field('post_subtitle'); ?></h5>
						
						<?php the_content(); ?>
						<hr>
					</article><!-- ends article -->
					<div class="clear MT20"></div>

					<?php if ( get_the_author_meta( 'description' ) ) : ?>
					<figure class="col-sm-1 user-avatar">
						<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 240 ); ?></a>
					</figure>

					<div class="col-sm-11">
						<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" class="autor"><?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></a>
						<span class="autor-title">Diseñador Gráfico &amp; Desarrollador de Interfaces</span>
						
						<ul class="autor-social">
							<li>Sígueme en <?php the_author_meta( 'first_name' ); ?> <?php the_author_meta( 'last_name' ); ?></li>
							<li><a class="social-icon" href="https://twitter.com/betoarpi" target="_blank"><span class="icon-twitter2"></span></a></li>
							<li><a class="social-icon" href="https://www.linkedin.com/pub/roberto-alonso-arroyo-pineda/42/44/433" target="_blank"><span class="icon-linkedin2"></a></li>
						</ul>
					</div>
					<hr class="left w100 MT10">
					<?php endif; ?>

					<aside class="col-sm-12 comments-area MB20">
						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
						?>
					</aside> <!-- end comments area -->
					
					<div class="col-sm-12 newsletter-form">
						<h3>¿Te gustaría recibir más tips como <?php if ( is_author() ) { ?>estos?<?php } else {?> este?<?php } ?><hr></h3>
						<p class="Tcenter">Subscríbete a nuestro boletín de noticias y recibe los mejores tips para hacer crecer tu negocio.</p>
						<?php echo do_shortcode('[contact-form-7 id="12" title="Suscripción al Newsletter"]') ?>
					</div>
				</div>

				<?php get_sidebar(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div><!-- Blog Post Container -->
<?php get_footer(); ?>
