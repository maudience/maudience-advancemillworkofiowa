<?php get_header(); ?>
	<?php get_template_part('fragments/title-section' ); ?>
	<main class="main">
		<div class="shell">
			<div class="main-body main-post">
				<?php 
				if ( is_single() || is_page() || is_404() ) {
					get_template_part( 'loop', 'single' );
				}else {
					get_template_part( 'loop' ); 
				}
				get_sidebar(); 
				?>
			</div><!-- /.main-body -->
		</div><!-- /.shell -->
	</main><!-- /.main -->
<?php get_footer(); ?>