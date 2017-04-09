<?php
/**
 * The module functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

function abracce_videos_list() {

	$videos = new Abracce_Videos();
	$videos->get_videos('Abraccepr');

}
