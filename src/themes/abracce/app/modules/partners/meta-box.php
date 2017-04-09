<?php
/**
 * Custom meta box
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$parceiros_metabox = new Odin_Metabox(
	'parceiros_metabox',
	'Opções do adicionais',
	'partners',
	'normal',
	'high'
);

$parceiros_metabox->set_fields(
	array(
		array(
			'id'    => 'parceiro_link',
			'label' => 'Website do parceiro',
			'type'  => 'text'
		),
	)
);
