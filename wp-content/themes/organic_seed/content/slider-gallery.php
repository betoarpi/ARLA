<!-- BEGIN .slideshow gallery-slideshow -->
<div class="slideshow gallery-slideshow">
	
	<!-- BEGIN .flexslider -->
	<div class="flexslider loading" data-speed="<?php echo get_theme_mod('transition_interval'); ?>" data-transition="<?php echo get_theme_mod('transition_style'); ?>">
	
		<div class="preloader"></div>
	
		<!-- BEGIN .slides -->
		<ul class="slides">
				
			<?php $data = array(
				'post_parent'		=> $post->ID,
				'post_type' 		=> 'attachment',
				'post_mime_type' 	=> 'image',
				'order'         	=> 'ASC',
				'orderby'	 		=> 'menu_order',
				'numberposts' 		=> -1
			); ?>
			
			<?php
			$images = get_posts($data); foreach( $images as $image ) {
				$imageurl = wp_get_attachment_url($image->ID);
				echo '<li><img src="'.$imageurl.'" /></li>' . "\n";
			} ?>
			
		<!-- END .slides -->
		</ul>
		
	<!-- END .flexslider -->
	</div>

<!-- END .slideshow gallery-slideshow -->
</div>