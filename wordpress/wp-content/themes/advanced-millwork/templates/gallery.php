<?php 
/*
Template Name: Gallery Page
*/

?>
<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php 
			get_template_part('fragments/title-section' );
			$categories = crb_get_all_gallery_cats(array('name', 'slug'));
			$categories_slugs = crb_get_all_gallery_cats(array('slug'));
			$gallery_items = new WP_Query(array(
				'post_type' => 'crb_gallery',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'meta_key' => '_thumbnail_id',
				'tax_query' => array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => $categories_slugs,
                        ),
			));
			?>

			<?php if ($gallery_items->have_posts() && $categories): ?>
				

				<section class="section section-gallery">
					<div class="shell">

						<div class="portfolioFilter">
							<?php foreach ($categories as $c): ?>
								<a href="#" data-filter=".<?php echo esc_attr($c->slug);  ?>"><?php echo $c->name ?></a>
							<?php endforeach ?>
							<a href="#" data-filter="*" class="current"><?php _e('All Categories', 'crb') ?></a>
						</div>

						<div class="portfolioContainer">
							<?php while ($gallery_items->have_posts()): $gallery_items->the_post(); ?>
								<?php 
								$post_terms = wp_get_post_terms( get_the_ID(), 'category');
								$post_categories = '';
								foreach ($post_terms as $t) {
									$post_categories .= $t->slug . ' ';
								}

								$link = carbon_get_the_post_meta('crb_gallery_video_link');
								$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );

								if ($link) {
									$gallery_type = 'gallery-video';
									$class = 'popup-youtube';

								} else {

									$gallery_type = 'gallery-image';
									$thumbnail_src = wp_get_attachment_image_src($post_thumbnail_id, 'full');
									$link = $thumbnail_src[0];
									$class = '';
								}
								?>
								<div class="<?php echo esc_attr($post_categories) . $gallery_type; ?>">
									<a class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url($link); ?>">
										<?php the_post_thumbnail('gallery-thumb'); ?>
									</a>
								</div>
							<?php endwhile ?>
						</div>	                                        
					</div><!-- /.shell -->
				</section><!-- /.section section-gallery -->
			<?php endif ?>
			<?php wp_reset_postdata(); ?>

		<?php endwhile; ?>
	<?php endif; ?>
	
<?php get_footer(); ?>