( function( $) {
	$.wpMediaUploader = function( options ) {

		var settings = $.extend({

			target : '.user-custom_profile_image-wrap > td', // The class wrapping the textbox
			uploaderButton : 'Set', // the text of the button in the media upload popup
			multiple : false, // Allow the user to select multiple images
			previewSize : '96px', // The preview image size
			modal : false, // is the upload button within a bootstrap modal ?
		}, options );

		//adding buttons
		var $target = $( settings.target )

		$target.append( '<div><a href="#" class="dashicons-before dashicons-upload button custom_profile_image_button"></a><a href="#" class="dashicons-before dashicons-dismiss button custom_profile_image_remove"></a></div>' );
		//adding preview
		$target.append('<div><br><img src="#" style="display: none; width: ' + settings.previewSize + '"/></div>');

		var img_url = $target.find('input').val();
		if(img_url) {
			$target.find('img').attr('src', img_url).show();
		}

		//add image
		$('body').on('click', '.custom_profile_image_button', function(e) {
			e.preventDefault();
			var selector = $(this).closest(settings.target);
			var custom_uploader = wp.media({
				title: selector.parent().find('label').text(),
				button: {
					text: settings.uploaderButton
				},
				multiple: settings.multiple
			})
				.on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					selector.find( 'img' ).attr( 'src', attachment.url).show();
					selector.find( 'input' ).val(attachment.url);
					if( settings.modal ) {
						$('.modal').css( 'overflowY', 'auto');
					}
				})
				.open();
		//remove image
		}).on('click', '.custom_profile_image_remove', function(e) {
			e.preventDefault();
			var selector = $(this).closest(settings.target);
			selector.find( 'img' ).attr( 'src', '#').hide();
			selector.find( 'input' ).val('');
		});
	}
})(jQuery);

//init for custom image text box
jQuery( function() {
	jQuery.wpMediaUploader();
});