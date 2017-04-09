<?php
/**
 * KR Ajax Poll MySQL
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

// delete_option( 'kr_ajax_poll_installed' );

$kr_poll_query = array();

$kr_poll_query[] = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kr_poll_questions"
		 ."( UNIQUE KEY id (id), PRIMARY KEY (id),
			id int(100) NOT NULL AUTO_INCREMENT,
			date_insert datetime DEFAULT NULL,
			question_title  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
			question_status char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1' )";

$kr_poll_query[] = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kr_poll_options"
		 ."( UNIQUE KEY id (id), PRIMARY KEY (id),
			id int(100) NOT NULL AUTO_INCREMENT,
			question_id int(11) NOT NULL,
			option_title varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL)";

$kr_poll_query[] = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "kr_poll_votes"
		 ."( UNIQUE KEY id (id), PRIMARY KEY (id),
			id int(100) NOT NULL AUTO_INCREMENT,
			option_id  int(10) NOT NULL DEFAULT 0,
			date_vote datetime NULL DEFAULT NULL ,
			user_ip varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL)";

function kr_ajax_poll_install() {
	global $wpdb, $kr_poll_query;
	add_option( 'kr_ajax_poll_installed' );
	$installed = get_option( 'kr_ajax_poll_installed' );

	if( empty($installed) || $installed != 'true' ) {

		foreach ($kr_poll_query as $sql) {
			$wpdb->query($sql);
		}

		update_option( 'kr_ajax_poll_installed', 'true' );
	}

}

add_action( 'admin_init', 'kr_ajax_poll_install' );
