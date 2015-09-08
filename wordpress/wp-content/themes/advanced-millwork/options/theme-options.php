<?php

Carbon_Container::factory('theme_options', __('Theme Options', 'crb'))
	->add_fields(array(
		Carbon_Field::factory('separator', 'crb_header_sep', __('Header Options', 'crb') ),
		Carbon_Field::factory('text', 'crb_header_mobile_button', __('Mobile Menu Return Button', 'crb') )
			->set_default_value('return')
			->help_text('Text for the sub menu items return link. Defaults to: "return"'),
		Carbon_Field::factory('complex', 'crb_header_contacts', __('Header Contacts', 'crb') )
			->add_fields(array(
				Carbon_Field::factory('select', 'contact_type', __('Contact Type', 'crb') )
					->add_options(array(
						'' => 'Link',
						'callto:' => 'Phone',
						'mailto:' => 'Email'
					)),
				Carbon_Field::factory('text', 'contact_link', __('Contact', 'crb') )
					->set_required(true),
				Carbon_Field::factory('text', 'contact_text', __('Contact Button Text', 'crb') )
					->set_required(true),
			)),

		Carbon_Field::factory('separator', 'crb_footer_sep', __('Footer Options', 'crb') ),
		Carbon_Field::factory('complex', 'crb_footer_columns', __('Footer Columns', 'crb') )
			->add_fields(array(
				Carbon_Field::factory('rich_text', 'text', __('Text', 'crb') )
					->set_required(true),
			))->set_max(3),
		Carbon_Field::factory('separator', 'crb_misc_sep', __('Misc Options', 'crb') ),
		Carbon_Field::factory('header_scripts', 'crb_header_script', __('Header Script', 'crb')),
		Carbon_Field::factory('footer_scripts', 'crb_footer_script', __('Footer Script', 'crb')),
	));

if ( carbon_twitter_widget_registered() ) {
	Carbon_Container::factory('theme_options', 'Twitter Settings')
		->set_page_parent('Theme Options')
		->add_fields(array(
			Carbon_Field::factory('html', 'crb_twitter_settings_html')
				->set_html('
					<div style="position: relative; background: #fff; border: 1px solid #ccc; padding: 10px;">
						<h4><strong>' . __('Twitter API requires a Twitter application for communication with 3rd party sites. Here are the steps for creating and setting up a Twitter application:', 'crb') . '</strong></h4>
						<ol>
							<li>' . sprintf(__('Go to <a href="%1$s" target="_blank">%1$s</a> and log in, if necessary', 'crb'), 'https://dev.twitter.com/apps/new') . '</li>
							<li>' . __('Supply the necessary required fields, accept the Terms of Service, and solve the CAPTCHA. Callback URL field may be left empty', 'crb') . '</li>
							<li>' . __('Submit the form', 'crb') . '</li>
							<li>' . __('On the next screen scroll down to <strong>Your access token</strong> section and click the <strong>Create my access token</strong> button', 'crb') . '</li>
							<li>' . __('Copy the following fields: Access token, Access token secret, Consumer key, Consumer secret to the below fields', 'crb') . '</li>
						</ol>
					</div>
				'),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token', __('Access Token', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_oauth_access_token_secret', __('Access Token Secret', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_consumer_key', __('Consumer Key', 'crb'))
				->set_default_value(''),
			Carbon_Field::factory('text', 'crb_twitter_consumer_secret', __('Consumer Secret', 'crb'))
				->set_default_value(''),
		));
}