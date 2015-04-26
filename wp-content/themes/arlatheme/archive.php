<?php
/**
 * The template for displaying Archive pages
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
				<?php if (have_posts()) : ?>  
					<header>
						<h1 class="post-title">
						<?php
							if ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );

							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );

							else :
								_e( 'Archives', 'twentyfourteen' );

							endif;
						?>
						<hr></h1>
					</header>
					
					<!-- <h4 class="post-subtitle"><?php // the_field('page_subtitle'); ?></h4> -->
					
					<?php while (have_posts()) : the_post(); ?>
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
					<?php endwhile; ?>
				<?php endif; ?>
				</section>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- Blog Post Container -->

<?php get_footer(); ?>
