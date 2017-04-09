<?php
/**
 * The option config
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @since 0.1
 */

$prefix   = THEME_FX . "_";
$sections = array();
$args     = array();
$tabs     = array();

$args['opt_name']       = THEME_FX;
$args['menu_title']     = 'Opções do site';
$args['page_title']     = THEME_NAME.' - Opções do site';
$args['page_slug']      = THEME_FX.'-site-option';
$args['allow_sub_menu'] = false;
$args['page_type']      = 'submenu';
$args['page_parent']    = 'themes.php';
$args['page_cap']       = 'edit_pages';

if( $config['options_dev_mode'] == true )
{
	$args['show_import_export'] = true;
	$args['dev_mode']           = true;
}
else
{
	$args['show_import_export'] = false;
	$args['dev_mode']           = false;
}

$fslashed_dir = trailingslashit(str_replace( '\\','/', dirname( __FILE__) ) );

if( defined('SITE_PATH') && defined('DS'))
{
	$config['fslashed_abs'] = str_replace("\\", "/", SITE_PATH . DS . 'application');
	$fslashed_abs           = $config['fslashed_abs'];
	$mhp_url                = str_replace( 'dashboard', 'application', get_site_url() ) . str_replace( $fslashed_abs, '', $fslashed_dir );
}
else
{
	$fslashed_abs = trailingslashit(str_replace( '\\','/', ABSPATH ) );
	$mhp_url      = get_site_url() . '/' . str_replace( $fslashed_abs, '', $fslashed_dir );
}

if(!defined('KR_OPTIONS_DIR'))
{
	define('KR_OPTIONS_DIR', $fslashed_dir);
}

if(!defined('KR_OPTIONS_URL'))
{
	define('KR_OPTIONS_URL', $mhp_url );
}
