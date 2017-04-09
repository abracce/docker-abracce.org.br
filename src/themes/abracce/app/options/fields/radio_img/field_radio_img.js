/*
 *
 * KR_Options_radio_img function
 * Changes the radio select option, and changes class on images
 *
 */
function KR_radio_img_select(relid, labelclass){
	jQuery(this).prev('input[type="radio"]').prop('checked');

	jQuery('.radio-img-'+labelclass).removeClass('radio-img-selected');

	jQuery('label[for="'+relid+'"]').addClass('radio-img-selected');
}//function
