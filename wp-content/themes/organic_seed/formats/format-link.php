<!-- BEGIN .post class -->
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<i class="format-icon fa fa-link"></i>
	
	<h2 class="headline"><a href="<?php if ( get_post_meta($post->ID, 'l_url', true) ) { echo get_post_meta($post->ID, 'l_url', true); } else { the_permalink(); } ?>" rel="bookmark" target="_blank"><?php the_title(); ?> </a></h2>

	<?php if ( !empty( $post->post_excerpt ) ) { ?>
	<div class="article">
		<?php the_excerpt(); ?>
		<?php if ( get_post_meta($post->ID, 'l_url', true) ) { ?> 
			<a class="button" href="<?php echo get_post_meta($post->ID, 'l_url', true); ?>" target="_blank"><?php _e("Visit Link", 'organicthemes'); ?> <i class="fa fa-external-link"></i></a>
		<?php } ?> 
	</div>
	<?php } ?>

<!-- END .post class -->
</div>