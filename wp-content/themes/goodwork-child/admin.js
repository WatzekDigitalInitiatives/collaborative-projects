jQuery(document).ready(function() {
    
	jQuery("[name='wdi_test_text[]']").attr("placeholder", "<a href=\'URL\'>LINKTEXT</a>");
	jQuery("[name='wdi_test_text[]']").attr("size", "50");
    jQuery("[name='wdi_research_question']").attr("placeholder", "Enter your research question here (140 characters or less)");
    jQuery("[id='excerpt']").attr("placeholder", "Enter an abbreviated version of your abstract to display as the Latest Post on this site's home page."); 
	
	//limits research question to 140 characters
	jQuery("[id='wdi_research_question']").attr("maxlength", 140);

   // jQuery( "a.wpb_switch-to-composer" ).trigger("click");
   
   
   //var abst=jQuery("#wdi_project_abstract").text();

   //if (abst.length==0){jQuery("#wdi_project_abstract").text("Project Abstract: Enter your abstract here (150 - 250 words)");}
   
   
  // jQuery("#wdi_canvas").text("");
   
   //jQuery("#wdi_project_link1").text("");
   


    
});


