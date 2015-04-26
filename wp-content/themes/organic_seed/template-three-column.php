<?php
/**
Template Name: Three Column
*
* This template is used to display three column pages featuring two sidebars.
*
* @package Seed
* @since Seed 1.0
*
*/
get_header(); ?>

<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="page-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="feature-img banner"><?php the_post_thumbnail( 'seed-featured-large' ); ?></div>
	<?php } ?>
	
	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .content -->
		<div class="content">
	
			<!-- BEGIN .three columns -->
			<div class="three columns">
			
				<?php get_sidebar('left'); ?>
				
			<!-- END .three columns -->
			</div>
			
			<!-- BEGIN .eight columns -->
			<div class="eight columns">
	
				<!-- BEGIN .postarea middle -->
				<div class="postarea middle">
				
					<?php get_template_part( 'loop', 'page' ); ?>
				
				<!-- END .postarea middle -->
				</div>
			
			<!-- END .eight columns -->
			</div>
			
			<!-- BEGIN .five columns -->
			<div class="five columns">
			
				<?php get_sidebar(); ?>
				
			<!-- END .five columns -->
			</div>
		
		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>
	
<!-- END .post class -->
</div>

<?php get_footer(); ?>