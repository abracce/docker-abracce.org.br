<?php
/**
 * Custom meta box
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

global $gallery_post_types;

if( count($gallery_post_types) > 0 ) :

	foreach ($gallery_post_types as $post_type) {

		$kr_gallery_metabox = new Odin_Metabox(
			'kr_gallery',
			'Galeria de imagens',
			$post_type,
			'normal',
			'high'
		);

		$kr_gallery_metabox->set_fields(
			array(
				array(
					'id'    => 'kr_gallery',
					'label' => 'Imagens',
					'type'  => 'image_plupload'
				)
			)
		);

	}

endif;