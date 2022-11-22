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


	 var ajaxurl=ced_importer_js.ajaxurl;

//  Simple import btn click alax
	 $(document).on('click','.btn_ced',function(e){
		 e.preventDefault();
		//  alert('heloo');
        var product_id=$(this).val();
		$.ajax({
			url:ajaxurl,
			type:'post',
			data:{
				action:'admin_ajax_request',
				product_id:product_id,
				// product_data:product_data
			},
			success:function(response){
				// alert(response);
				location.reload(true);
			}
		});

	 });

//  Simple import btn click alax
	 $(document).on('click','.ced_btn_var_pro',function(e){
		e.preventDefault();
	   //  alert('heloo');
	   var variable_pro_id=$(this).val();
	   $.ajax({
		   url:ajaxurl,
		   type:'post',
		   data:{
			   action:'admin_ajax_variable_request',
			   product_id:variable_pro_id,
			   // product_data:product_data
		   },
		   success:function(response){
			//    alert(response);
			   location.reload(true);
		   }
	   });

	});


})( jQuery );
