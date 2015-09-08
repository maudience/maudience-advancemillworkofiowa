		<?php if ($footer_columns = carbon_get_theme_option('crb_footer_columns', 'complex')): ?>
			<footer class="footer">
				<div class="shell">
					<div class="cols">
						<?php foreach ($footer_columns as $c): ?>
							<?php 
							if (!$c['text']) {
								continue;
							}
							?>
							<div class="col col-1of3">
								<?php echo  apply_filters('the_content', $c['text']); ?>
							</div><!-- /.col col-1of3 -->
						<?php endforeach ?>
					</div><!-- /.cols -->
				</div><!-- /.shell -->
			</footer><!-- /.footer -->
		<?php endif ?>

	</div><!-- /.wrapper -->
	<?php wp_footer(); ?>
</body>
</html>