<?php
/**
 * The init module
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

define('NEWSLETTER_PATH', dirname(__FILE__));
define('NEWSLETTER_URL', MODULES_URL . '/newsletter');

// include module functions
include_once NEWSLETTER_PATH . '/functions.php';

// include custom post type
include_once NEWSLETTER_PATH . '/custom-post.php';

// include custom meta box
include_once NEWSLETTER_PATH . '/meta-box.php';
