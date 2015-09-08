<!DOCTYPE html>
<html>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div class="wrapper">
	<header class="header">
		<div class="shell">
			<div class="header-inner clearfix">
				<a href="<?php echo home_url('/'); ?>" class="logo"><?php bloginfo('name'); ?></a>

				<div class="header-right">
					<?php if ($header_contacts = carbon_get_theme_option('crb_header_contacts', 'complex')): ?>
						<div class="header-contacts">
							<?php foreach ($header_contacts as $c): ?>
								<?php 
								if (!$c['contact_link'] || !$c['contact_text']) {
									return;
								}
								if ($c['contact_type'] === '' ) {
									$link = esc_url( $c['contact_link']);
								} else {
									$link = $c['contact_link'];
								}
								?>
								<p>
									<a href="<?php echo $c['contact_type'] . $link; ?>">
										<?php echo esc_html($c['contact_text']); ?>
									</a>
								</p>
							<?php endforeach ?>
						</div><!-- /.header-contacts -->
					<?php endif ?>

					<?php 
					$mobile_btn = '<a href="#" class="menu-btn">Menu</a>';
					wp_nav_menu(array(
						'theme_location'  => 'main-menu',
						'container'       => 'nav',
						'container_class' => 'nav clearfix',
						'menu_class'      => 'menu clearfix',
						'fallback_cb'     => false,
						'items_wrap'      => $mobile_btn . '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'walker'          =>  new Main_Nav_Walker
					));
					?>
				</div><!-- /.header-right -->
			</div><!-- /.header-inner clearfix -->
		</div><!-- /.shell -->
	</header><!-- /.header -->