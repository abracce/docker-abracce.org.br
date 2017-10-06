(function($) {

    $('body').kraken({
		'masks' : true,
		'totop' : true,
		'tips' : true,
		'dropdown' : true,
		'validate' : true,
		'NProgress' : true,
    });

    $(document).on('click', '.video a', function(e) {
	e.preventDefault();

	var video 	   = $(this).data('video'),
			video_wrap = $('#video-wrapper'), html = '',
			offs       = video_wrap.offset(),
			offtop     = offs.top;

		video_wrap.html('');

		html += '<div class="video-content">';
		html += '<div class="main-container">';
			html += '<button type="button" class="close">&times;</button>';
			html += '<div class="video-container">';
			html += '<iframe width="100%" height="450" src="//www.youtube.com/embed/'+video+'?autoplay=1" frameborder="0" allowfullscreen></iframe>';
			html += '</div>';
		html += '</div>';
		html += '</div>';

		$('html,body').animate({ scrollTop: (offtop-3) }, 700, 'easeOutQuart' );
		video_wrap.html(html).css({ 'height' : 'auto' });
    });

    $('#video-wrapper').on('click', '.close', function(e) {
	e.preventDefault();
	$('#video-wrapper').animate({ height : 0 }, 400).html('');
    });

})(jQuery);
