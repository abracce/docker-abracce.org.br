<?php
/**
 * KR Ajax Poll - Frontend poll vores
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */

global $wpdb;
if(!empty($kr_poll_id)) {
	$query     = "SELECT * FROM {$wpdb->prefix}kr_poll_questions WHERE id = {$kr_poll_id} ORDER BY id DESC";
	$questions = $wpdb->get_results( $query );

	if($questions) {

		foreach ($questions as $poll) {
		?>

		<div id="poll-<?php echo $poll->id ?>" data-id="<?php echo $poll->id ?>" class="poll">

			<div class="poll-form">

				<h5><?php echo $poll->question_title ?></h5>

				<?php
				$query_option   = "SELECT * FROM {$wpdb->prefix}kr_poll_options WHERE question_id = {$poll->id} ORDER BY id DESC";
				$options = $wpdb->get_results( $query_option );
				if($options) {
					foreach ($options as $option) {
					?>
					<div class="radio">
						<label for="kr_poll_vote_<?php echo $option->id ?>">
							<input type="radio" name="kr_poll_vote" id="kr_poll_vote_<?php echo $option->id ?>" value="<?php echo $option->id ?>">
							<?php echo $option->option_title ?>
						</label>
					</div>
					<?php
					}
				}
				?>

				<div class="poll-alert alert"></div>

				<a href="#!btn-vote" class="poll-btn-vote btn btn-primary btn-xs">Votar</a>
				<a href="#!btn-results" class="poll-btn-results btn btn-link btn-xs">Ver resultado</a>
			</div>

			<div class="poll-results">
				<div class="poll-results"></div>
				<a href="#!btn-back" class="poll-btn-back btn btn-link btn-xs">&laquo; Voltar</a>
			</div>

		</div>

		<?php

		} # end foreach

	} # end if

}
else {
	echo "<div class='alert alert-info text-center'><p><small>A enquete não foi selecionada corretamente!</small></p></div>";
} # end if
