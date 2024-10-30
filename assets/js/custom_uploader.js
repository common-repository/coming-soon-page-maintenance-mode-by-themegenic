	jQuery(document).ready(function() {
		//var formfield;
		var file_frame;		
		var wrapper = jQuery('.field_wrapper'); //Input field wrapper
		jQuery(wrapper).on('click', '.upload_image_button', function(e){ //Once remove button is clicked
			e.preventDefault();
			var formfield = jQuery(this).next().attr('id');	
			
			
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			  title: jQuery( this ).data( 'uploader_title' ),
			  button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
			  },
			  multiple: false  // Set to true to allow multiple files to be selected
			});

			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
			  // We set multiple to false so only get one image from the uploader
			  attachment = file_frame.state().get('selection').first().toJSON();

			  // Do something with attachment.id and/or attachment.url here
			});

			// Finally, open the modal
			file_frame.open();

					
			
			
		  file_frame.on( 'select', function() {
			
			var selection = file_frame.state().get('selection');

			selection.map( function( attachment ) {

			  attachment = attachment.toJSON();
			  //alert(jQuery('html').find('#'+formfield).val()) ;
			  jQuery('html').find('#'+formfield).val(attachment.url);
			  // Do something with attachment.id and/or attachment.url here
			});
		  });
			
			
		});
		
		
	});
	
	