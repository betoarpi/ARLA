<?php
/**
 * The template for displaying 404 pages (Not Found)
 * @package WordPress
 * @subpackage ARLA_Design_Lab_Theme
 * @since ARLA Design Lab Theme 1.0
 */

get_header(); ?>

	<div class="blog-post-container container-fluid">
		<div class="container MB100">
			<div class="row MB100">
				<figure class="post-icon">
					<img src="<?php bloginfo( 'template_directory' ); ?>/assets/img/blog-icon.png" alt="Ícono Blog">
				</figure>
				<article class="col-sm-8 col-sm-offset-2" role="main">   
					<h1 class="post-title"><?php _e( 'Not Found', 'twentyfourteen' ); ?><hr></h1>
					<h5 class="post-subtitle"><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyfourteen' ); ?></h5>
					
					<?php get_search_form(); ?>
				</article>
			</div>
		</div>
	</div><!-- Blog Post Container -->

<?php
get_footer();
