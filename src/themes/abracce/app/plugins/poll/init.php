<?php
/**
 * The init plugin KR Ajax Poll
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

error_reporting( 22527 );

define('KR_POLL_FX', 'poll');
define('KR_POLL_PATH', dirname(__FILE__));
define('KR_POLL_URL', PLUGINS_URL . '/' . KR_POLL_FX);
define('KR_POLL_DASHICON', 'list-view');

define('PATH_TBASE', 'tbase');

// front assets ajax poll
function kr_poll_enqueue_assets()
{
	wp_enqueue_script(KR_POLL_FX, KR_POLL_URL . '/assets/ajax-poll.min.js', array( 'jquery' ), null, true );
	wp_enqueue_style(KR_POLL_FX, KR_POLL_URL . '/assets/ajax-poll.css', array(), null, 'all' );
}
add_action( 'wp_enqueue_scripts', 'kr_poll_enqueue_assets', 1 );

if (defined('KR_POLL_PATH'))
{
	if ( is_admin() )
	{
		// include ajax-poll-mysql.php
		include_once( KR_POLL_PATH . '/ajax-poll-mysql.php' );
	}

	// include ajax-poll
	// include_once( KR_POLL_PATH . '/ajax-poll.php' );

	// include module functions
	include_once( KR_POLL_PATH . '/functions.php' );

	if ( is_admin() )
	{
		include_once( KR_POLL_PATH . '/ajax-poll-questions.php' );
		include_once( KR_POLL_PATH . '/ajax-poll-options.php' );

		// include KR_Ajax_Poll admin class
		include_once( KR_POLL_PATH . '/ajax-poll-admin.php' );
	}

	// include kr ajax poll Widget
	include_once( KR_POLL_PATH . '/ajax-poll-widget.php' );

	// include kr ajax poll shortcode
	include_once( KR_POLL_PATH . '/ajax-poll-shortcode.php' );
}
