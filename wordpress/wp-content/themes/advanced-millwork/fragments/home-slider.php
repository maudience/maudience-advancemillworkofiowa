<?php 
if (!$slides_count = carbon_get_the_post_meta('crb_slides_count')) {
	$slides_count = -1;
};

$slides = new WP_Query(array(
	'post_type' => 'crb_home_slider',
	'posts_per_page' => $slides_count,
	'orderby' => 'menu_order',
	'order' => 'ASC'
));
?>

<?php if ($slides->have_posts()): ?>
	
	<section class="slider">
		<div class="slider-clip">
			<ul class="slides">
				<?php while ($slides->have_posts()): $slides->the_post(); ?>
					<?php 
					if (!$slider = carbon_get_the_post_meta('crb_home_slider', 'complex')) {
					 	continue;
					} 
					?>
					
					<?php foreach ($slider as $s): ?>
						<?php 
						if (!$s['image']) {
							continue;
						}
						?>
						<li class="slide">
							<div class="slide-image">
								<?php echo wp_get_attachment_image( $s['image'], 'slide'); ?>
							</div>

							<?php if ($s['_type'] === '_image_slide'): ?>
								
								<?php if ( $s['text'] || ($s['button_text'] && $s['button_link'])): ?>
									<div class="slide-content">
										<div class="entry alignnone">
											
											<h3><?php the_title(); ?></h3>
											
											
											<?php if ($s['text']): ?>
												<p><?php echo nl2br(esc_html($s['text'])) ?></p>
											<?php endif ?>

											<?php if ($s['button_text'] && $s['button_link']): ?>
												<div class="slide-actions">
													<a href="<?php echo esc_url($s['button_link']); ?>"><?php echo esc_html($s['button_text']); ?></a>
												</div>
											<?php endif ?>
										</div>
									</div>
								<?php endif ?>

							<?php elseif($s['_type'] === '_video_slide'): ?>

								<?php 
								if (!( $video = Carbon_Video::create($s['link']) )) {
									continue;
								}
								?>

								<?php if ( $s['text']): ?>
									<div class="slide-content slide-content-alt">
										<div class="entry alignleft alt">
											
											<h3><?php the_title(); ?></h3>
											

											<?php if ($s['text']): ?>
												<p><?php echo nl2br(esc_html($s['text']));?></p>
											<?php endif ?>

											<a href="#" class="video-btn-alt">
												<?php echo ($s['video_button_mobile'] ? $s['video_button_mobile'] : 'View Video'); ?>
											</a>
										</div><!-- /.entry -->

										<div class="slide-video alignright">
											<a href="#" class="video-btn alt">
												<?php 
												if ($s['video_thumbnail']) {
													echo wp_get_attachment_image( $s['video_thumbnail'], 'video-thumb');
												}
												?>
											</a>
										</div>
									</div>
								<?php endif ?>
								
								<?php echo $video->get_embed_code(744, 500); ?>
							<?php endif ?>
						
						</li>
					<?php endforeach ?>
				<?php endwhile ?>
			</ul>
		</div>

		<div class="slider-actions">
			<a href="#" class="slider-prev">Previous Slide</a>
			
			<a href="#" class="slider-next">Next Slide</a>
		</div>
		
		<div class="slider-paging"></div>
	</section><!-- /.slider -->
<?php endif ?>
<?php wp_reset_postdata(); ?>