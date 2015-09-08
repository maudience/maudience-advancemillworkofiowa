<div class="content">
	<section class="section section-post">
		<?php if (have_posts()) : ?>
			<ul class="posts">
				<?php while (have_posts()) : the_post(); ?>
				
					<li class="post">
						<div class="post-body">
							<div class="post-content alignleft">
								<h3>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>	

								<?php the_excerpt(); ?>

								
							</div><!-- /.post-content alignleft -->

							<?php if (has_post_thumbnail()): ?>
								<div class="post-image alignright">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
								</div><!-- /.post-image alignright -->
							<?php endif ?>

						</div><!-- /.post-body -->

						<?php get_template_part('fragments/post-meta' ); ?>
					</li><!-- /.post -->

				<?php endwhile; ?>
			</ul><!-- /.posts -->

			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<nav class="pagination">
					<div class="alignleft"><?php next_posts_link(__('Previous Posts', 'crb')); ?></div>
					<div class="alignright"><?php previous_posts_link(__('New Posts', 'crb')); ?></div>
				</nav>
			<?php endif; ?>

		<?php else : ?>

			<ul class="posts">
				<li id="post-0" class="post error404 not-found">
					<div class="post-body">
						<div class="post-content alignleft">
							<?php  
							if ( is_category() ) { // If this is a category archive
								printf("<h3>" . __("Sorry, but there aren't any posts in the %s category yet.", 'crb') . "</h3>", single_cat_title('',false));
							} else if ( is_date() ) { // If this is a date archive
								echo("<h3>" . __("Sorry, but there aren't any posts with this date.", 'crb') . "</h3>");
							} else if ( is_author() ) { // If this is a category archive
								$userdata = get_user_by('id', get_queried_object_id());
								printf("<h3>" . __("Sorry, but there aren't any posts by %s yet.", 'crb') . "</h3>", $userdata->display_name);
							} else if ( is_search() ) {
								echo("<h3>" . __('No posts found. Try a different search?', 'crb') . "</h3>");
							} else {
								echo("<h3>" . __('No posts found.', 'crb') . "</h3>");
							}
							get_search_form(); 
							?>
						</div>
					</div>
				</li>
			</ul>
		<?php endif; ?>
	</section><!-- /.section section-post -->
</div><!-- /.content --><!-- /.main-body -->