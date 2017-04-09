jQuery(document).ready(function(){

	var header_clicked = false;

	jQuery("img[src='']").attr("src", KR_upload.url);

	jQuery('.opts-upload-image').click(function() {
		header_clicked = true;
		formfield = jQuery(this).attr('rel-id');
		preview = jQuery(this).prev('img');
		tb_show('', 'media-upload.php?type=image&amp;post_id=0&amp;TB_iframe=true');
		return false;
	});

	// Store original function
	window.original_send_to_editor = window.send_to_editor;

	window.send_to_editor = function(html) {
		if (header_clicked) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#' + formfield).val(imgurl);
			jQuery('#' + formfield).next().fadeIn();
			jQuery('#' + formfield).next().next().fadeOut();
			jQuery('#' + formfield).next().next().next().fadeIn();
			jQuery(preview).attr('src' , imgurl);
			tb_remove();
			header_clicked = false;
		} else {
			window.original_send_to_editor(html);
		}
	}

	jQuery('.opts-upload-remove-image').click(function(){
		$relid = jQuery(this).attr('rel-id');
		jQuery('#'+$relid).val('');
		jQuery(this).prev().show();
		jQuery(this).prev().prev().fadeOut(300, function(){jQuery(this).attr("src", KR_upload.url);});
		jQuery(this).hide();
	});
});
