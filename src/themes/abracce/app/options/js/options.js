jQuery(document).ready(function(){


	if(jQuery('#last_tab').val() == ''){

		jQuery('.opts-group-tab:first').slideDown();
		jQuery('#opts-group-menu li:first').addClass('active');

	}else{

		tabid = jQuery('#last_tab').val();
		jQuery('#'+tabid+'_section_group').slideDown();
		jQuery('#'+tabid+'_section_group_li').addClass('active');

	}


	jQuery('input[name="'+nhp_opts.opt_name+'[defaults]"]').click(function(){
		if(!confirm(nhp_opts.reset_confirm)){
			return false;
		}
	});

	jQuery('.opts-group-tab-link-a').click(function(){
		relid = jQuery(this).attr('data-rel');

		jQuery('#last_tab').val(relid);

		jQuery('.opts-group-tab').each(function(){
			if(jQuery(this).attr('id') == relid+'_section_group'){
				jQuery(this).delay(400).show();
			}else{
				jQuery(this).hide();
			}

		});

		jQuery('.opts-group-tab-link-li').each(function(){
				if(jQuery(this).attr('id') != relid+'_section_group_li' && jQuery(this).hasClass('active')){
					jQuery(this).removeClass('active');
				}
				if(jQuery(this).attr('id') == relid+'_section_group_li'){
					jQuery(this).addClass('active');
				}
		});
	});




	if(jQuery('#opts-save').is(':visible')){
		jQuery('#opts-save').delay(4000).slideUp();
	}

	if(jQuery('#opts-imported').is(':visible')){
		jQuery('#opts-imported').delay(4000).slideUp();
	}

	jQuery('input, textarea, select').change(function(){
		jQuery('#opts-save-warn').slideDown();
	});


	jQuery('#opts-import-code-button').click(function(){
		if(jQuery('#opts-import-link-wrapper').is(':visible')){
			jQuery('#opts-import-link-wrapper').hide();
			jQuery('#import-link-value').val('');
		}
		jQuery('#opts-import-code-wrapper').show();
	});

	jQuery('#opts-import-link-button').click(function(){
		if(jQuery('#opts-import-code-wrapper').is(':visible')){
			jQuery('#opts-import-code-wrapper').hide();
			jQuery('#import-code-value').val('');
		}
		jQuery('#opts-import-link-wrapper').show();
	});




	jQuery('#opts-export-code-copy').click(function(){
		if(jQuery('#opts-export-link-value').is(':visible')){jQuery('#opts-export-link-value').hide();}
		jQuery('#opts-export-code').toggle('fade');
	});

	jQuery('#opts-export-link').click(function(){
		if(jQuery('#opts-export-code').is(':visible')){jQuery('#opts-export-code').hide();}
		jQuery('#opts-export-link-value').toggle('fade');
	});






});
