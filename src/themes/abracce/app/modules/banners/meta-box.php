<?php
/**
 * Custom meta box
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$banners_metabox = new Odin_Metabox(
	'banners_metabox',
	'Opções do Banner',
	'banners',
	'normal',
	'high'
);

$banners_metabox->set_fields(
	array(
		array(
			'id'    => 'banner_texto',
			'label' => 'Texto do banner',
			'type'  => 'textarea'
		),
		// array(
		// 	'id'    => 'banner_link',
		// 	'label' => 'Link do banner',
		// 	'type'  => 'text'
		// ),
		// array(
		// 	'id'            => 'banner_target',
		// 	'label'         => 'Abrir link em:',
		// 	'type'          => 'select',
		// 	'default'       => '_self',
		// 	'description'   => '',
		// 	'options'       => array(
		// 		'_self'  => 'Na mesma Janela',
		// 		'_blank' => 'Em uma nova Janela/Aba'
		// 	),
		// )
	)
);
