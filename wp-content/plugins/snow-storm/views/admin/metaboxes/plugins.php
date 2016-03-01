<div style="text-align:center;">
	<h4><a href="https://wordpress.org/plugins/newsletters-lite/" target="_blank">WordPress Newsletter plugin</a></h4>
	<p>
		<a href="https://wordpress.org/plugins/newsletters-lite/" target="_blank"><img style="width:200px; height:auto;" width="200" src="<?php echo plugins_url('images/newsletters.png', dirname(dirname(dirname(__FILE__)))); ?>" alt="newsletters" /></a>
	</p>
	<p>
		Get the WordPress Newsletter plugin today. It is a FREE plugin which can be installed by clicking the button below.
	</p>
	<p>
		<a class="install-now button button-primary button-large" href="<?php echo wp_nonce_url(add_query_arg(array('action' => 'install-plugin', 'plugin' => 'newsletters-lite'), admin_url('update.php')), 'install-plugin_newsletters-lite'); ?>"><?php _e('Install Now', 'snow-storm'); ?></a>
		<a class="thickbox button button-secondary button-large" href="<?php echo wp_nonce_url(admin_url('plugin-install.php?tab=plugin-information&plugin=newsletters-lite&TB_iframe=true&width=640&height=591')); ?>" target="_blank"><?php _e('Details', 'snow-storm'); ?></a>
	</p>
</div>