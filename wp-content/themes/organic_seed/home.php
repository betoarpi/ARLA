<?php
/**
* This template is used to display the home page.
*
* @package Seed
* @since Seed  1.0
*
*/
get_header(); ?>

<?php if ( '' != get_theme_mod( 'category_slideshow_home' ) ) { ?>

<!-- BEGIN .row -->
<div class="row">

	<!-- BEGIN .content -->
	<div class="content">

		<!-- BEGIN .sixteen columns -->
		<div class="sixteen columns">
			
			<!-- BEGIN .home-slider -->
			<div class="home-slider">
			
				<?php get_template_part( 'content/slider', 'featured' ); ?>
				
			<!-- END .home-slider -->
			</div>
	
		<!-- END .sixteen columns -->
		</div>
	
	<!-- END .content -->
	</div>

<!-- END .row -->
</div>

<?php } ?>

<!-- BEGIN .row -->
<div class="row">

	<!-- BEGIN .content -->
	<div class="content">
	
		<!-- BEGIN .homepage -->
		<div class="homepage">
		
			<?php if ( 'false' != get_theme_mod( 'page_left' ) && 'false' != get_theme_mod( 'page_mid' ) && 'false' != get_theme_mod( 'page_right' ) ) { ?>
			<?php if ( '' != get_theme_mod( 'page_left' ) && '' != get_theme_mod( 'page_mid' ) && '' != get_theme_mod( 'page_right' ) ) { ?>
			
			<!-- BEGIN .featured-pages -->
			<div class="featured-pages radius-full">
			
				<div class="holder third first">
					<?php $recent = new WP_Query('page_id='.get_theme_mod('page_left')); while($recent->have_posts()) : $recent->the_post(); ?>
						<?php get_template_part( 'content/home', 'page' ); ?>
					<?php endwhile; ?>
				</div>
				
				<div class="holder third">
					<?php $recent = new WP_Query('page_id='.get_theme_mod('page_mid')); while($recent->have_posts()) : $recent->the_post(); ?>
						<?php get_template_part( 'content/home', 'page' ); ?>
					<?php endwhile; ?>
				</div>
				
				<div class="holder third last">
					<?php $recent = new WP_Query('page_id='.get_theme_mod('page_right')); while($recent->have_posts()) : $recent->the_post(); ?>
						<?php get_template_part( 'content/home', 'page' ); ?>
					<?php endwhile; ?>
				</div>
			
			<!-- END .featured-pages -->
			</div>
		
			<?php } ?>
			<?php } ?>
			
			<!-- BEGIN .featured-posts -->
			<div class="featured-posts">
			
			<?php if ( '-1' != get_theme_mod( 'category_news' ) ) { ?>
			<?php if ( '' != get_theme_mod( 'category_news' ) ) { ?>
		
				<!-- BEGIN .eight columns -->
				<div class="eight columns">
				
					<!-- BEGIN .home-news -->
					<div class="home-news radius-full">
					
					
						<?php get_template_part( 'content/home', 'post' ); ?>
					
					<!-- END .home-news -->
					</div>
				
				<!-- END .eight columns -->
				</div>
				
			<?php } ?>
			<?php } ?>
			
			<?php if ( '-1' != get_theme_mod( 'category_tabs' ) ) { ?>
			<?php if ( '' != get_theme_mod( 'category_tabs' ) ) { ?>
				
				<!-- BEGIN .eight columns -->
				<div class="eight columns">
				
					<!-- BEGIN .home-tabs -->
					<div class="home-tabs">
					
						<?php get_template_part( 'content/home', 'tabs' ); ?>
					
					<!-- END .home-tabs -->
					</div>
				
				<!-- END .eight columns -->
				</div>
				
			<?php } ?>
			<?php } ?>
		
			<!-- END .featured-posts -->
			</div>
	
		<!-- END .homepage -->
		</div>
	
	<!-- END .content -->
	</div>

<!-- END .row -->
</div>

<?php get_footer(); ?>