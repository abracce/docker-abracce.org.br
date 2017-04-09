<?php
/**
 * Custom meta box
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$contact_metabox = new Odin_Metabox(
	'contact_metabox',
	'Contato',
	'contact',
	'normal',
	'high'
);

global $fields_meta;
$contact_metabox->set_fields($fields_meta);
