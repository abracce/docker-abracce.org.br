<?php
/**
 * Custom post type
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$kr_newsletter = new KR_Custom_Posts(
	'newsletter',
	'Assinante',
	'Assinantes',
	array(''),
	'email',
	'',
	true
);
