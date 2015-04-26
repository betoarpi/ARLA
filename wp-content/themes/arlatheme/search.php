<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div class="blog-post-container container-fluid">
		<div class="container">
			<div class="row PT20">
				<section class="col-sm-9 MT20" role="main"> 
				<?php if (have_posts()) : ?>  
					<header>
						<h1 class="post-title">
						<?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?>
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
							<h4 class="post-subtitle"><?php the_field('post_subtitle'); ?></h4>
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
