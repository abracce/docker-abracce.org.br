<?php
/**
 * KR Ajax Poll Questions
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */


/**
 * ajax poll preview question
 */
function kr_ajax_poll_preview_question() {

	$question_id = $_POST['question_id'];
	$json        = array();
	$html        = '';

	/* verifica se os campos não estão vazios */
	if( !empty($question_id) ) {
		global $wpdb;

		$query   = "SELECT * FROM {$wpdb->prefix}kr_poll_questions WHERE id = {$question_id}";
		$results = $wpdb->get_results( $query );

		if($results) {
			foreach ($results as $poll) {

				$html .= '<h2><strong>Pergunta:</strong> '.$poll->question_title.'</h2>';

				$query_option = "SELECT * FROM {$wpdb->prefix}kr_poll_options WHERE question_id = {$poll->id} ORDER BY id DESC";
				$options = $wpdb->get_results( $query_option );
				if($options) {
					$html .= '<p><strong>Respostas</strong></p>';
					$html .= '<ul>';
					foreach ($options as $option) {
						$html .= '<li>' . $option->option_title . '</li>';
					}
					$html .= '</ul>';
				}
				else {
					$html .= '<small>(Nenhuma resposta foi cadastrada ainda)</small>';
				}

				$html .= '<br /><hr />';
				$html .= '<div class="poll-form">';
					$html .= '<div class="form-group">';
						$html .= '<label for="kr_poll_shortcode"><strong>Shortcode</strong> <small>(cole o código abaixo no conteúdo do post ou da página)</small></label> ';
						$html .= '<input type="text" id="kr_poll_shortcode" value=\'[poll id="'.$poll->id.'"]\' name="kr_poll_shortcode" class="form-control">';
					$html .= '</div>';
				$html .= '</div>';
			}
		}

		if($results) {
			$json['typ']  = 'updated';
			$json['html'] = $html;
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
		$json['html'] = 'Oops! Id inválido.';
		echo json_encode($json);
		die();
	}
	exit;
}

add_action('wp_ajax_KRPollPreviewQuestion', 'kr_ajax_poll_preview_question');

/**
 * ajax poll save question
 */
function kr_ajax_poll_save_question() {

	$poll_title  = $_POST['poll_title'];
	$poll_status = $_POST['poll_status'];
	$json        = array();

	/* verifica se os campos não estão vazios */
	if( !empty($poll_title) && !empty($poll_status) ) {
		global $wpdb;

		$query  = "INSERT INTO {$wpdb->prefix}kr_poll_questions (date_insert, question_title, question_status) VALUES (NOW(), '{$poll_title}', '{$poll_status}')";
		$result = $wpdb->query( $query );

		if($result) {
			$json['typ']  = 'updated';
			$json['html'] = 'Enquete cadastrada com sucesso!';
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

add_action('wp_ajax_KRPollSaveQuestion', 'kr_ajax_poll_save_question');

/**
 * ajax poll update question
 */
function kr_ajax_poll_update_question() {

	$poll_title  = $_POST['poll_title'];
	$poll_status = $_POST['poll_status'];
	$question_id = $_POST['question_id'];
	$json        = array();

	/* verifica se os campos não estão vazios */
	if( !empty($poll_title) && !empty($poll_status) && !empty($question_id) ) {
		global $wpdb;

		// UPDATE t1 SET col1 = col1 + 1, col2 = col1;
		$query  = "UPDATE {$wpdb->prefix}kr_poll_questions SET question_title = '{$poll_title}', question_status = '{$poll_status}' WHERE id = {$question_id}";
		$result = $wpdb->query( $query );

		if($result) {
			$json['typ']  = 'updated';
			$json['html'] = 'Enquete atualizada com sucesso!';
			echo json_encode($json);
		}
		else {
			$json['typ']  = 'error';
			$json['html'] = 'A Enquete não foi atualizada. Nada foi modificado.';
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

add_action('wp_ajax_KRPollUpdateQuestion', 'kr_ajax_poll_update_question');

/**
 * ajax poll delete question
 */
function kr_ajax_poll_delete_question() {

	$question_id = $_POST['question_id'];
	$json        = array();

	if( !empty($question_id) ) {
		global $wpdb;

		$result = $wpdb->delete( $wpdb->prefix.'kr_poll_questions', array( 'id' => $question_id ) );

		if($result) {

			// delete poll dependencies
			kr_poll_remove_dependencies($question_id);

			$json['typ']  = 'updated';
			$json['html'] = 'Enquete excluída com sucesso!';
			echo json_encode($json);
		}
		else {
			$json['typ']  = 'error';
			$json['html'] = 'A Enquete não foi excluída. Nada foi modificado.';
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

add_action('wp_ajax_KRPollDeleteQuestion', 'kr_ajax_poll_delete_question');

/**
 * ajax poll delete question
 */
function kr_ajax_poll_change_status_question() {

	$question_id = $_POST['question_id'];
	$poll_status = $_POST['poll_status'];
	$json        = array();

	if($poll_status == 1) {
		$poll_status = 2;
	}
	else {
		$poll_status = 1;
	}

	if( !empty($question_id) ) {
		global $wpdb;

		$status = ($poll_status == 1) ? 'Inativa' : 'Ativa';

		$query  = "UPDATE {$wpdb->prefix}kr_poll_questions SET question_status = '{$poll_status}' WHERE id = {$question_id}";
		$result = $wpdb->query( $query );
		$json['typ']  = 'updated';
		$json['html'] = 'O Status da enquete foi alterado para <strong>'.$status.'</strong>!';
		echo json_encode($json);
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

add_action('wp_ajax_KRPollChangeStatusQuestion', 'kr_ajax_poll_change_status_question');


/**
 * ajax poll list all questions
 */
function kr_ajax_poll_list_questions() {

	global $wpdb;
	$json = array();
	$html = '';

	$query   = "SELECT * FROM {$wpdb->prefix}kr_poll_questions ORDER BY id DESC";
	$results = $wpdb->get_results( $query );

	if($results) {
		foreach ($results as $poll) {
			$status = ($poll->question_status == 2) ? 'checked' : '';
			$title  = ($poll->question_status == 2) ? 'desativar' : 'ativar';

			$html .= '<tr data-id="'.$poll->id.'" class="poll-item">';

				$html .= '<td class="post-title page-title column-title">';
					$html .= '<strong>';
						$html .= '<a class="row-title" onclick="kr_ajax_poll_questions.view('.$poll->id.');" title="Visualizar" href="#!'.$poll->id.'">';
							$html .= $poll->question_title;
						$html .= '</a>';
					$html .= '</strong>';
					$html .= '<div class="row-actions">';
						$html .= '<span class="add">';
							$html .= '<a href="#!'.$poll->id.'" onclick="kr_ajax_poll_questions.add_option('.$poll->id.');" title="Resposta" class="poll-tips"><span class="dashicons dashicons-plus"></span></a> |';
						$html .= '</span>';
						$html .= '<span class="view">';
							$html .= '<a href="#!'.$poll->id.'" onclick="kr_ajax_poll_questions.view('.$poll->id.');" title="Visualizar" class="poll-tips"><span class="dashicons dashicons-search"></span></a> |';
						$html .= '</span>';
						$html .= '<span class="edit">';
							$html .= '<a href="#!'.$poll->id.'" onclick="kr_ajax_poll_questions.edit('.$poll->id.');" title="Editar" class="poll-tips"><span class="dashicons dashicons-edit"></span></a> |';
						$html .= '</span>';
						$html .= '<span class="trash">';
							$html .= '<a class="submitdelete poll-tips" onclick="kr_ajax_poll_questions.delete('.$poll->id.');" title="Excluir" href="#!'.$poll->id.'"><span class="dashicons dashicons-trash"></span></a>';
						$html .= '</span>';
					$html .= '</div>';
				$html .= '</td>';

				$html .= '<td class="post-title page-title column-title">';

					$query_option   = "SELECT * FROM {$wpdb->prefix}kr_poll_options WHERE question_id = {$poll->id} ORDER BY id DESC";
					$options = $wpdb->get_results( $query_option );
					if($options) {
						foreach ($options as $option) {
							$html .= '<a href="#!'.$option->id.'" class="poll-tips" title="Remover resposta" onclick="kr_ajax_poll_options.delete('.$option->id.');"><span class="dashicons dashicons-no-alt"></span></a> - <a class="poll-tips" title="Editar este item" href="#!'.$option->id.'" onclick="kr_ajax_poll_options.edit('.$option->id.');">' . $option->option_title . '</a><br />';
						}
					}
					else {
						$html .= '<small>(Nenhuma resposta foi cadastrada ainda)</small>';
					}

				$html .= '</td>';

				$html .= '<td class="post-title page-title column-title">';

					$html .= '<div class="onoffswitch poll-tips" title="Clique para '.$title.' a enquete" onclick="kr_ajax_poll_questions.change_status('.$poll->id.', '.$poll->question_status.');">';
						$html .= '<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch_'.$poll->id.'" '.$status.'>';
						$html .= '<label class="onoffswitch-label" for="myonoffswitch_'.$poll->id.'">';
							$html .= '<span class="onoffswitch-inner"></span>';
							$html .= '<span class="onoffswitch-switch"></span>';
						$html .= '</label>';
					$html .= '</div>';

				$html .= '</td>';

				$html .= '<td class="date column-date text-center">';
					$html .= '<abbr title="11/06/2014 16:30:04">'. mysql2date('d/m/Y H:i', $poll->date_insert) .'</abbr>';
				$html .= '</td>';

			$html .= '</tr>';
		}
		$json['html'] = $html;
		echo json_encode($json);
	}
	else {
		$json['html'] = '<tr class="no-items"><td class="colspanchange" colspan="4">Nenhuma enquete cadastrada.</td></tr>';
		echo json_encode($json);
	}
	exit;
}

add_action('wp_ajax_KRPollListQuestion', 'kr_ajax_poll_list_questions');



/**
 * ajax poll editar enquete
 */
function kr_ajax_poll_edit_question() {
	global $wpdb;
	$question_id = $_POST['question_id'];
	$json = array();
	$html = '';

	if($question_id) {

		$query   = "SELECT * FROM {$wpdb->prefix}kr_poll_questions WHERE id = '" . $question_id . "'";
		$results = $wpdb->get_results( $query );

		if($results) {
			foreach ($results as $poll) {
				$in = ($poll->question_status == 1) ? 'selected' : '';
				$at = ($poll->question_status == 2) ? 'selected' : '';

				$html .= '<div class="poll-form">';
					$html .= '<input type="hidden" id="kr_poll_question_id" value="'.$poll->id.'" name="kr_poll_question_id" >';

					$html .= '<div class="form-group">';
						$html .= '<label for="kr_poll_title">Pergunta:</label> ';
						$html .= '<input type="text" id="kr_poll_title" value="'.$poll->question_title.'" name="kr_poll_title" class="form-control">';
					$html .= '</div>';

					$html .= '<div class="form-group">';
						$html .= '<label for="kr_poll_status">Status:</label> ';
						$html .= '<select class="form-control" name="kr_poll_status" id="kr_poll_status">';
						$html .= '<option value=""> -- Selecione -- </option>';
						$html .= '<option value="1" '.$in.'>Inativa</option>';
						$html .= '<option value="2" '.$at.'>Ativa</option>';
						$html .= '</select>';
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

add_action('wp_ajax_KRPollEditQuestion', 'kr_ajax_poll_edit_question');


/**
 * remove poll dependencies
 */
function kr_poll_remove_dependencies($question_id = null) {
	if(!empty($question_id)) {
		global $wpdb;
		$query_option = "SELECT * FROM {$wpdb->prefix}kr_poll_options WHERE question_id = {$question_id}";
		$options = $wpdb->get_results( $query_option );
		if($options) {
			foreach ($options as $option) {
				$wpdb->delete( $wpdb->prefix.'kr_poll_options', array( 'id' => $option->id ) );
				$wpdb->delete( $wpdb->prefix.'kr_poll_votes', array( 'option_id' => $option->id ) );
			}
		}
	}
	else {
		return;
	}
}
