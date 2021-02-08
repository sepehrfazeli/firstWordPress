jQuery(function($){
	/*
	 * Select/Upload video(s) event
	 */
	$('body').on('click', '.youone_upload_video_button', function(e){
		e.preventDefault();
 
    		var button = $(this),
    		    custom_uploader = wp.media({
			title: 'Insert video',
			library : {
				// uncomment the next line if you want to attach video to the current post
				// uploadedTo : wp.media.view.settings.post.id, 
				type : 'video'
			},
			button: {
				text: 'Use this video' // button label text
			},
			multiple: false // for multiple video selection set to true
		}).on('select', function() { // it also has "open" and "close" events 
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$(button).removeClass('button').html('<video width="100%" controls><source class="true_pre_video" src="' + attachment.url + '" style="max-width:95%;display:block;" /></video>').next().val(attachment.id).next().show();
			/* if you sen multiple to true, here is some code for getting the video IDs
			var attachments = frame.state().get('selection'),
			    attachment_ids = new Array(),
			    i = 0;
			attachments.each(function(attachment) {
 				attachment_ids[i] = attachment['id'];
				console.log( attachment );
				i++;
			});
			*/
		})
		.open();
	});
 
	/*
	 * Remove video event
	 */
	$('body').on('click', '.youone_remove_video_button', function(){
		$(this).hide().prev().val('').prev().addClass('button').html('Upload video');
		return false;
	});
 
});