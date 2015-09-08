<?php
class Main_Nav_Walker extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = array() ) {

		if (!$return_text = carbon_get_theme_option('crb_header_mobile_button')) {
			$return_text = __('return', 'crb');
		}
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
		$output .= "\n$indent<li class=\"return-link\"><a href=\"#\">$return_text</a></li>\n";
	}
} // Main_Nav_Walker