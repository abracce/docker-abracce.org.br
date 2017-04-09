<?php
/**
 * The module functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */


function kr_get_featured_banners($post_ID) {
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = odin_thumbnail( 500, 100, get_the_title(), true, '');
		return $post_thumbnail_img;
	}
}

// ADD NEW COLUMN
function kr_columns_head_banners($defaults) {
	$defaults['banner'] = 'Banner';
	unset($defaults['date']);
	unset($defaults['tags']);
	unset($defaults['categories']);
	unset($defaults['author']);
	// unset($defaults['title']);

	return $defaults;
}

// SHOW THE FEATURED IMAGE
function kr_columns_content_banners($column_name, $post_ID) {

	switch ($column_name) {

		case 'banner':
			$post_featured_image = kr_get_featured_banners($post_ID);
			if ($post_featured_image) {
				echo '<a title="Clique para Editar" href="'.get_edit_post_link( $post_ID ).'">'.$post_featured_image.'</a>';
			}
		break;

		default:
		break;

	}

}
add_filter('manage_banners_posts_columns', 'kr_columns_head_banners');
add_action('manage_banners_posts_custom_column', 'kr_columns_content_banners', 10, 2);
