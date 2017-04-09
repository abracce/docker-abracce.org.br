<?php
/**
 * Custom post type
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$kr_banners = new KR_Custom_Posts(
	'banners',
	'Banner',
	'Banners',
	array( 'title', 'thumbnail' ),
	'images-alt',
	'',
	true
);
