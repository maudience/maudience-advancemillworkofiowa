<div class="content">
	<div class="entry">
		<?php 
		if (have_posts()) {
			while (have_posts()){
				the_post();
				the_content();
			}
		}else {
			printf(__('<p>Please check the URL for proper spelling and capitalization.<br />If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>.</p>', 'crb'), home_url('/'));
		}
		?>
	</div><!-- /.entry -->
</div><!-- /.content -->