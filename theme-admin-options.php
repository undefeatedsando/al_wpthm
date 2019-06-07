<?php 
/**
 * This file controlls the admin setting page
 * 
 * @version 1.0
 */
add_action( 'admin_init', 'webfish_angler_adminRegisterSettings' );
add_action('admin_notices', 'webfish_angler_adminMsgs');




/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function webfish_angler_adminOptionsPageSections() {

	$sections = array();
	$sections['general_section']    = __('General options', 'webfish_theme_angler');
	if(WEBFISH_USE_THUMBNAILS):
		$sections['thumbnail_section']    = __('Thumbnails', 'webfish_theme_angler');
	endif;//WEBFISH_USE_THUMBNAILS
	
	$sections['comments_section']     = __('Comments', 'webfish_theme_angler');

	return $sections;
}


/**
 * Define our form fields (settings)
 *
 * @return array
 */
function webfish_angler_adminOptionsPageFields() {
	// Text Form Fields section
	$options[] = array(
			"section" => "general_section",
			"id"      => "show-logo",
			"title"   => __( 'Show logo', 'webfish_theme_angler' ),
			"desc"    => __( 'Show Webfish logo in footer', 'webfish_theme_angler' ),
			"type"    => "checkbox",
			"std"     => 1 // 0 for off
	);
	
	$options[] = array(
			"section" => "general_section",
			"id"      => "show_single_meta",
			"title"   => __( 'Show single metadata', 'webfish_theme_angler' ),
			"desc"    => __( 'Show metadata on single entries', 'webfish_theme_angler' ),
			"type"    => "checkbox",
			"std"     => 0 // 0 for off
	);
	
	$options[] = array(
			"section" => "general_section",
			"id"      => "show_authors",
			"title"   => __( 'Show authors', 'webfish_theme_angler' ),
			"desc"    => __( 'Show the posts\'s author', 'webfish_theme_angler' ),
			"type"    => "checkbox",
			"std"     => 0 // 0 for off
	);
	
	if(WEBFISH_USE_THUMBNAILS):
		$options[] = array(
				"section" => "thumbnail_section",
				"id"      => "thumbnails_indexpage",
				"title"   => __( 'Show on index page', 'webfish_theme_angler' ),
				"desc"    => '',
				"type"    => "checkbox",
				"std"     => 1 // 0 for off
		);
	
		$options[] = array(
				"section" => "thumbnail_section",
				"id"      => "thumbnails_single",
				"title"   => __( 'Show on single', 'webfish_theme_angler' ),
				"desc"    => '',
				"type"    => "checkbox",
				"std"     => 1 // 0 for off
		);
		
		$options[] = array(
				"section" => "thumbnail_section",
				"id"      => "thumbnails_page",
				"title"   => __( 'Show on page', 'webfish_theme_angler' ),
				"desc"    => '',
				"type"    => "checkbox",
				"std"     => 1 // 0 for off
		);
	endif;//WEBFISH_USE_THUMBNAILS
	
	$options[] = array(
			"section" => "comments_section",
			"id"      => "show_allowed_tags",
			"title"   => __( 'Show allowed tags', 'webfish_theme_angler' ),
			"desc"    => '',
			"type"    => "checkbox",
			"std"     => 1 // 0 for off
	);
	
	$options[] = array(
			"section" => "comments_section",
			"id"      => "show_comments_closed",
			"title"   => __( 'Show "Comments are closed"', 'webfish_theme_angler' ),
			"desc"    => '',
			"type"    => "checkbox",
			"std"     => 1 // 0 for off
	);
	
	// Available options
	/*
	$options[] = array(
			"section" => "txt_section",
			"id"      => "txt_input",
			"title"   => __( 'Text Input - Some HTML OK!', 'webfish_theme_angler' ),
			"desc"    => __( 'A regular text input field. Some inline HTML (&lt;a>, &lt;b>, &lt;em>, &lt;i>, &lt;strong>) is allowed.', 'webfish_theme_angler' ),
			"type"    => "text",
			"std"     => __('Some default value','webfish_theme_angler')
	);

	$options[] = array(
			"section" => "txt_section",
			"id"      => "nohtml_txt_input",
			"title"   => __( 'No HTML!', 'webfish_theme_angler' ),
			"desc"    => __( 'A text input field where no html input is allowed.', 'webfish_theme_angler' ),
			"type"    => "text",
			"std"     => __('Some default value','webfish_theme_angler'),
			"class"   => "nohtml"
	);

	$options[] = array(
			"section" => "txt_section",
			"id"      => "numeric_txt_input",
			"title"   => __( 'Numeric Input', 'webfish_theme_angler' ),
			"desc"    => __( 'A text input field where only numeric input is allowed.', 'webfish_theme_angler' ),
			"type"    => "text",
			"std"     => "123",
			"class"   => "numeric"
	);

	$options[] = array(
			"section" => "txt_section",
			"id"      => "multinumeric_txt_input",
			"title"   => __( 'Multinumeric Input', 'webfish_theme_angler' ),
			"desc"    => __( 'A text input field where only multible numeric input (i.e. comma separated numeric values) is allowed.', 'webfish_theme_angler' ),
			"type"    => "text",
			"std"     => "123,234,345",
			"class"   => "multinumeric"
	);

	$options[] = array(
			"section" => "txt_section",
			"id"      => "url_txt_input",
			"title"   => __( 'URL Input', 'webfish_theme_angler' ),
			"desc"    => __( 'A text input field which can be used for urls.', 'webfish_theme_angler' ),
			"type"    => "text",
			"std"     => "http://wp.tutsplus.com",
			"class"   => "url"
	);

	$options[] = array(
			"section" => "txt_section",
			"id"      => "email_txt_input",
			"title"   => __( 'Email Input', 'webfish_theme_angler' ),
			"desc"    => __( 'A text input field which can be used for email input.', 'webfish_theme_angler' ),
			"type"    => "text",
			"std"     => "email@email.com",
			"class"   => "email"
	);

	$options[] = array(
			"section" => "txt_section",
			"id"      => "multi_txt_input",
			"title"   => __( 'Multi-Text Inputs', 'webfish_theme_angler' ),
			"desc"    => __( 'A group of text input fields', 'webfish_theme_angler' ),
			"type"    => "multi-text",
			"choices" => array( __('Text input 1','webfish_theme_angler') . "|txt_input1", __('Text input 2','webfish_theme_angler') . "|txt_input2", __('Text input 3','webfish_theme_angler') . "|txt_input3", __('Text input 4','webfish_theme_angler') . "|txt_input4"),
			"std"     => ""
	);

	// Textarea Form Fields section
	$options[] = array(
			"section" => "txtarea_section",
			"id"      => "txtarea_input",
			"title"   => __( 'Textarea - HTML OK!', 'webfish_theme_angler' ),
			"desc"    => __( 'A textarea for a block of text. HTML tags allowed!', 'webfish_theme_angler' ),
			"type"    => "textarea",
			"std"     => __('Some default value','webfish_theme_angler')
	);

	$options[] = array(
			"section" => "txtarea_section",
			"id"      => "nohtml_txtarea_input",
			"title"   => __( 'No HTML!', 'webfish_theme_angler' ),
			"desc"    => __( 'A textarea for a block of text. No HTML!', 'webfish_theme_angler' ),
			"type"    => "textarea",
			"std"     => __('Some default value','webfish_theme_angler'),
			"class"   => "nohtml"
	);

	$options[] = array(
			"section" => "txtarea_section",
			"id"      => "allowlinebreaks_txtarea_input",
			"title"   => __( 'No HTML! Line breaks OK!', 'webfish_theme_angler' ),
			"desc"    => __( 'No HTML! Line breaks allowed!', 'webfish_theme_angler' ),
			"type"    => "textarea",
			"std"     => __('Some default value','webfish_theme_angler'),
			"class"   => "allowlinebreaks"
	);

	$options[] = array(
			"section" => "txtarea_section",
			"id"      => "inlinehtml_txtarea_input",
			"title"   => __( 'Some Inline HTML ONLY!', 'webfish_theme_angler' ),
			"desc"    => __( 'A textarea for a block of text.
					Only some inline HTML
					(&lt;a>, &lt;b>, &lt;em>, &lt;strong>, &lt;abbr>, &lt;acronym>, &lt;blockquote>, &lt;cite>, &lt;code>, &lt;del>, &lt;q>, &lt;strike>)
					is allowed!', 'webfish_theme_angler' ),
			"type"    => "textarea",
			"std"     => __('Some default value','webfish_theme_angler'),
			"class"   => "inlinehtml"
	);

	// Select Form Fields section
	$options[] = array(
			"section" => "select_section",
			"id"      => "select_input",
			"title"   => __( 'Select (type one)', 'webfish_theme_angler' ),
			"desc"    => __( 'A regular select form field', 'webfish_theme_angler' ),
			"type"    => "select",
			"std"    => "3",
			"choices" => array( "1", "2", "3")
	);

	$options[] = array(
			"section" => "select_section",
			"id"      => "select2_input",
			"title"   => __( 'Select (type two)', 'webfish_theme_angler' ),
			"desc"    => __( 'A select field with a label for the option and a corresponding value.', 'webfish_theme_angler' ),
			"type"    => "select2",
			"std"    => "",
			"choices" => array( __('Option 1','webfish_theme_angler') . "|opt1", __('Option 2','webfish_theme_angler') . "|opt2", __('Option 3','webfish_theme_angler') . "|opt3", __('Option 4','webfish_theme_angler') . "|opt4")
	);

	// Checkbox Form Fields section
	$options[] = array(
			"section" => "checkbox_section",
			"id"      => "checkbox_input",
			"title"   => __( 'Checkbox', 'webfish_theme_angler' ),
			"desc"    => __( 'Some Description', 'webfish_theme_angler' ),
			"type"    => "checkbox",
			"std"     => 1 // 0 for off
	);

	$options[] = array(
			"section" => "checkbox_section",
			"id"      => "multicheckbox_inputs",
			"title"   => __( 'Multi-Checkbox', 'webfish_theme_angler' ),
			"desc"    => __( 'Some Description', 'webfish_theme_angler' ),
			"type"    => "multi-checkbox",
			"std"     => '',
			"choices" => array( __('Checkbox 1','webfish_theme_angler') . "|chckbx1", __('Checkbox 2','webfish_theme_angler') . "|chckbx2", __('Checkbox 3','webfish_theme_angler') . "|chckbx3", __('Checkbox 4','webfish_theme_angler') . "|chckbx4")
	);
*/
	return $options;
}




	

/**
 * Helper function for defining variables for the current page
 *
 * @return array
 */
function webfish_angler_adminPageSettings() {

	$output = array();

	// put together the output array
	$output['webfish_angler_option_name']       = 'webfish_angler_options'; // the option name as used in the get_option() call.
	$output['webfish_angler_page_title']        = 'Webfish Options'; // the settings page title
	$output['webfish_angler_page_sections']     = webfish_angler_adminOptionsPageSections(); // the setting section
	$output['webfish_angler_page_fields']       = webfish_angler_adminOptionsPageFields(); // the setting fields
	$output['webfish_angler_contextual_help']   = ''; // the contextual help

	return $output;
}

/**
 * Helper function for registering our form field settings
 *
 * src: http://alisothegeek.com/2011/01/wordpress-settings-api-tutorial-1/
 * @param (array) $args The array of arguments to be used in creating the field
 * @return function call
 */
function webfish_angler_createSettingsField( $args = array() ) {
	// default array to overwrite when calling the function
	$defaults = array(
			'id'      => 'default_field',                    // the ID of the setting in our options array, and the ID of the HTML form element
			'title'   => 'Default Field',                    // the label for the HTML form element
			'desc'    => 'This is a default description.',  // the description displayed under the HTML form element
			'std'     => '',                                 // the default value for this setting
			'type'    => 'text',                             // the HTML form element to use
			'section' => 'main_section',                     // the section this setting belongs to — must match the array key of a section in webfish_angler_adminOptionsPageSections()
			'choices' => array(),                            // (optional): the values in radio buttons or a drop-down menu
			'class'   => ''                                  // the HTML form element class. Also used for validation purposes!
	);

	// "extract" to be able to use the array keys as variables in our function output below
	extract( wp_parse_args( $args, $defaults ) );

	// additional arguments for use in form field output in the function webfish_angler_formFieldFn!
	$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
	);

	add_settings_field( $id, $title, 'webfish_angler_formFieldFn', __FILE__, $section, $field_args );

}

/*
 * Register our setting
*/
function webfish_angler_adminRegisterSettings(){

	// get the settings sections array
	$settings_output    = webfish_angler_adminPageSettings();
	$option_name = $settings_output['webfish_angler_option_name'];

	//setting
	//register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting($option_name, $option_name, 'webfish_angler_adminValidateOptions' );

	//sections
	// add_settings_section( $id, $title, $callback, $page );
	if(!empty($settings_output['webfish_angler_page_sections'])){
		// call the "add_settings_section" for each!
		foreach ( $settings_output['webfish_angler_page_sections'] as $id => $title ) {
			add_settings_section( $id, $title, 'webfish_angler_adminSectionFn', __FILE__);
		}
	}
	
	//fields
	if(!empty($settings_output['webfish_angler_page_fields'])){
		// call the "add_settings_field" for each!
		foreach ($settings_output['webfish_angler_page_fields'] as $option) {
			webfish_angler_createSettingsField($option);
		}
	}
}


/*
 * Section HTML, displayed before the first option
* @return echoes output
*/
function  webfish_angler_adminSectionFn($desc) {
	//echo "<p>" . __('Settings for this section','webfish_theme_angler') . "</p>";
}

/**
 * Helper function for creating admin messages
 * src: http://www.wprecipes.com/how-to-show-an-urgent-message-in-the-wordpress-admin-area
 *
 * @param (string) $message The message to echo
 * @param (string) $msgclass The message class
 * @return echoes the message
 */
function webfish_angler_showMsg($message, $msgclass = 'info') {
	echo "<div id='message' class='$msgclass'>$message</div>";
}

/**
 * Callback function for displaying admin messages
 *
 * @return calls webfish_angler_showMsg()
 */
function webfish_angler_adminMsgs() {

	// check for our settings page - need this in conditional further down
	$settings_pg=(isset($_GET['page']))?strpos($_GET['page'], 'webfish-options'):FALSE;

	// collect setting errors/notices: //http://codex.wordpress.org/Function_Reference/get_settings_errors
	$set_errors = get_settings_errors();

	//display admin message only for the admin to see, only on our settings page and only when setting errors/notices are returned!
	if(current_user_can ('manage_options') && $settings_pg !== FALSE && !empty($set_errors)){

		// have our settings succesfully been updated?
		if($set_errors[0]['code'] == 'settings_updated' && isset($_GET['settings-updated'])){
			webfish_angler_showMsg("<p>" . $set_errors[0]['message'] . "</p>", 'updated');

			// have errors been found?
		}else{
			// there maybe more than one so run a foreach loop.
			foreach($set_errors as $set_error){
				// set the title attribute to match the error "setting title" - need this in js file
				webfish_angler_showMsg("<p class='setting-error-message' title='" . $set_error['setting'] . "'>" . $set_error['message'] . "</p>", 'error');
			}
		}
	}
}


/*
 * Validate input
*
* @return array
*/
function webfish_angler_adminValidateOptions($input) {

 
    // for enhanced security, create a new empty array  
    $valid_input = array();  
  
    // collect only the values we expect and fill the new $valid_input array i.e. whitelist our option IDs  
  
        // get the settings sections array  
        $settings_output = webfish_angler_adminPageSettings();  
  
        $options = $settings_output['webfish_angler_page_fields'];  
  
        // run a foreach and switch on option type  
        foreach ($options as $option) {  
  
            switch ( $option['type'] ) {  
                case 'text':  
                    //switch validation based on the class!  
                    switch ( $option['class'] ) {  
                        //for numeric  
                        case 'numeric':  
                            //accept the input only when numeric!  
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace  
                            $valid_input[$option['id']] = (is_numeric($input[$option['id']])) ? $input[$option['id']] : 'Expecting a Numeric value!';  
  
                            // register error  
                            if(is_numeric($input[$option['id']]) == FALSE) {  
                                add_settings_error(  
                                    $option['id'], // setting title  
                                    'txt_numeric_error', // error ID  
                                    __('Expecting a Numeric value! Please fix.','webfish_theme_angler'), // error message  
                                    'error' // type of message  
                                );  
                            }  
                        break;  
  
                        //for multi-numeric values (separated by a comma)  
                        case 'multinumeric':  
                            //accept the input only when the numeric values are comma separated  
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace  
  
                            if($input[$option['id']] !=''){  
                                // /^-?\d+(?:,\s?-?\d+)*$/ matches: -1 | 1 | -12,-23 | 12,23 | -123, -234 | 123, 234  | etc.  
                                $valid_input[$option['id']] = (preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) == 1) ? $input[$option['id']] : __('Expecting comma separated numeric values','webfish_theme_angler');  
                            }else{  
                                $valid_input[$option['id']] = $input[$option['id']];  
                            }  
  
                            // register error  
                            if($input[$option['id']] !='' && preg_match('/^-?\d+(?:,\s?-?\d+)*$/', $input[$option['id']]) != 1) {  
                                add_settings_error(  
                                    $option['id'], // setting title  
                                    'txt_multinumeric_error', // error ID  
                                    __('Expecting comma separated numeric values! Please fix.','webfish_theme_angler'), // error message  
                                    'error' // type of message  
                                );  
                            }  
                        break;  
  
                        //for no html  
                        case 'nohtml':  
                            //accept the input only after stripping out all html, extra white space etc!  
                            $input[$option['id']]       = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database  
                            $valid_input[$option['id']] = addslashes($input[$option['id']]);  
                        break;  
  
                        //for url  
                        case 'url':  
                            //accept the input only when the url has been sanited for database usage with esc_url_raw()  
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace  
                            $valid_input[$option['id']] = esc_url_raw($input[$option['id']]);  
                        break;  
  
                        //for email  
                        case 'email':  
                            //accept the input only after the email has been validated  
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace  
                            if($input[$option['id']] != ''){  
                                $valid_input[$option['id']] = (is_email($input[$option['id']])!== FALSE) ? $input[$option['id']] : __('Invalid email! Please re-enter!','webfish_theme_angler');  
                            }elseif($input[$option['id']] == ''){  
                                $valid_input[$option['id']] = __('This setting field cannot be empty! Please enter a valid email address.','webfish_theme_angler');  
                            }  
  
                            // register error  
                            if(is_email($input[$option['id']])== FALSE || $input[$option['id']] == '') {  
                                add_settings_error(  
                                    $option['id'], // setting title  
                                    'txt_email_error', // error ID  
                                    __('Please enter a valid email address.','webfish_theme_angler'), // error message  
                                    'error' // type of message  
                                );  
                            }  
                        break;  
  
                        // a "cover-all" fall-back when the class argument is not set  
                        default:  
                            // accept only a few inline html elements  
                            $allowed_html = array(  
                                'a' => array('href' => array (),'title' => array ()),  
                                'b' => array(),  
                                'em' => array (),  
                                'i' => array (),  
                                'strong' => array()  
                            );  
  
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace  
                            $input[$option['id']]       = force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup  
                            $input[$option['id']]       = wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database  
                            $valid_input[$option['id']] = addslashes($input[$option['id']]);  
                        break;  
                    }  
                break;  
  
                case "multi-text":  
                    // this will hold the text values as an array of 'key' => 'value'  
                    unset($textarray);  
  
                    $text_values = array();  
                    foreach ($option['choices'] as $k => $v ) {  
                        // explode the connective  
                        $pieces = explode("|", $v);  
  
                        $text_values[] = $pieces[1];  
                    }  
  
                    foreach ($text_values as $v ) {       
  
                        // Check that the option isn't empty  
                        if (!empty($input[$option['id'] . '|' . $v])) { 
                            // If it's not null, make sure it's sanitized, add it to an array 
                            switch ($option['class']) { 
                                // different sanitation actions based on the class create you own cases as you need them 
 
                                //for numeric input 
                                case 'numeric': 
                                    //accept the input only if is numberic! 
                                    $input[$option['id'] . '|' . $v]= trim($input[$option['id'] . '|' . $v]); // trim whitespace 
                                    $input[$option['id'] . '|' . $v]= (is_numeric($input[$option['id'] . '|' . $v])) ? $input[$option['id'] . '|' . $v] : ''; 
                                break; 
 
                                // a "cover-all" fall-back when the class argument is not set 
                                default: 
                                    // strip all html tags and white-space. 
                                    $input[$option['id'] . '|' . $v]= sanitize_text_field($input[$option['id'] . '|' . $v]); // need to add slashes still before sending to the database 
                                    $input[$option['id'] . '|' . $v]= addslashes($input[$option['id'] . '|' . $v]); 
                                break; 
                            } 
                            // pass the sanitized user input to our $textarray array 
                            $textarray[$v] = $input[$option['id'] . '|' . $v]; 
 
                        } else { 
                            $textarray[$v] = ''; 
                        } 
                    } 
                    // pass the non-empty $textarray to our $valid_input array 
                    if (!empty($textarray)) { 
                        $valid_input[$option['id']] = $textarray; 
                    } 
                break; 
 
                case 'textarea': 
                    //switch validation based on the class! 
                    switch ( $option['class'] ) { 
                        //for only inline html 
                        case 'inlinehtml': 
                            // accept only inline html 
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace 
                            $input[$option['id']]       = force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup 
                            $input[$option['id']]       = addslashes($input[$option['id']]); //wp_filter_kses expects content to be escaped! 
                            $valid_input[$option['id']] = wp_filter_kses($input[$option['id']]); //calls stripslashes then addslashes 
                        break; 
 
                        //for no html 
                        case 'nohtml': 
                            //accept the input only after stripping out all html, extra white space etc! 
                            $input[$option['id']]       = sanitize_text_field($input[$option['id']]); // need to add slashes still before sending to the database 
                            $valid_input[$option['id']] = addslashes($input[$option['id']]); 
                        break; 
 
                        //for allowlinebreaks 
                        case 'allowlinebreaks': 
                            //accept the input only after stripping out all html, extra white space etc! 
                            $input[$option['id']]       = wp_strip_all_tags($input[$option['id']]); // need to add slashes still before sending to the database 
                            $valid_input[$option['id']] = addslashes($input[$option['id']]); 
                        break; 
 
                        // a "cover-all" fall-back when the class argument is not set 
                        default: 
                            // accept only limited html 
                            //my allowed html 
                            $allowed_html = array( 
                                'a'             => array('href' => array (),'title' => array ()), 
                                'b'             => array(), 
                                'blockquote'    => array('cite' => array ()), 
                                'br'            => array(), 
                                'dd'            => array(), 
                                'dl'            => array(), 
                                'dt'            => array(), 
                                'em'            => array (), 
                                'i'             => array (), 
                                'li'            => array(), 
                                'ol'            => array(), 
                                'p'             => array(), 
                                'q'             => array('cite' => array ()), 
                                'strong'        => array(), 
                                'ul'            => array(), 
                                'h1'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()), 
                                'h2'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()), 
                                'h3'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()), 
                                'h4'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()), 
                                'h5'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()), 
                                'h6'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()) 
                            ); 
 
                            $input[$option['id']]       = trim($input[$option['id']]); // trim whitespace 
                            $input[$option['id']]       = force_balance_tags($input[$option['id']]); // find incorrectly nested or missing closing tags and fix markup 
                            $input[$option['id']]       = wp_kses( $input[$option['id']], $allowed_html); // need to add slashes still before sending to the database 
                            $valid_input[$option['id']] = addslashes($input[$option['id']]); 
                        break; 
                    } 
                break; 
 
                case 'select': 
                    // check to see if the selected value is in our approved array of values! 
                    $valid_input[$option['id']] = (in_array( $input[$option['id']], $option['choices']) ? $input[$option['id']] : '' ); 
                break; 
 
                case 'select2': 
                    // process $select_values 
                        $select_values = array(); 
                        foreach ($option['choices'] as $k => $v) { 
                            // explode the connective 
                            $pieces = explode("|", $v); 
 
                            $select_values[] = $pieces[1]; 
                        } 
                    // check to see if selected value is in our approved array of values! 
                    $valid_input[$option['id']] = (in_array( $input[$option['id']], $select_values) ? $input[$option['id']] : '' ); 
                break; 
 
                case 'checkbox': 
                    // if it's not set, default to null!  
                    if (!isset($input[$option['id']])) {  
                        $input[$option['id']] = null;  
                    }  
                    // Our checkbox value is either 0 or 1  
                    $valid_input[$option['id']] = ( $input[$option['id']] == 1 ? 1 : 0 );  
                break;  
  
                case 'multi-checkbox':  
                    unset($checkboxarray);  
                    $check_values = array();  
                    foreach ($option['choices'] as $k => $v ) {  
                        // explode the connective  
                        $pieces = explode("|", $v);  
  
                        $check_values[] = $pieces[1];  
                    }  
  
                    foreach ($check_values as $v ) {          
  
                        // Check that the option isn't null  
                        if (!empty($input[$option['id'] . '|' . $v])) { 
                            // If it's not null, make sure it's true, add it to an array 
                            $checkboxarray[$v] = 'true'; 
                        } 
                        else { 
                            $checkboxarray[$v] = 'false'; 
                        } 
                    } 
                    // Take all the items that were checked, and set them as the main option 
                    if (!empty($checkboxarray)) { 
                        $valid_input[$option['id']] = $checkboxarray;  
                    }  
                break;  
  
            }  
        }  
	return $valid_input; // return validated input  

}



/**
 *
 * Option page
 */
function webfish_angler_adminOptionsPage(){
	// get the settings sections array
	$settings_output = webfish_angler_adminPageSettings();
	?>
	    <div class="wrap">  
	        <div class="icon32" id="icon-options-general"></div>  
	        <h2><?php echo $settings_output['webfish_angler_page_title']; ?></h2>  
	  
	        <form action="options.php" method="post">  
	            <?php  
	            // http://codex.wordpress.org/Function_Reference/settings_fields  
	            settings_fields($settings_output['webfish_angler_option_name']);   
	  
	            // http://codex.wordpress.org/Function_Reference/do_settings_sections  
	            do_settings_sections(__FILE__);  
	            ?>  
	            <p class="submit">  
	                <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes','webfish_theme_angler'); ?>" />  
	            </p>  
	  
	        </form>  
	    </div><!-- wrap -->  
	<?php 
} 
	


/*
 * Form Fields HTML
* All form field types share the same function!!
* @return echoes output
*/
function webfish_angler_formFieldFn($args = array()) {

	extract( $args );

	// get the settings sections array
	$settings_output    = webfish_angler_adminPageSettings();

	$option_name = $settings_output['webfish_angler_option_name'];
	$options            = get_option($option_name);

	// pass the standard value if the option is not yet set in the database
	if ( !isset( $options[$id] ) && 'type' != 'checkbox' ) {
		$options[$id] = $std;
	}

	// additional field class. output only if the class is defined in the create_setting arguments
	$field_class = ($class != '') ? ' ' . $class : '';

	// switch html display based on the setting type.
	switch ( $type ) {
		case 'text':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_attr( $options[$id]);
			echo "<input class='regular-text$field_class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case "multi-text":
			foreach($choices as $item) {
				$item = explode("|",$item); // cat_name|cat_slug
				$item[0] = esc_html__($item[0], 'webfish_theme_angler');
				if (!empty($options[$id])) {
					foreach ($options[$id] as $option_key => $option_val){
						if ($item[1] == $option_key) {
							$value = $option_val;
						}
					}
				} else {
					$value = '';
				}
				echo "<span>$item[0]:</span> <input class='$field_class' type='text' id='$id|$item[1]' name='" . $option_name . "[$id|$item[1]]' value='$value' /><br/>";
			}
			echo ($desc != '') ? "<span class='description'>$desc</span>" : "";
			break;

		case 'textarea':
			$options[$id] = stripslashes($options[$id]);
			$options[$id] = esc_html( $options[$id]);
			echo "<textarea class='textarea$field_class' type='text' id='$id' name='" . $option_name . "[$id]' rows='5' cols='30'>$options[$id]</textarea>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case 'select':
			echo "<select id='$id' class='select$field_class' name='" . $option_name . "[$id]'>";
			foreach($choices as $item) {
				$value  = esc_attr($item, 'webfish_theme_angler');
				$item   = esc_html($item, 'webfish_theme_angler');

				$selected = ($options[$id]==$value) ? 'selected="selected"' : '';
				echo "<option value='$value' $selected>$item</option>";
			}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case 'select2':
			echo "<select id='$id' class='select$field_class' name='" . $option_name . "[$id]'>";
			foreach($choices as $item) {

				$item = explode("|",$item);
				$item[0] = esc_html($item[0], 'webfish_theme_angler');

				$selected = ($options[$id]==$item[1]) ? 'selected="selected"' : '';
				echo "<option value='$item[1]' $selected>$item[0]</option>";
			}
			echo "</select>";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case 'checkbox':
			echo "<input class='checkbox$field_class' type='checkbox' id='$id' name='" . $option_name . "[$id]' value='1' " . checked( $options[$id], 1, false ) . " />";
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;

		case "multi-checkbox":
			foreach($choices as $item) {

				$item = explode("|",$item);
				$item[0] = esc_html($item[0], 'webfish_theme_angler');

				$checked = '';

				if ( isset($options[$id][$item[1]]) ) {
					if ( $options[$id][$item[1]] == 'true') {
						$checked = 'checked="checked"';
					}
				}

				echo "<input class='checkbox$field_class' type='checkbox' id='$id|$item[1]' name='" . $option_name . "[$id|$item[1]]' value='1' $checked /> $item[0] <br/>";
			}
			echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";
			break;
	}
}


/**
 * get the default options
 */
function webfish_angler_getDefaultOptions(){
	$options=webfish_angler_adminOptionsPageFields();

	foreach ($options as $option){
		$ret[$option['id']]=$option['std'];
	}

	return $ret;
}