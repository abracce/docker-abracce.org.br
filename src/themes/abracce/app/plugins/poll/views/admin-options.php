<?php
/**
 * KR Ajax Poll Admin view
 *
 * @author Fernando Moreira
 * @package WPKraken
 * @version 1.0
 */
?>
<div class="wrap">
	<h2><?php _e('Poll', THEME_FX) ?> <a href="#" class="add-new-h2 add-new-poll">Adicionar Enquete</a></h2>

	<div id="poll-alert"><p>Poll alert</p></div>

	<hr class="clear" />

	<table class="wp-list-table widefat fixed posts">
		<thead>
			<tr>
				<th scope="col">Enquete</th>
				<th scope="col">Respostas</th>
				<th scope="col" class="status-column">Status</th>
				<th scope="col" class="date-column">Data do cadastro</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th scope="col">Enquete</th>
				<th scope="col">Respostas</th>
				<th scope="col" class="status-column">Status</th>
				<th scope="col" class="date-column">Data do cadastro</th>
			</tr>
		</tfoot>

		<tbody id="the-list-poll">
			<tr class="no-items">
				<td class="colspanchange" colspan="4">
					Carregando... <img src="<?php echo KR_POLL_URL ?>/assets/loading.gif" alt="loading" />
				</td>
			</tr>
		</tbody>

	</table>

	<p class="pull-right trend"><small>by <a href="http://fb.com/fernando-dev" target="_blank">Fernando Moreira</a></small></p>
	<hr class="clear" />

</div>


<!-- Poll modal -->
<div class="modal fade" id="kr_poll_modal" tabindex="-1" role="dialog" aria-labelledby="KR_Poll_ModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="KR_Poll_ModalLabel">&nbsp;</h4>
			</div>

			<div class="modal-body">&nbsp;</div>

			<div class="modal-footer">
				<button type="button" id="save_changes" class="button button-primary">Salvar alterações</button>
			</div>

		</div>
	</div>
</div>
<!-- /Poll modal -->
