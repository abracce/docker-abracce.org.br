<?php

$email_default = '';

// var global $kr_modules
$kr_modules = array(
	'news-posts',
	'services',
	'partners',
	'banners',
	'contact',
	// 'newsletter',
	'videos',
	'doacoes-online',
);

// var global $kr_plugins
$kr_plugins = array(
	'mobble',
	'gallery',
	// 'poll',
	'content',
	// 'sticky-posts',
	'sharethis',
);

// var global $kr_remove_menu
/* para REMOVER menus da sidebar esquerda do painel */
$kr_remove_menu = array(
	'edit-comments.php',
	'tools.php',
	// 'plugins.php',
	// 'options-general.php',
	// 'index.php',
	// 'edit.php',
	// 'upload.php',
	'link-manager.php',
	// 'edit.php?post_type=page',
	// 'themes.php',
	// 'users.php',
);

// variavel global para estados brasileiros
$global_estados = array(
	""   => "-- Selecione --",
	"AC" => "Acre",
	"AL" => "Alagoas",
	"AM" => "Amazonas",
	"AP" => "Amapá",
	"BA" => "Bahia",
	"CE" => "Ceará",
	"DF" => "Distrito Federal",
	"ES" => "Espírito Santo",
	"GO" => "Goiás",
	"MA" => "Maranhão",
	"MT" => "Mato Grosso",
	"MS" => "Mato Grosso do Sul",
	"MG" => "Minas Gerais",
	"PA" => "Pará",
	"PB" => "Paraíba",
	"PR" => "Paraná",
	"PE" => "Pernambuco",
	"PI" => "Piauí",
	"RJ" => "Rio de Janeiro",
	"RN" => "Rio Grande do Norte",
	"RO" => "Rondônia",
	"RS" => "Rio Grande do Sul",
	"RR" => "Roraima",
	"SC" => "Santa Catarina",
	"SE" => "Sergipe",
	"SP" => "São Paulo",
	"TO" => "Tocantins"
);

/* maintenance mode */
global $config;
if($config['maintenance_mode'])
{
	require_once PLUGINS_PATH . '/maintenance/init.php';
}
