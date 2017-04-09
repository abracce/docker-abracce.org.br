/*!
 * jQuery kraken plugin
 * Author: Fernando Moreira <f@nandomoreira.me>
 * Licensed under the MIT license
 */
;(function ( $, window, document, undefined ) {

	var pluginName = "kraken",
	defaults = {
		masks : false,
		dateCls : '.mask-date',
		phoneCls : '.mask-phone',
		zipcodeCls : '.mask-zipcode',
		siteCls : '.mask-site',

		totop : false,
		totopCls : '.gototop',
		totopSpeed : 1000,
		totopEasing : 'easeOutQuart',

		tips : false,
		tipsCls : '.tips',

		dropdown : false,
		dropdownCls : '.navbar .dropdown',

		validate : false,
		validateCls : '.form',

		NProgress : false,
	};

    function Plugin( element, options ) {
		this.element   = element;
		this.settings  = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this._name     = pluginName;
		this.init();
    }

	$.extend(Plugin.prototype, {

		init: function () {

			// if masks is true
			if(this.settings.masks)
			{
				// enable Masks
				this.enableMasks();
			}

			// if totop is true
			if(this.settings.totop)
			{
				// enable ToTop
				this.enableToTop();
			}

			// if tips is true
			if(this.settings.tips)
			{
				// enable Tooltips
				this.enableTooltips();
			}

			// if dropdown is true
			if(this.settings.dropdown)
			{
				// enable Dropdown
				this.enableDropdown();
			}

			// if validate is true
			if(this.settings.validate)
			{
				// enable Validate
				this.enableValidate();
			}

			// if NProgress is true
			if(this.settings.NProgress)
			{
				// enable NProgress
				this.enableNProgress();
			}

		},

		enableMasks: function () {
			// date mask
			$(this.settings.dateCls).mask("99/99/9999");

			// zipcode mask
			$(this.settings.zipcodeCls).mask("99999-999");

			// phone mask
			$(this.settings.phoneCls).mask("(99) 9999-9999");

			// website mask
			$(this.settings.siteCls).focusin(function() {
				var _val = $(this).val();
				if(_val == '') {
					$(this).val('http://');
				}
				return false;
			})
			.focusout(function() {
				var _val = $(this).val();
				if(_val == 'http://') {
					$(this).val('');
				}
				return false;
			});
		},

		enableTooltips: function () {
		    // Bootstrap tooltip
		    $(this.settings.tipsCls).tooltip();
		},

		enableDropdown: function () {

			// if not touch
			if (!Modernizr.touch)
			{
			    /* bootstrap navbar on hover */
			    $(this.settings.dropdownCls).hover(function()
			    {
			        $(this).addClass('open');
			        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
			    },
			    function()
			    {
			        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(100);
			        $(this).removeClass('open');
			    });
		    }

		},

		enableToTop: function() {
		    var goToTop     = $(this.settings.totopCls),
				totopEasing = this.settings.totopEasing,
				totopSpeed  = this.settings.totopSpeed;

		    $(window).scroll(function () {
		        if ($(this).scrollTop() > 120) {
		            goToTop.css({ 'bottom' : '0' });
		        }
		        else
		        {
		            goToTop.css({ 'bottom' : '-50px' });
		        }
			});

		    goToTop.on('click', 'a', function(e) {
		        e.preventDefault();
		        $('html,body').animate({ scrollTop: 0 }, totopSpeed, totopEasing );
		        return false;
		    });

		},

		enableValidate: function() {
			$(this.settings.validateCls).validate();
		},

		enableNProgress: function() {
			NProgress.start();
			$(window).load(function() {
				NProgress.done();
			});
		},
	});

	$.fn[pluginName] = function ( options ) {
		this.each(function() {
			if (!$.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName, new Plugin( this, options));
			}
		});
		return this;
	};

})( jQuery, window, document );
