<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<i class="format-icon fa fa-picture-o"></i>
	
	<h2 class="caption"><span><?php the_title(); ?></span></h2>
	
	<?php if ( has_post_thumbnail() ) { ?>
		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'seed-featured-large' ); ?></a>
	<?php } else { ?>
		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php get_template_directory_uri(); ?>/images/default-img.svg" alt="<?php the_title(); ?>" /></a>
	<?php } ?>

<!-- END .post class -->
</div>