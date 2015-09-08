<?php 
$sections = carbon_get_the_post_meta('crb_home_sections', 'complex');
if (!$sections) {
	return;
}
?>

<?php foreach ($sections as $s): ?>
	<?php if ($s['_type'] === '_intro' && $s['title']): ?>

		<section class="section section-intro">
			<div class="shell">
				<h2><?php echo esc_html($s['title']); ?></h2>

				<?php if ($s['button_text'] && $s['button_link']): ?>
					<div class="section-actions">
						<a href="<?php echo esc_url($s['button_link']); ?>"><?php echo esc_html($s['button_text']); ?></a>
					</div><!-- /.section-actions -->
				<?php endif ?>
			</div><!-- /.shell -->
		</section><!-- /.section section-intro -->

	<?php elseif($s['_type'] === '_logos' && $s['logos']): ?>

		<section class="section section-brands">
			<div class="shell">
				<ul class="brands">
					<?php foreach ($s['logos'] as $l): ?>
						<?php 
						if (!$l['logo']){
							continue;
						}
						?>	
						<li class="brand">
							<?php if ($l['link']): ?>
								<a href="<?php echo esc_url($l['link']); ?>">
									<?php echo wp_get_attachment_image( $l['logo'], 'logo' ); ?>
								</a>
							<?php else: ?>
								<?php echo wp_get_attachment_image( $l['logo'], 'logo' ); ?>
							<?php endif ?>
						</li>
					<?php endforeach ?>
				</ul>

				<?php if ($s['button_text'] && $s['button_link']): ?>
					<div class="section-actions">
						<a href="<?php echo esc_url($s['button_link']); ?>"><?php echo esc_html($s['button_text']); ?></a>
					</div><!-- /.section-actions -->
				<?php endif ?>
			</div><!-- /.shell -->
		</section><!-- /.section section-brands -->

	<?php endif ?>
<?php endforeach ?>
