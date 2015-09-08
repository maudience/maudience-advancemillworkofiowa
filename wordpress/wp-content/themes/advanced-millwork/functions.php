<?php
define('CRB_THEME_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);

# Enqueue JS and CSS assets on the front-end
add_action('wp_enqueue_scripts', 'crb_wp_enqueue_scripts');
function crb_wp_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue jQuery
	wp_enqueue_script('jquery');

	# Enqueue Custom JS files
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	crb_enqueue_script('crb-isotope', $template_dir . '/js/jquery.isotope.js');
	crb_enqueue_script('crb-caroufredsel', $template_dir . '/js/jquery.carouFredSel-6.2.1-packed.js');
	crb_enqueue_script('crb-touchswipe', $template_dir . '/js/jquery.touchSwipe.min.js');
	crb_enqueue_script('crb-infieldlabels', $template_dir . '/js/jquery.infieldlabel.js');
	crb_enqueue_script('crb-magnific-popup-js', $template_dir . '/js/jquery.magnific-popup.js');
	crb_enqueue_script('theme-functions', $template_dir . '/js/functions.js');

	# Enqueue Custom CSS files
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	crb_enqueue_style('crb-droid-serif', '//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic');
	crb_enqueue_style('crb-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
	crb_enqueue_style('crb-magnific-popup', $template_dir . '/css/magnific-popup.css');
	crb_enqueue_style('crb-theme-styles', $template_dir . '/style.css');


	# Enqueue Comments JS file
	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}
}

# Enqueue JS and CSS assets on admin pages
add_action('admin_enqueue_scripts', 'crb_admin_enqueue_scripts');
function crb_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	# Enqueue Scripts
	# @crb_enqueue_script attributes -- id, location, dependencies, in_footer = false
	# crb_enqueue_script('theme-admin-functions', $template_dir . '/js/admin-functions.js', array('jquery'));
	
	# Enqueue Styles
	# @crb_enqueue_style attributes -- id, location, dependencies, media = all
	# crb_enqueue_style('theme-admin-styles', $template_dir . '/css/admin-style.css');
}

# Attach Custom Post Types and Custom Taxonomies
add_action('init', 'crb_attach_post_types_and_taxonomies', 0);
function crb_attach_post_types_and_taxonomies() {
	# Attach Custom Post Types
	include_once(CRB_THEME_DIR . 'options/post-types.php');

	# Attach Custom Taxonomies
	include_once(CRB_THEME_DIR . 'options/taxonomies.php');
}

add_action('after_setup_theme', 'crb_setup_theme');

# To override theme setup process in a child theme, add your own crb_setup_theme() to your child theme's
# functions.php file.
if (!function_exists('crb_setup_theme')) {
	function crb_setup_theme() {
		# Make this theme available for translation.
		load_theme_textdomain( 'crb', get_template_directory() . '/languages' );

		# Common libraries
		include_once(CRB_THEME_DIR . 'lib/common.php');
		include_once(CRB_THEME_DIR . 'lib/carbon-fields/carbon-fields.php');
		include_once(CRB_THEME_DIR . 'lib/admin-column-manager/carbon-admin-columns-manager.php');

		# Additional libraries and includes
		include_once(CRB_THEME_DIR . 'includes/comments.php');
		include_once(CRB_THEME_DIR . 'includes/title.php');
		include_once(CRB_THEME_DIR . 'includes/gravity-forms.php');
		
		# Theme supports
		add_theme_support('automatic-feed-links');
		add_theme_support('menus');
		add_theme_support('post-thumbnails');

		# Image Sizes
		add_image_size( 'slider', 744, 500, true );
		add_image_size( 'video-thumb', 213, 143, true );
		add_image_size( 'logo', '', 66, true );
		add_image_size( 'post-thumb', 146, 146, true );
		add_image_size( 'gallery-thumb', 308, 205, true );

		# Manually select Post Formats to be supported - http://codex.wordpress.org/Post_Formats
		// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

		# Register Theme Menu Locations
		
		register_nav_menus(array(
			'main-menu'=>__('Main Menu', 'crb'),
		));
		
		
		# Attach custom widgets
		include_once(CRB_THEME_DIR . 'options/widgets.php');

		# Attach custom shortcodes
		include_once(CRB_THEME_DIR . 'options/shortcodes.php');

		# Attach custom columns
		include_once(CRB_THEME_DIR . 'options/admin-columns.php');

		#Attach Walkers
		include_once(CRB_THEME_DIR . 'includes/walkers.php');
		
		# Add Actions
		add_action('widgets_init', 'crb_widgets_init');

		add_action('carbon_register_fields', 'crb_attach_theme_options');
		add_action('carbon_after_register_fields', 'crb_attach_theme_help');

		# Add Filters
	}
}

# Register Sidebars
# Note: In a child theme with custom crb_setup_theme() this function is not hooked to widgets_init
function crb_widgets_init() {
	$sidebar_options = array_merge(crb_get_default_sidebar_options(), array(
		'name' => 'Default Sidebar',
		'id'   => 'default-sidebar',
	));
	
	register_sidebar($sidebar_options);
}

# Sidebar Options
function crb_get_default_sidebar_options() {
	return array(
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widgettitle">',
		'after_title'   => '</h6>',
	);
}

function crb_attach_theme_options() {
	# Attach fields
	include_once(CRB_THEME_DIR . 'options/theme-options.php');
	include_once(CRB_THEME_DIR . 'options/custom-fields.php');
}

function crb_attach_theme_help() {
	# Theme Help needs to be after options/theme-options.php
	include_once(CRB_THEME_DIR . 'lib/theme-help/theme-readme.php');
}

add_filter('excerpt_more', 'crb_new_excerpt_more');
function crb_new_excerpt_more(  ) {
	return '<div class="post-actions"><a href="' . get_the_permalink() .'">' . __('Learn More', 'crb') . '</a></div>';
}


function crb_get_all_gallery_cats($select = null){
	global $wpdb;
	if (!isset($select)) {
		$select  = '*';
	}else {
		$select = implode(', ', $select);
	}
	$termquery= $wpdb->get_results
		("
		SELECT $select FROM $wpdb->terms
		LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id 
		LEFT JOIN $wpdb->term_relationships ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_id
		LEFT JOIN $wpdb->posts ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
		WHERE $wpdb->posts.post_type = 'crb_gallery'
		AND $wpdb->term_taxonomy.taxonomy = 'category'
		GROUP BY $wpdb->terms.term_id
		ORDER BY name ASC
		");
	return ($termquery);
}