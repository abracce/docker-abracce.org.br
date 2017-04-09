<?php
/**
 * The init module
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

define('KR_CONTACT_PATH', dirname(__FILE__));
define('KR_CONTACT_URL', MODULES_URL . '/contact');

// include class contact-form
include_once( KR_CONTACT_PATH . '/class/contact-form.php' );

// include module config
include_once( KR_CONTACT_PATH . '/config.php' );

// include module functions
include_once( KR_CONTACT_PATH . '/functions.php' );

// include custom post type
include_once( KR_CONTACT_PATH . '/custom-post.php' );

// include custom meta box
include_once( KR_CONTACT_PATH . '/meta-box.php' );

// include custom shortcodes
include_once( KR_CONTACT_PATH . '/shortcodes.php' );
