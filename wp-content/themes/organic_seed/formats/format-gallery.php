<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php get_template_part( 'content/slider', 'gallery' ); ?>
	
	<i class="format-icon fa fa-camera"></i>

	<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
	
	<div class="article">
		<?php the_content(__("Read More", 'organicthemes')); ?>
	</div>

<!-- END .post class -->
</div>