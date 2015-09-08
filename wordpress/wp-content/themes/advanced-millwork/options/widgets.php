<?php
/**
 * Register the new widget classes here so that they show up in the widget list. 
 */
function crb_register_widgets() {
	register_widget('ThemeWidgetRichText');
	register_widget('ThemeWidgetTextWithButton');
	// register_widget('CrbLatestTweetsWidget');
	// register_widget('ThemeWidgetExample');
}
add_action('widgets_init', 'crb_register_widgets');

/**
 * Displays a block with a title and WYSIWYG rich text content
 */
class ThemeWidgetRichText extends Carbon_Widget {
	function __construct() {
		$this->setup(__('Rich Text', 'crb'), __('Displays a block with title and WYSIWYG content.', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('rich_text', 'content', __('Content', 'crb'))
		));
	}
	
	function front_end($args, $instance) {
		if ($instance['title'] != '') {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		
		echo apply_filters('the_content', $instance['content']);
	}
}

/**
 * Displays a block with latest tweets from particular user
 */
class CrbLatestTweetsWidget extends Carbon_Widget {
	protected $form_options = array(
		'width' => 300
	);

	function __construct() {
		$this->setup(__('Latest Tweets', 'crb'), __('Displays a block with your latest tweets', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('text', 'username', __('Username', 'crb')),
			Carbon_Field::factory('text', 'count', __('Number of Tweets to show', 'crb'))->set_default_value('5')
		));
	}

	function front_end($args, $instance) {
		if ( !carbon_twitter_is_configured() ) {
			return; //twitter settings are not configured
		}

		$tweets = TwitterHelper::get_tweets($instance['username'], $instance['count']);
		if (empty($tweets)) {
			return; //no tweets, or error while retrieving
		}

		if ($instance['title']) {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		?>
		<ul>
			<?php foreach ($tweets as $tweet): ?>
				<li><?php echo $tweet->tweet_text; ?> - <span><?php printf(__('%1$s ago', 'crb'), $tweet->time_distance); ?></span></li>
			<?php endforeach ?>
		</ul>
		<?php
	}
}


class ThemeWidgetTextWithButton extends Carbon_Widget {
	/**
	 * Register widget function.
	 */
	function __construct() {
		$this->setup(__('Theme Widget - Text & Button', 'crb'), __('Displays a block with title/text and button', 'crb'), array(
			Carbon_Field::factory('text', 'title', __('Title', 'crb')),
			Carbon_Field::factory('rich_text', 'text', __('Text', 'crb')),
			Carbon_Field::factory('text', 'button_text', __('Button Text', 'crb') ),
			Carbon_Field::factory('text', 'button_link', __('Button Link', 'crb') )
		), 'widget_consultation');
	}
	
	/**
	 * Called when rendering the widget in the front-end
	 */
	function front_end($args, $instance) {
		if ($instance['title'] != '') {
			echo $args['before_title'] . $instance['title'] . $args['after_title'];
		}
		if ($instance['text']) {
			echo apply_filters( 'content', $instance['text'] );
		}

		if ($instance['button_text'] && $instance['button_link']) {
			?>
			<div class="widger_actions">
				<a href="<?php echo esc_url($instance['button_link']); ?>" class="button"><?php echo esc_html($instance['button_text']); ?></a>
			</div><!-- /.widger_actions -->
			<?php
		}
	}
}