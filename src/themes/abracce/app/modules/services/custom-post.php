<?php
/**
 * Custom post type
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$kr_services = new KR_Custom_Posts(
	'services',
	'Serviço',
	'Serviços',
	array( 'title', 'editor', 'thumbnail' ),
	'feedback',
	'servico',
	true
);
