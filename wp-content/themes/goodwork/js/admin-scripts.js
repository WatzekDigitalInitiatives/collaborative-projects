var $ = jQuery.noConflict();
$(function(){

	if ( $('#setting_old_slider_helper').length > 0 && $('#postcustomstuff').find('input[value="old_video"]').length > 0 ) {

		$('#setting_old_slider_helper').find('.wide-desc').html('<em>' + htmlEntities($('#postcustomstuff').find('input[value="old_video"]').parent().parent().find('textarea').val()) + '</em>');

	}

	function htmlEntities(str) {
    	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace('&lt;br&gt;&lt;code&gt;', '<br><code>').replace('&lt;/code&gt;', '</code>');
	}

});  