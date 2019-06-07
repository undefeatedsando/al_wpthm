//Remove the text from the search form.
jQuery(document).ready(function() {
	var defaut_text=jQuery("#searchform #s").val();
	jQuery("#searchform input").focus(function(){
		if(jQuery("#searchform #s").val()==defaut_text)
			jQuery("#searchform #s").val("");
	});
});

