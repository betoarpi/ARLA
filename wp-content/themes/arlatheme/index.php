<?php
/**
 * The main template file
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
				<?php
					if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
						// Include the featured content template.
						get_template_part( 'featured-content' );
					}
				?>

				<?php if (have_posts()) : ?>
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
					<?php endwhile;
							// Previous/next page navigation.
							twentyfourteen_paging_nav();

						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>
				</section>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div><!-- Blog Post Container -->

<?php get_footer(); ?>
