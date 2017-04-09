<?php
/**
 * Custom post type
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$kr_parceiros = new KR_Custom_Posts(
	'partners',
	'Parceiro',
	'Parceiros',
	array( 'title', 'thumbnail' ),
	'groups',
	'',
	true
);
