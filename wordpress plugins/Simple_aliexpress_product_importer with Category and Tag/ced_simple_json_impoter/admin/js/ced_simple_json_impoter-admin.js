(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 var ajaxurl=ced_simple_importer_js.ajaxurl;

	 //  Simple import btn click aljax
		$(document).on('click','.ced_btn_pro_import',function(e){
			e.preventDefault();
			$(this).prop('disabled', true);
			$(this).html('please wait..');
			var product_id=$(this).val();
			$.ajax({
				url:ajaxurl,
				type:'post',
				data:{
					action:'product_import_ajax_request',
					product_id:product_id,
				},
				success:function(response){
					// alert(response);
					if(location.reload()){
						$(`#btn${product_id}`).prop('disabled', false);
						$(`#btn${product_id}`).html('Product Importer');
					}
				}
			});
	
		});


})( jQuery );
