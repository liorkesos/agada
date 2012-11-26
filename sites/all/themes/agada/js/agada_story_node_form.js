
 (function($) {
$(document).ready(function(){
						   
		if($("#edit-field-type-und-2").attr("checked")) ShowElements();
		
		$("#edit-field-type-und-1").click(function(){
				$("#edit-field-users-version").hide();
				$("#field-about-story-add-more-wrapper").hide();
				$("#field-external-link-values").hide();
				$("#field-bibliography-values").hide();
				$("#tabledrag-toggle-weight-wrapper").hide();
				$("#edit-field-agada-story-image").hide();
				
				$("#node_agada_story_form_group_agada_sources_form").hide();
				$("#field-agada-story-image-und-0-field-agada-image-description-add-more-wrapper").hide();								   
			});
		$("#edit-field-type-und-2").click(function(){				
				ShowElements();				
			;})
		
	}); 

function ShowElements(){
	$("#edit-field-users-version").show();
	$("#field-about-story-add-more-wrapper").show();
	$("#field-external-link-values").show();
	$("#field-bibliography-values").show();
	$("#node_agada_story_form_group_agada_sources_form").show();
	$("#tabledrag-toggle-weight-wrapper").show();
	$("#edit-field-agada-story-image").show();
	$("#field-agada-story-image-und-0-field-agada-image-description-add-more-wrapper").show();
	}

})(jQuery);