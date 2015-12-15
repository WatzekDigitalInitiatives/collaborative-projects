/*var $ = jQuery.noConflict();
$(function(){

	tempI = setInterval(checkComposer, 100);
	function checkComposer(){
		if($('.wpb_element_wrapper').length > 0){
			clearInterval(tempI);
			initComposer();
		}
	}
	$composer = $('#visual_composer_content');

	function initComposer(){
		$composer.find('div.controls').addClass('clearfix');
		$composer.find('div.wpb_content_element').each(function(){

			var title = '';

			switch($(this).data('element_type')) {

				case 'vc_tagline':
					title = "Tagline";
					break;
				case 'vc_projects':
					title = "Latest Projects";
					break;
				case 'vc_posts':
					title = "Latest Posts";
					break;
				case 'vc_column_text':
					title = "Text Block";
					//$(this).find('.wpb_vc_param_value.content.textarea_html').hide(0);
					break;
				case 'vc_accordion':
					title = "Accordion";
					break;
					
			}

			$(this).children('div.wpb_element_wrapper ').append('<p class="wpb_element_rb_title">'  + title + '</p>');

		});
	}

}); */

$ = jQuery.noConflict();
jQuery(function(jQuery) {  

	//$('#slider_type_2').prop({'checked': 'checked'});
	//$('#slider_type_1').prop({'disabled': true});
	//$('#slider_type_3').prop({'disabled': true});


});  