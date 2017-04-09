<?php
/**
 * Redirect to maintenance
 *
 * Redireciona o usuario não logado no wordpress para um diretorio /maintenance
 *
 * @author: Fernando Moreira
 * @package WPKraken
 * @version: 2.0
 *
 */

define( 'PATH_MAINTENANCE', 'maintenance' );
define( 'URL_MAINTENANCE', get_home_url() .'/'. PATH_MAINTENANCE );

if(!function_exists( 'kr_maintenance_header' )):
	function kr_maintenance_header( $status_header, $header, $text, $protocol ) {
		if ( !is_user_logged_in() ) {
			return "$protocol 503 Service Unavailable";
		}
	}
endif;

/*
 * Redireciona quando faz um Log In
 **/
add_action( 'login_form', 'redirect_after_login' );
function redirect_after_login() {
	global $redirect_to;
	if (!isset($_GET['redirect_to'])) {
		$redirect_to = admin_url();
	}
}

/*
 * Redireciona quando faz um Log Out
 **/
function logout_redirect765(){
	wp_redirect( URL_MAINTENANCE );
	exit;
}
add_action( 'wp_logout', 'logout_redirect765' );

/*
 * Verifica se o usuario esta loga e redireciona
 **/
if( !function_exists('kr_maintenance_content') ):
	function kr_maintenance_content() {
		if ( !is_user_logged_in() )  {
			die( wp_safe_redirect( URL_MAINTENANCE ) );
			exit;
		}
	}
endif;
add_action('get_header', 'kr_maintenance_content');

if ( function_exists('add_filter') ):
	add_filter( 'status_header', 'kr_maintenance_header', 10, 4 );
	add_action( 'get_header', 'kr_maintenance_content' );
else:
	die();
endif;
