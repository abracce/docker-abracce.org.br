<?php
/**
 * KR Ajax Poll Admin
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

class KR_Ajax_Poll_Admin
{

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'kr_poll_add_menu_options' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'kr_poll_assets_admin' ) );

	}

	public function kr_poll_add_menu_options() {

		add_menu_page( __('Poll', THEME_FX), __('Poll', THEME_FX), 'publish_pages', KR_POLL_FX, array( $this, 'kr_poll_view_options' ), 'dashicons-' . KR_POLL_DASHICON, '1.2' );

	}

	// admin assets ajax poll
	public function kr_poll_assets_admin() {
		global $pagenow;

		if( $pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == KR_POLL_FX ) {
			// kr ajax poll
			wp_enqueue_script( KR_POLL_FX, KR_POLL_URL.'/assets/ajax-poll-admin.min.js', array( 'jquery' ), null, true);
			wp_enqueue_style( KR_POLL_FX, KR_POLL_URL.'/assets/ajax-poll-admin.css', array(), null, 'all' );
		}
	}

	public function kr_poll_view_options() {
		include 'views/admin-options.php';
		include 'views/admin-modal.php';
	}

}

$KR_Ajax_Poll_Admin = new KR_Ajax_Poll_Admin();
