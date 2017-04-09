<?php

// Ocultar admin bar top
add_filter('show_admin_bar', '__return_false');

if ( ! function_exists( 'theme_setup_features' ) ) {

	function theme_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( THEME_FX, THEME_PATH . '/assets/lang' );
		load_theme_textdomain( 'odin', ODIN_PATH . '/lang' );

		/**
		 * register menus
		 */
		register_nav_menus(
			array(
				'main-menu'   => 'Menu principal',
				'footer-menu' => 'Menu rodapé',
				// 'aux-menu'    => 'Menu auxiliar',
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Editor Style.
		 */
		// add_editor_style( 'assets/css/editor-style.css' );


		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		// 	'aside',
		// 	'gallery',
		// 	'link',
		// 	'image',
		// 	'quote',
		// 	'status',
		// 	'video',
		// 	'audio',
		// 	'chat'
		// ));

	}

}
add_action( 'after_setup_theme', 'theme_setup_features' );

/**
 * Register widget areas.
 */
function theme_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'odin' ),
			'id'            => 'main-sidebar',
			'description'   => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widgettitle widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// $custom_sidebars = kr_option_theme("sidebars");
	// if($custom_sidebars && is_array($custom_sidebars))
	// {
	// 	foreach ($custom_sidebars as $i => $sidebar)
	// 	{
	// 		register_sidebar(
	// 			array(
	// 				'name'          => $sidebar,
	// 				'id'            => 'sidebar-' . $i,
	// 				'description'   => __( 'Custom Sidebar', 'odin' ),
	// 				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 				'after_widget'  => '</aside>',
	// 				'before_title'  => '<h2 class="widgettitle widget-title">',
	// 				'after_title'   => '</h2>',
	// 			)
	// 		);
	// 	}
	// }

}
// add_action( 'widgets_init', 'theme_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 */
function theme_flush_rewrite()
{
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'theme_flush_rewrite' );


/**
 * Load site scripts.
 */
function theme_enqueue_scripts() {

	// Load main stylesheet.
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), null, 'all' );

	// Load jQuery.
	wp_enqueue_script( 'jquery' );

	// Main jQuery.
	wp_enqueue_script( 'app', THEME_URL . '/assets/js/main.js', array(), null, true );
	wp_localize_script( 'app', 'wpAjax', array( 'ajaxurl'=>admin_url('admin-ajax.php') ) );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts', 1 );


/**
 * Custom stylesheet URI.
 */
function theme_custom_stylesheet_uri( $uri, $dir ) {
	$file = $dir . '/assets/css/style.css';
	return $file;
}
add_filter( 'stylesheet_uri', 'theme_custom_stylesheet_uri', 10, 2 );


/* REMOVER ITENS DO MENU LATERAL */
function remove_links_menu() {

	// variaveis globais
	global $kr_remove_menu;

	/**
	 * loop for remove_menu_page
	 **/
	if(count($kr_remove_menu) > 0) {
		foreach ($kr_remove_menu as $me) {
			remove_menu_page($me);
		}
	}

}

add_action( 'admin_menu', 'remove_links_menu', 999 );


/* print head scripts */
function kr_print_head_scripts() {

	// X-UA-Compatible, profile e pingback do Wordpress
	echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />'."\n";
	echo '<link rel="profile" href="http://gmpg.org/xfn/11" />'."\n";
	echo '<link rel="pingback" href="' . get_bloginfo("pingback_url") . '" />'."\n";

	// se tiver favicon ;)
	$favicon = kr_option_theme('site_favicon');
	if(!empty($favicon)) {
		echo '<link href="'.$favicon.'" rel="shortcut icon">'."\n";
	}

	// html5.js para funcionar no IE :(
	global $is_IE;
	if($is_IE) {

		// create elements for html5
		echo '<script type="text/javascript">document.createElement("main");document.createElement("header");document.createElement("nav");document.createElement("article");document.createElement("section");document.createElement("footer");</script>'."\n";

	}

}

add_action('wp_head', 'kr_print_head_scripts');

/* */
function kr_update_sitedescription() {

	// updated
	$option_id = 'updated_sitedescription';

	$updated = get_option( $option_id );

	if(empty($updated) || $updated != 'yes' ) {
		add_option( $option_id );

		if (defined('SITE_NAME')) {

			if(SITE_NAME) {

				update_option( 'blogname', SITE_NAME );

			}

		}

		if (defined('SITE_DESCRIPTION')) {

			if(SITE_DESCRIPTION) {

				update_option( 'blogdescription', SITE_DESCRIPTION );

			}

		}

		update_option($option_id, 'yes');
	}

}
add_action('admin_init', 'kr_update_sitedescription');
