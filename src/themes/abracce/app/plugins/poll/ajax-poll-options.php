<?php
/**
 * KR Ajax Poll Options
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

/*
 * save poll option
 */
function kr_ajax_poll_save_option() {

	$option_title = $_POST['option_title'];
	$question_id  = $_POST['question_id'];
	$json         = array();

	/* verifica se os campos não estão vazios */
	if( !empty($option_title) && !empty($question_id) ) {
		global $wpdb;

		$query  = "INSERT INTO {$wpdb->prefix}kr_poll_options (question_id, option_title) VALUES ('{$question_id}', '{$option_title}')";
		$result = $wpdb->query( $query );

		if($result) {
			$json['typ']  = 'updated';
			$json['html'] = 'Resposta para enquete cadastrada com sucesso!';
			echo json_encode($json);
		}
		else {
			$json['typ']  = 'error';
			$json['html'] = 'Oops! Ocorreu um erro.';
			echo json_encode($json);
		}
		die();

	}
	else {
		$json['typ']  = 'error';
		$json['html'] = 'Oops! Não deixe nenhum dos campos vazio. Por favor tente novamente.';
		echo json_encode($json);
		die();
	}
	exit;
}

add_action('wp_ajax_KRPollNewOption', 'kr_ajax_poll_save_option');


/*
 * ajax poll editar enquete
 */
function kr_ajax_poll_edit_option() {
	global $wpdb;
	$option_id = $_POST['option_id'];
	$json = array();
	$html = '';

	if($option_id) {

		$query   = "SELECT id, option_title FROM {$wpdb->prefix}kr_poll_options WHERE id = '" . $option_id . "'";
		$results = $wpdb->get_results( $query );

		if($results) {
			foreach ($results as $option) {

				$html .= '<div class="poll-form">';
					$html .= '<div class="form-group">';
						$html .= '<label for="kr_option_title">Resposta:</label> ';
						$html .= '<input type="text" id="kr_option_title" value="'.$option->option_title.'" name="kr_option_title" class="form-control">';
						$html .= '<input type="hidden" id="kr_option_id" value="'.$option->id.'" name="kr_option_id" >';
					$html .= '</div>';
				$html .= '</div>';

			}
			$json['html'] = $html;
			echo json_encode($json);
		}
		else {
			$json['html'] = 'Oops! Ocorreu ume erro :(';
			echo json_encode($json);
		}
	}
	exit;
}

add_action('wp_ajax_KRPollEditOption', 'kr_ajax_poll_edit_option');



/*
 * Update option poll
 */
function kr_ajax_poll_update_option() {

	$option_title = $_POST['option_title'];
	$option_id    = $_POST['option_id'];
	$json         = array();

	/* verifica se os campos não estão vazios */
	if( !empty($option_title) && !empty($option_id) ) {
		global $wpdb;

		$query  = "UPDATE {$wpdb->prefix}kr_poll_options SET option_title = '{$option_title}' WHERE id = {$option_id}";
		$result = $wpdb->query( $query );

		if($result) {
			$json['typ']  = 'updated';
			$json['html'] = 'Resposta atualizada com sucesso!';
			echo json_encode($json);
		}
		else {
			$json['typ']  = 'error';
			$json['html'] = 'A Resposta não foi atualizada. Nada foi modificado.';
			echo json_encode($json);
		}
		die();

	}
	else {
		$json['typ']  = 'error';
		$json['html'] = 'Oops! Por favor tente novamente.';
		echo json_encode($json);
		die();
	}
	exit;
}

add_action('wp_ajax_KRPollUpdateOption', 'kr_ajax_poll_update_option');


/*
 * Delete poll option
 */
function kr_ajax_poll_delete_option() {

	$option_id = $_POST['option_id'];
	$json      = array();

	if( !empty($option_id) ) {
		global $wpdb;

		$result = $wpdb->delete( $wpdb->prefix.'kr_poll_options', array( 'id' => $option_id ) );

		if($result) {
			$json['typ']  = 'updated';
			$json['html'] = 'Resposta foi excluída com sucesso!';
			echo json_encode($json);
		}
		die();

	}
	else {
		$json['typ']  = 'error';
		$json['html'] = 'Id inválido!';
		echo json_encode($json);
		die();
	}
	exit;
}

add_action('wp_ajax_KRPollDeleteOption', 'kr_ajax_poll_delete_option');


/*
 * Poll option Save vote
 */
function kr_ajax_poll_save_vote() {

	$question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';
	$option_id   = (isset($_POST['option_id'])) ? $_POST['option_id'] : '';
	$json        = array();

	if( !empty($question_id) && !empty($option_id) ) {

		if( !isset($_COOKIE["poll-voted"]) ) {
			global $wpdb;

			$user_ip = kr_get_user_ip();
			$query   = "INSERT INTO {$wpdb->prefix}kr_poll_votes (question_id, option_id, date_vote, user_ip) VALUES ('{$question_id}', '{$option_id}', NOW(), '{$user_ip}')";
			$result  = $wpdb->query( $query );

			if($result) {
				$json['typ']  = 'success';
				$json['html'] = 'Voto computado com sucesso.';
				setcookie( "poll-voted", 1, time()+86400, "/" );
				echo json_encode($json);
			}
			die();
		}
		else {
			$json['typ']  = 'error';
			$json['html'] = 'Você já participou hoje, volte amanhã.';
			echo json_encode($json);
		}

	}
	else {
		$json['typ']  = 'error';
		$json['html'] = 'Oops não vote em branco!';
		echo json_encode($json);
		die();
	}
	exit;
}
add_action('wp_ajax_nopriv_KRAjaxPollSaveVote', 'kr_ajax_poll_save_vote');
add_action('wp_ajax_KRAjaxPollSaveVote', 'kr_ajax_poll_save_vote');


function kr_get_user_ip() {

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}


/*
 * Poll vote results
 */
function kr_ajax_poll_vote_results() {

	$question_id = (isset($_POST['question_id'])) ? $_POST['question_id'] : '';
	$json        = array();

	if( !empty($question_id) ) {
		global $wpdb;

		$query   = "SELECT * FROM {$wpdb->prefix}kr_poll_options WHERE question_id = {$question_id}";
		$results = $wpdb->get_results( $query );

		if($results) {

			$html = '';
			$query_count_total  = "SELECT count(*) FROM {$wpdb->prefix}kr_poll_votes WHERE question_id = '{$question_id}'";
			$_count_total = $wpdb->get_var( $query_count_total );

			foreach ($results as $i => $options) {
				$query_votes = "SELECT count(*) FROM {$wpdb->prefix}kr_poll_votes WHERE option_id = {$options->id}";
				$total_votes = $wpdb->get_var( $query_votes );
				$poll        = $results[$i];
				$percentage  = kr_get_percetage($total_votes, $_count_total, 0);

				$html .= '<div class="progress progress-striped active">';
					$html .= '<div class="progress-bar" role="progressbar" data-value="'.$percentage.'" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>';
				$html .= '</div>';
				$html .= '<span>'.$poll->option_title . ' - ' . $percentage.'% ('.$total_votes.' votos)</span>';
			}

			if($total_votes) {
				$json['typ']   = 'updated';
				$json['html']  = $html;
				echo json_encode($json);
			}
			die();
		}
		else {
			$json['typ']  = 'error';
			$json['html'] = 'Nenhum resultado.';
			echo json_encode($json);
			die();
		}
	}
	else {
		$json['typ']  = 'error';
		$json['html'] = 'Id inválido!';
		echo json_encode($json);
		die();
	}
	exit;
}
add_action('wp_ajax_nopriv_KRAjaxPollVoteResults', 'kr_ajax_poll_vote_results');
add_action('wp_ajax_KRAjaxPollVoteResults', 'kr_ajax_poll_vote_results');


function kr_get_percetage($val1, $val2, $precision) {
	$res = round( ($val1 / $val2) * 100, $precision );
	return $res;
}
