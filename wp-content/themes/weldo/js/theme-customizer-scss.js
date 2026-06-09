'use strict';
(function ($, api) {

	api.bind('ready', function () {

		function getColorOptionValue(val) {
			//if not empty string
			if (val) {
				//hex code
				if (val.length === 7) {
					return val;
					//json string
				} else {
					return JSON.parse(val)[0].value;
				}
			}
			return val;
		}

		var previewWrap = document.getElementById('customize-preview');

		api('fw_options[accent_color_1]', function (value) {
			console.log(value);
			value.bind(function (newval) {
				//set style on iframe root element
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--colorMain', getColorOptionValue(newval));
			});
		});

		wp.customize('fw_options[accent_color_2]', function (value) {
			value.bind(function (newval) {
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--colorMain2', getColorOptionValue(newval));
			});
		});
		wp.customize('fw_options[darkgrey_color]', function (value) {
			value.bind(function (newval) {
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--darkgreyColor', getColorOptionValue(newval));
			});
		});
		wp.customize('fw_options[darkblue_color]', function (value) {
			value.bind(function (newval) {
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--darkBlueColor', getColorOptionValue(newval));
			});
		});
		wp.customize('fw_options[dark_color]', function (value) {
			value.bind(function (newval) {
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--darkColor', getColorOptionValue(newval));
			});
		});
		wp.customize('fw_options[grey_color]', function (value) {
			value.bind(function (newval) {
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--greyColor', getColorOptionValue(newval));
			});
		});
		wp.customize('fw_options[font_color]', function (value) {
			value.bind(function (newval) {
				previewWrap.firstChild.contentWindow.document.documentElement.style.setProperty('--fontColor', getColorOptionValue(newval));
			});
		});

	}); //api ready

})(jQuery, wp.customize);