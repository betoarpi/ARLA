<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
				<article class="col-sm-8 col-sm-offset-2" role="main">   
					<h1 class="post-title"><?php _e( 'Nothing Found', 'twentyfourteen' ); ?><hr></h1>
					
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

					<h4 class="post-subtitle"><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentyfourteen' ), admin_url( 'post-new.php' ) ); ?></h4>

					<?php elseif ( is_search() ) : ?>

					<h4 class="post-subtitle"><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyfourteen' ); ?></h4>
					<?php else : ?>

					<h4 class="post-subtitle"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentyfourteen' ); ?></h4>
					<?php endif; ?>
					<?php get_search_form(); ?>
				</article>
