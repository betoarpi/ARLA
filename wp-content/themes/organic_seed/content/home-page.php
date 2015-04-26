<!-- BEGIN .information -->
<div class="information">

	<?php if ( has_post_thumbnail() ) { ?>
		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'seed-featured-medium' ); ?></a>
	<?php } ?>
	
	<div class="text-holder">
		<h2 class="title text-center"><?php the_title(); ?></h2>
		<?php the_excerpt(); ?>
	</div>

	<div class="align-center text-center">
		<a class="button" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php _e("Learn More", 'organicthemes'); ?></a>
	</div>

<!-- END .information -->
</div>