<!-- BEGIN .slideshow -->
<div class="slideshow radius-full">

	<!-- BEGIN .flexslider -->
	<div class="flexslider radius-full loading" data-speed="<?php echo get_theme_mod('transition_interval'); ?>" data-transition="<?php echo get_theme_mod('transition_style'); ?>">
	
		<div class="preloader"></div>
		
		<!-- BEGIN .slides -->
		<ul class="slides">
		
			<?php $slider = new WP_Query(array('cat'=>get_theme_mod('category_slideshow_home'), 'posts_per_page'=>get_theme_mod('postnumber_slideshow_home'), 'suppress_filters'=>0)); ?>
			<?php if($slider->have_posts()) : while($slider->have_posts()) : $slider->the_post(); ?>
			<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
			
			<li>
				
				<?php if ( ! empty( $post->post_excerpt ) ) { ?>
				
				<!-- BEGIN .eleven columns -->
				<div class="eleven columns">
					<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
						<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
					<?php } else { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'seed-featured-large' ); ?></a>
						<?php } else { ?>
							<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/default-img.svg" alt="<?php the_title(); ?>" /></a>
						<?php } ?>
					<?php } ?>
				<!-- END .eleven columns -->
				</div>
				
				<!-- BEGIN .five columns -->
				<div class="five columns">
					<div class="information">
						<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="excerpt"><?php the_excerpt(); ?></div>
					</div>
				<!-- END .five columns -->
				</div>
				
				<?php } else { ?>
				
				<!-- BEGIN .sixteen columns -->
				<div class="sixteen columns">
					<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
						<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
					<?php } else { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'seed-featured-large' ); ?></a>
						<?php } else { ?>
							<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/default-img.svg" alt="<?php the_title(); ?>" /></a>
						<?php } ?>
					<?php } ?>
				<!-- END .sixteen columns -->
				</div>
				
				<?php } ?>
				
			</li>
			
			<?php endwhile; ?>
			<?php endif; ?>
			
		<!-- END .slides -->
		</ul>
		
	<!-- END .flexslider -->
	</div>

<!-- END .slideshow -->
</div>