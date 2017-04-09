<?php
/**
 * Custom post type
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$kr_contacts = new KR_Custom_Posts(
	'contact',
	'Contato',
	'Contato',
	array( 'title' ),
	'email-alt',
	'',
	true
);
