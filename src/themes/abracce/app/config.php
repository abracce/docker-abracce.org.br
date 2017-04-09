<?php

/**
 *  Definitions
 */
$the_theme = wp_get_theme();
define( 'THEME_NAME', $the_theme['Name'] );
define( 'THEME_VERSION', $the_theme['Version'] );
define( 'THEME_FX', 'kr' );
define( 'THEME_PATH', get_template_directory() );
define( 'THEME_URL', get_template_directory_uri() );
define( 'SITE_URL', get_bloginfo( 'url' ) );

// Modo manutenção e options developer
$config['maintenance_mode'] = false;
$config['options_dev_mode'] = false;

// Remover link de editor de arquivos
define( 'DISALLOW_FILE_EDIT', true );

// Definicoes do desenvolvedor do site
$dev_copy['name']  = 'Fernando Moreira';
$dev_copy['email'] = 'fernando@agenciatrend.com.br';
$dev_copy['fone']  = '(41) 3151-3318 / (41) 8440-1163';
$dev_copy['url']   = 'http://nandomoreira.me/';
$dev_copy['admin_footer'] = ' - Developed by <a href="'.$dev_copy['url'].'" target="_blank">'.$dev_copy['name'].'</a></span>';

// Definições de suporte
$support['email'] = 'suporte@agenciatrend.com.br ';
$support['link']  = 'http://www.agenciatrend.com.br/contato/';

// Application path and url
define( 'APP_PATH', THEME_PATH . '/app' );
define( 'APP_URL', THEME_URL . '/app' );

if (defined('APP_PATH') && defined('APP_URL'))
{
	// Application path and url
	define( 'ADMIN_THEME_PATH', APP_PATH . '/admin' );
	define( 'ADMIN_THEME_URL', APP_URL . '/admin' );

	// Odin path and url
	define( 'ODIN_PATH', APP_PATH . '/odin' );
	define( 'ODIN_URL', APP_URL . '/odin' );

	// Options path and url
	define( 'OPTIONS_PATH', APP_PATH . '/options' );
	define( 'OPTIONS_URL', APP_URL . '/options' );

	// Class path and url
	define( 'CLASS_PATH', APP_PATH . '/class' );
	define( 'CLASS_URL', APP_URL . '/class' );

	// Functions path and url
	define( 'FUNCTIONS_PATH', APP_PATH . '/functions' );
	define( 'FUNCTIONS_URL', APP_URL . '/functions' );

	// Modules path and url
	define( 'MODULES_PATH', APP_PATH . '/modules' );
	define( 'MODULES_URL', APP_URL . '/modules' );

	// Plugins path and url
	define( 'PLUGINS_PATH', APP_PATH . '/plugins' );
	define( 'PLUGINS_URL', APP_URL . '/plugins' );
}
