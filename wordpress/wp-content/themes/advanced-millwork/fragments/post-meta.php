<?php
/**
 * Displays the post date/time, author, tags, categories and comments link.
 * 
 * Should be called only within The Loop.
 * 
 * It will be displayed only for post type "post".
 */

if (empty($post) || get_post_type() != 'post') {
	return;
}
?>
<div class="post-meta">
	<p class="post-date">
		<strong><?php the_time( 'M d' ); ?></strong>

		<span><?php the_time('Y'); ?></span>
	</p><!-- /.post-date -->
	

	<p class="post-categories">
		<?php _e('Categories: ', 'crb'); the_category(', '); ?>

	</p><!-- /.post-categories -->
	
</div><!-- /.post-meta -->