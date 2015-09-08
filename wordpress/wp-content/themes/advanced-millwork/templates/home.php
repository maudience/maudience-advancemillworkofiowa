<?php 
/*
Template Name: Home Page
*/

?>
<?php get_header(); ?>

	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			
			<?php 
			get_template_part('fragments/home-slider' ); 
			get_template_part('fragments/home-sections' ); 
			?>
			<div class="main">
				<div class="shell">
					<div class="main-body">
						<div class="content about">
							<div class="entry">
								<?php the_content(); ?>
							</div><!-- /.entry -->
						</div><!-- /.content -->

						<?php 
						$contact_section_title = carbon_get_the_post_meta('crb_contact_section_title');
						$contact_form_id = carbon_get_the_post_meta('crb_select_form');
						?>

						<?php if (function_exists('gravity_form') && $contact_form_id): ?>
							
							<div class="section-search about">
								<?php if ($contact_section_title): ?>
									<h3><?php echo esc_html($contact_section_title); ?></h3>
								<?php endif ?>

								<?php 
								crb_render_gform($contact_form_id, true, 12);
								?>
							</div><!-- /.section-search -->
						<?php endif ?>

					</div><!-- /.main-body -->
				</div><!-- /.shell -->
			</div><!-- /.main -->

		<?php endwhile; ?>
	<?php endif; ?>
	
<?php get_footer(); ?>