<div class="wrap snow-storm">
	<h2><?php _e('Snow Storm', 'snow-storm'); ?></h2>
	<form action="" method="post" id="snow-storm-form">	
		<?php

		wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false);
		wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); 
		
		?>
	
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="postbox-container-1" class="postbox-container">
					<?php do_action('submitpage_box'); ?>
					<?php do_meta_boxes('settings_page_snow-storm', 'side', false); ?>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<?php do_meta_boxes('settings_page_snow-storm', 'high', false); ?>
					<?php do_meta_boxes('settings_page_snow-storm', 'normal', false); ?>
                    <?php do_meta_boxes('settings_page_snow-storm', 'advanced', false); ?>
				</div>
			</div>
		</div>
	</form>
</div>