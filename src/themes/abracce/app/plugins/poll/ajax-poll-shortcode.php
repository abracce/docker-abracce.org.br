<?php
/**
 * KR Ajax Poll Shortcode
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

function kr_ajax_poll_shortcode($atts) {
	extract(
		shortcode_atts(
			array(
				"id" => null
			),
			$atts
		)
	);

	$instance['title']      = '';
	$instance['kr_poll_id'] = $id;

	ob_start();
	the_widget('KR_Ajax_Poll_Widget', $instance);
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
};

add_shortcode("poll", "kr_ajax_poll_shortcode");
