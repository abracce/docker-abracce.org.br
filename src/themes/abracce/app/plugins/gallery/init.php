<?php
/**
 * The init module
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

define('KR_GALLERY_PATH', dirname(__FILE__));
define('KR_GALLERY_URL', PLUGINS_URL . '/gallery');

// assets lightbox
function kr_gallery_enqueue_scripts() {
	wp_enqueue_script( 'gallery-lightbox', KR_GALLERY_URL . '/assets/js/gallery.min.js', array( 'jquery' ), null, true );
	wp_enqueue_style( 'gallery-lightbox', KR_GALLERY_URL . '/assets/css/gallery.css', array(), null, 'all' );
}
add_action( 'wp_enqueue_scripts', 'kr_gallery_enqueue_scripts', 1 );

// gallery array post types
$gallery_post_types = array(
	'post',
	'page',
);

// include module functions
include_once( KR_GALLERY_PATH . '/functions.php' );

// include custom post type
include_once( KR_GALLERY_PATH . '/custom-post.php' );

// include custom meta box
include_once( KR_GALLERY_PATH . '/meta-box.php' );

// include custom shortcodes
include_once( KR_GALLERY_PATH . '/shortcodes.php' );
