<?php
/**
 * The init module
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

define('NEWS_POSTS_PATH', dirname(__FILE__));
define('NEWS_POSTS_URL', MODULES_URL . '/news-posts');

// include functions
include_once NEWS_POSTS_PATH . '/functions.php';

// include meta-box
// include_once NEWS_POSTS_PATH . '/meta-box.php';
