<!-- BEGIN .social -->
<div class="social radius-full">

	<div class="like-btn">
		<div class="fb-like" href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
	</div>
	<div class="tweet-btn">
		<a href="http://twitter.com/share" class="twitter-share-button"
		data-url="<?php the_permalink(); ?>"
		data-via="<?php echo get_theme_mod('twitter_user'); ?>"
		data-text="<?php the_title(); ?>"
		data-related=""
		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
	</div>
	<div class="plus-btn">
		<g:plusone size="medium" annotation="bubble" href="<?php the_permalink(); ?>"></g:plusone>
	</div>

<!-- END .social -->
</div>