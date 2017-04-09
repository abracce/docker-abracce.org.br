<?php
/**
 * Others functions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 2.1.0
 */

/**
 * The body ID
 */
function theme_body_id() {
	global $post;

	if (is_home()) {
		echo 'id="home"';
	}
	elseif (is_single()) {
		echo 'id="single"';
	}
	elseif (is_page()) {
		$post = get_post($post->ID);
		if(!empty($post->post_name)) {
			echo 'id="page-'.$post->post_name.'"';
		}
		else {
			echo 'id="page"';
		}
	}
	elseif (is_search()) {
		echo 'id="search"';
	}
	elseif (is_archive()) {
		echo 'id="archive"';
	}
	elseif (is_404()) {
		echo 'id="error404"';
	}

}

/**
 * get the page id by slug
 */
function get_ID_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	}
	else {
		return null;
	}
}

/**
 * get option theme
 *
 * @param string  $opt_id
 * @param boolean $editor
 *
 * @return string $get_opts
 */
function kr_option_theme($opt_id = '') {
	if(empty($opt_id)) return false;

	$theme_opts = get_option( THEME_FX );
	if(isset($theme_opts[THEME_FX.'_'.$opt_id]) && !empty($theme_opts[THEME_FX.'_'.$opt_id])) {
		$get_opts = $theme_opts[THEME_FX.'_'.$opt_id];
		return $get_opts;
	}
	else {
		return false;
	}
}


/**
 * Get WX conteudo
 *
 * @param string  $page
 * @param boolean $editor
 *
 * @return string
 */
function kr_conteudo( $page = null, $editor = false ) {

	if(empty($page))
		return false;

	if($editor) {
		$conteudo = wpautop( do_shortcode( kr_option_theme($page) ) );
	}
	else {
		$conteudo = kr_option_theme($page);
	}

	if(!$conteudo)
		return false;

	echo $conteudo;
}


function kr_url( $slug = null ) {

	if($slug) {
		$page_id = get_ID_by_slug( $slug );

		if($page_id) {
			echo get_permalink( $page_id );
		}
		else {
			echo home_url() . '/' . $slug;
		}

	}
	else {
		echo home_url();
	}

}



function kr_content( $limit = false )
{

	if( $limit ) {
		echo odin_excerpt( 'excerpt', $limit );
	}
	else {
		the_content();
	}

}


function kr_dev_copyright() {
	global $dev_copy;

	echo "<!--\n";
	echo "|\n";
	echo "| Desenvolvido por " . $dev_copy['name'] . " <". $dev_copy['email'] .">\n";
	echo "| Fone: " . $dev_copy['fone'] . " - " . $dev_copy['url'] . "\n";
	echo "|\n";
	echo "-->\n";
}

function kr_thumb( $width = 150, $height = 150, $class = 'img-hover', $imgfull = false, $crop = true, $return = false )
{
	if ( ! class_exists( 'Odin_Thumbnail_Resizer' ) ) {
		return;
	}

	$thumb_id = get_post_thumbnail_id();

	$resizer = Odin_Thumbnail_Resizer::get_instance();
	$url     = wp_get_attachment_url( $thumb_id, 'full' );
	$image   = $resizer->process( $url, $width, $height, $crop );

	if($imgfull) {
		$thumb = '<img class="' . $class . '" src="' . $url . '" />';
	}
	else {
		$thumb = '<img class="' . $class . '" src="' . $image . '" />';
	}

	if(!$url) {
		// $image = THEME_URL . '/assets/images/defaults/default-' . $width . 'x' . $height . '.jpg';
		$image = 'http://dummyimage.com/' . $width . 'x' . $height . '/f3f2f4/F7AF46.gif&text=++sem+foto++';
		$thumb = '<img class="thumb-default ' . $class . '" src="' . $image . '" />';
	}

	if($return)
	{
		if($imgfull)
		{
			return $url;
		}
		else {
			return $image;
		}
	}
	else
	{
		echo $thumb;
	}

}


/**
* get post meta
**/
function kr_get_post_meta( $metaID )
{
	global $post;

	if( empty($metaID) )
		return false;

	$post_meta = get_post_meta( $post->ID, $metaID, true );

	if(!empty($post_meta))
	{
		return $post_meta;
	}
	else
	{
		return false;
	}

}


function clear_admin_bar( $admin_bar ) {

	$admin_bar->remove_node( 'new-post' );
	$admin_bar->remove_node( 'new-link' );
	$admin_bar->remove_node( 'new-media' );
	$admin_bar->remove_menu( 'wp-logo' );
	$admin_bar->remove_node( 'new-content' );
	$admin_bar->remove_menu( 'edit' );
	$admin_bar->remove_menu( 'updates' );
	$admin_bar->remove_menu( 'search' );
	$admin_bar->remove_menu( 'comments' );
	$admin_bar->remove_menu( 'view-site' );

	return $admin_bar;
}
add_action( 'admin_bar_menu', 'clear_admin_bar', 99 );


function kr_right_now_content_table_end() {
	$args = array(
		'public'   => true ,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	foreach( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$cpt_name = $post_type->name;
		}
		echo '<li class="post-count"><tr><a href="edit.php?post_type='.$cpt_name.'"><td class="first b b-' . $post_type->name . '"></td>' . $num . '&nbsp;<td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
	}
	$taxonomies = get_taxonomies( $args , $output , $operator );
	foreach( $taxonomies as $taxonomy ) {
		$num_terms  = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->name, $taxonomy->labels->name , intval( $num_terms ));
		if ( current_user_can( 'manage_categories' ) ) {
			$cpt_tax = $taxonomy->name;
		}
		echo '<li class="post-count"><tr><a href="edit-tags.php?taxonomy='.$cpt_tax.'"><td class="first b b-' . $taxonomy->name . '"></td>' . $num . '&nbsp;<td class="t ' . $taxonomy->name . '">' . $text . '</td></a></tr></li>';
	}
}

add_action( 'dashboard_glance_items' , 'kr_right_now_content_table_end' );
