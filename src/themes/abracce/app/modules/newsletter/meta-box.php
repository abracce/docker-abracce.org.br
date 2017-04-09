<?php
/**
 * Custom meta box
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$kr_newsletter_metabox = new Odin_Metabox(
	'kr_newsletter_metabox',
	'Cadastrar Assinante',
	'newsletter',
	'normal',
	'high'
);

$kr_newsletter_metabox->set_fields(
	array(
		array(
			'id'    => 'newsletter_name',
			'label' => 'Nome:',
			'type'  => 'text'
		),
		array(
			'id'    => 'newsletter_email',
			'label' => 'E-mail:',
			'type'  => 'text'
		),
	)
);
