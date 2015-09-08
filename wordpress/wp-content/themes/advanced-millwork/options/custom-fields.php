<?php

Carbon_Container::factory('custom_fields', __('Home Settings', 'crb'))
	->show_on_post_type('page')
	->show_on_template('templates/home.php')
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_slides_count', __('Slides Count', 'crb') )
			->help_text('Number of slides to show. If left empty all slides from Home Slider (CPT) will be shown.'),
		Carbon_Field::factory('separator', 'crb_sep_sections', __('Sections Settings', 'crb') ),
		Carbon_Field::factory('complex', 'crb_home_sections', __('Home Sections', 'crb') )
			->add_fields('intro',array(
				Carbon_Field::factory('text', 'title', __('Title', 'crb') )
					->set_required(true),
				Carbon_Field::factory('text', 'button_text', __('Button Text', 'crb') ),
				Carbon_Field::factory('text', 'button_link', __('Button Link', 'crb') ),
			))
			->add_fields('logos',array(
				Carbon_Field::factory('complex', 'logos', __('Logos', 'crb') )
					->add_fields(array(
						Carbon_Field::factory('attachment', 'logo', __('Logo', 'crb') )
							->set_required(true),
						Carbon_Field::factory('text', 'link', __('Link', 'crb') ),
					)),
				Carbon_Field::factory('text', 'button_text', __('Button Text', 'crb') ),
				Carbon_Field::factory('text', 'button_link', __('Button Link', 'crb') ),
			)),
		Carbon_Field::factory('separator', 'crb_sep_contact_section', __('Contact Section', 'crb') ),
		Carbon_Field::factory('text', 'crb_contact_section_title', __('Contact Section Title', 'crb') ),
		Carbon_Field::factory('gravity_form', 'crb_select_form', __('Select Form', 'crb') ),
	));

Carbon_Container::factory('custom_fields', __('Slider Settings', 'crb'))
	->show_on_post_type('crb_home_slider')
	->add_fields(array(
		Carbon_Field::factory('separator', 'crb_home_slide_sep', __('Slider', 'crb') )
			->help_text('Image or Video/Image slides are available.'),
		Carbon_Field::factory('complex', 'crb_home_slider', __('', 'crb') )
			->add_fields('image_slide', array(
				Carbon_Field::factory('attachment', 'image', __('Image', 'crb') )
					->set_required(true),
				Carbon_Field::factory('textarea', 'text', __('Text', 'crb') ),
				Carbon_Field::factory('text', 'button_text', __('Button text', 'crb') ),
				Carbon_Field::factory('text', 'button_link', __('Button link', 'crb') ),
			))->set_max(1)
			->add_fields('video_slide', array(
				Carbon_Field::factory('attachment', 'image', __('Image', 'crb') ),
				Carbon_Field::factory('text', 'link', __('Video Link', 'crb') )
					->help_text('Youtube and Vimeo links are allowed'),
				Carbon_Field::factory('attachment', 'video_thumbnail', __('Video Thumbnail', 'crb') ),
				Carbon_Field::factory('textarea', 'text', __('Text', 'crb') ),
				Carbon_Field::factory('text', 'video_button_mobile', __('Video Button Text', 'crb') )
					->set_default_value('View Video')
					->help_text('Button will be displayed only on mobile.'),
			))->set_max(1)
	));

Carbon_Container::factory('custom_fields', __('Gallery Settings', 'crb'))
	->show_on_post_type('crb_gallery')
	->add_fields(array(
		Carbon_Field::factory('text', 'crb_gallery_video_link', __('Video Link', 'crb') )
			->help_text('If left empty the Featured Image will be displayed on Gallery Page as a popup.'),
	));