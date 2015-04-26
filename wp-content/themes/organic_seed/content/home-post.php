<h4 class="category-title radius-top"><?php echo esc_html( seed_cat_id_to_name(get_theme_mod('category_news') ) ); ?></h4>

<?php $news = new WP_Query(array('cat'=>get_theme_mod('category_news'), 'posts_per_page'=>get_theme_mod('postnumber_news'), 'paged'=>$paged, 'suppress_filters'=>0)); ?>
<?php if ($news->have_posts()) : while($news->have_posts()) : $news->the_post(); ?>

<!-- BEGIN .information -->
<div class="information">
	
<?php if ( has_post_thumbnail() ) { ?>
	
	<!-- BEGIN .four columns -->
	<div class="four columns">

		<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'seed-featured-small' ); ?></a>

	<!-- END .four columns -->
	</div>

	<!-- BEGIN .twelve columns -->
	<div class="twelve columns">
	
		<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="post-author">
			<p class="align-left"><i class="fa fa-clock-o"></i> &nbsp;<?php _e("Posted on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?></p>
			<p class="align-right"><i class="fa fa-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), '% Comments'); ?></a></p>
		</div>
		
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div>
	
	<!-- END .twelve columns -->
	</div>

<?php } else { ?>

	<!-- BEGIN .sixteen columns -->
	<div class="sixteen columns">
			
		<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		
		<div class="post-author">
			<p class="align-left"><i class="fa fa-time"></i> &nbsp;<?php _e("Posted on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?></p>
			<p class="align-right"><i class="fa fa-comment"></i> &nbsp;<a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), '% Comments'); ?></a></p>
		</div>
		
		<div class="excerpt">
			<?php the_excerpt(); ?>
		</div>
	
	<!-- END .sixteen columns -->
	</div>

<?php } ?>

<!-- END .information -->
</div>

<?php endwhile; else : ?>

<!-- BEGIN .information -->
<div class="information">
	<h2 class="title"><?php _e("No Posts Found", 'organicthemes'); ?></h2>
	<p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
<!-- END .information -->
</div>

<?php endif; ?>
<?php wp_reset_postdata(); ?>