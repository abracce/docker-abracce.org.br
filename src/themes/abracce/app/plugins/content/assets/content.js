/**
 * WP Editor Widget object
 */
VRContentWidget = {

	/**
	 * @var string
	 */
	currentContentId: '',

	/**
	 * Show the editor
	 * @param string contentId
	 */
	showEditor: function(contentId) {
		jQuery('#content-backdrop').show();
		jQuery('#content-container').show();

		this.currentContentId = contentId;

		this.setEditorContent(contentId);
	},

	/**
	 * Hide editor
	 */
	hideEditor: function() {
		jQuery('#content-backdrop').hide();
		jQuery('#content-container').hide();
	},

	/**
	 * Set editor content
	 */
	setEditorContent: function(contentId) {
		var editor = tinyMCE.EditorManager.get('content');
		if (typeof editor == "undefined") {
			jQuery('#content').val(jQuery('#'+ contentId).val());
		}
		else {
			editor.setContent(jQuery('#'+ contentId).val());
		}
	},

	/**
	 * Update widget and close the editor
	 */
	updateWidgetAndCloseEditor: function() {
		var editor = tinyMCE.EditorManager.get('content');
		if (typeof editor == "undefined") {
			jQuery('#'+ this.currentContentId).val(jQuery('#content').val());
		}
		else {
			jQuery('#'+ this.currentContentId).val(editor.getContent());
		}
		wpWidgets.save(jQuery('#'+ this.currentContentId).closest('div.widget'), 0, 1, 0);
		this.hideEditor();
	}

};
