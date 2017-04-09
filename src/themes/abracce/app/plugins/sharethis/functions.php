<?php

/* Print sharethis head scripts */
function kr_sharethis_head_scripts() {
	echo '<script type="text/javascript"> var switchTo5x=true; </script>'."\n";
	echo '<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>'."\n";
	echo '<script type="text/javascript">stLight.options({publisher: "0070bcaf-866c-46fc-a27b-9778f320180f", doNotHash: true, doNotCopy: true, hashAddressBar: true});</script>'."\n";
}

add_action('wp_head', 'kr_sharethis_head_scripts');

/**
 * @param $share array
 * @param $count boolean
 * @param $count_type string
 *
 * $share = array(
 *		'email'      => 'E-mail',
 *		'facebook'   => 'Facebook',
 *		'twitter'    => 'Tweet',
 *		'linkedin'   => 'LinkedIn',
 *		'googleplus' => 'Google +',
 *		'pinterest'  => 'Pinterest',
 * );
 */
function kr_sharethis( $share = array(), $count = false, $count_type = 'h' ) {
	global $post;

	if($count) {
		if($count_type == 'v') {
			$cls_count = 'vcount';
			$count = '_vcount ' . $cls_count;
		}
		else {
			$cls_count = 'hcount';
			$count = '_hcount ' . $cls_count;
		}
	}
	else {
		$count = '';
	}

	if(is_array($share) && count($share) > 0) {
		$sharethis = '';

		foreach ($share as $id => $title) {
			$sharethis .= '<span class="st_'. $id . $count .'" st_url="'.get_permalink($post->ID).'" st_title="'.get_the_title($post->ID).'" displayText="'.$title.'" st_via=""></span>';
		}

		if(!empty($sharethis)) {
			echo $sharethis;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}

}
