<!-- BEGIN .organic-tabs -->
<div class="organic-tabs">

	<?php $tabs = new WP_Query(array('cat'=>get_theme_mod('category_tabs'), 'posts_per_page'=>get_theme_mod('postnumber_tabs'), 'suppress_filters'=>0)); ?>

	<!-- BEGIN tab buttons -->
	<ul id="tabs">

		<?php if ($tabs->have_posts()) : $count = 1; while ($tabs->have_posts()) : $tabs->the_post(); ?>
		
		<?php $trimtitle = get_the_title(); ?>
		<?php $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = __('...', 'organicthemes') ); ?>
		
		<li><a href="<?php echo esc_url( '#tabs-' . $count ); ?>"><?php echo esc_html( $shorttitle ); ?></a></li>

		<?php $count++; ?>
		<?php endwhile; ?>
	
	<!-- END tab buttons -->
	</ul>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
	
	<?php if ($tabs->have_posts()) : $count = 1; while ($tabs->have_posts()) : $tabs->the_post(); ?>
	<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	
	<!-- BEGIN tab content -->
	<div id="tabs-<?php echo $count; ?>">
	
		<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
			<div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
		<?php } else { ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<a class="feature-img" href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'seed-featured-medium' ); ?></a>
			<?php } ?>
		<?php } ?>
		
		<div class="information">
			<h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<?php the_excerpt(); ?>
		</div>
		
		<a class="button" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php _e("Learn More", 'organicthemes'); ?></a>
	
	<!-- END tab content -->
	</div>

	<?php $count++; ?>
	<?php endwhile; endif; ?>

<!-- END .organic-tabs -->
</div>