<?php
/**
 * WPKraken include functions
 *
 * @package WPKraken
 * @since 3.0.0
 */

define('KRAKEN_APP_PATH', dirname(__FILE__));

/**
 * WPKraken config
 */
if (defined('KRAKEN_APP_PATH'))
{
	require_once KRAKEN_APP_PATH . '/config.php';
}

/**
 * WPKraken globals
 */
if (defined('KRAKEN_APP_PATH'))
{
	require_once KRAKEN_APP_PATH . '/globals.php';
}

/**
 * Odin framework
 */
if (defined('ODIN_PATH'))
{
	require_once ODIN_PATH . '/init.php';
}

/**
 * Custom Admin Theme
 */
if (defined('ADMIN_THEME_PATH'))
{
	require_once ADMIN_THEME_PATH . '/init.php';
}

/**
 * Functions
 */
if (defined('FUNCTIONS_PATH'))
{
	require_once FUNCTIONS_PATH . '/init.php';
}

/**
 * Class
 */
if (defined('CLASS_PATH'))
{
	require_once CLASS_PATH . '/init.php';
}


/**
 * KR Options framework
 */
if (defined('OPTIONS_PATH'))
{
	require_once OPTIONS_PATH . '/init.php';
}

/**
 * Plugins
 */
if (defined('PLUGINS_PATH'))
{
	require_once PLUGINS_PATH . '/autoload.php';
}


/**
 * Modules
 */
if (defined('MODULES_PATH'))
{
	require_once MODULES_PATH . '/autoload.php';
}
