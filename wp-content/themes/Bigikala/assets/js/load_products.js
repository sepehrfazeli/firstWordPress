    //milti_cat_vc ajax func
jQuery(document).on( 'click', '.multicat_list a', function( event ) {
     event.preventDefault();
     var term_id = jQuery(this).attr('data-term');
		    data = {
			'action': 'load_products',
		};
 
		jQuery.ajax({
			url : load_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
	beforeSend: function() {
		//jQuery('.content-box-shop').html('');
		//jQuery('.content-box-shop').append( '<div class="page-modal"><div class="page-content" id="loader"><img alt="site-logo" class="site-logo" src="'+main_params.lurl+'"><div class="c-remodal-loader__bullets"><i class="c-remodal-loader__bullet c-remodal-loader__bullet--1"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--2"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--3"></i><i class="c-remodal-loader__bullet c-remodal-loader__bullet--4"></i></div></div></div><div class="clearfix"></div>' );
	},
	success: function( html ) {
	    alert(html);
		//jQuery('.page-modal').remove();
		//jQuery('.content-box-shop').append( html );
	}
	});
});