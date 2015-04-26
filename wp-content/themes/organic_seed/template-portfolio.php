<?php
/**
Template Name: Portfolio
*
* This template is used to display a 4-column portfolio.
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
		
			<!-- BEGIN .sixteen columns -->
			<div class="sixteen columns">
		
				<?php get_template_part( 'loop', 'portfolio' ); ?>
			
			<!-- END .sixteen columns -->
			</div>
		
		<!-- END .content -->
		</div>
	
	<!-- END .row -->
	</div>

<!-- END .post class -->
</div>

<?php get_footer(); ?>