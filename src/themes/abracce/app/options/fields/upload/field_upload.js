jQuery(document).ready(function(){


	/*
	 *
	 * KR_Options_upload function
	 * Adds media upload functionality to the page
	 *
	 */

	 var header_clicked = false;

	// jQuery("img[src='']").attr("src", KR_upload.url);

	jQuery('.opts-upload').click(function() {
		header_clicked = true;
		formfield = jQuery(this).attr('rel-id');
		tb_show('', 'media-upload.php?post_id=0&amp;TB_iframe=true');
		return false;
	});

	// Store original function
	window.original_send_to_editor = window.send_to_editor;

	window.send_to_editor = function(html) {
		if (header_clicked) {

			href = jQuery(html).attr('href');
			jQuery('#' + formfield).val(href);
			jQuery('#' + formfield).next().hide();
			jQuery('#' + formfield).next().next().show(0);
			tb_remove();
			header_clicked = false;
		} else {
			window.original_send_to_editor(html);
		}
	}

	jQuery('.opts-upload-remove').click(function(){
		$relid = jQuery(this).attr('rel-id');
		jQuery('#'+$relid).val('');
		jQuery(this).prev().show();
		jQuery(this).hide();
	});
});
