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
      
	var ajaxurl=cedcoss_meta.ajaxurl;
	 $(document).on('click','#btn_metaBox',function(e){
		 e.preventDefault();
        var metaID=$("#metadata1Id").val();
		var val1=$("#metadata1").val();
		// alert(val1);
		var postdata=`action=admin_ajax_request&val=${val1}&metaID=${metaID}`
		$.post(ajaxurl,postdata, function(response){
			alert(response);
		});
	 });


})( jQuery );
