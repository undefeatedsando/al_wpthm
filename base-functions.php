<?php
/*
 * This is standard functions
 * 
 * If you want to create a new theme, do a search and replace on the theme 
 * folder. Search for: 'webfish_angler', 'webfish_theme_angler'
 * 
 * version 2.3.1
 */

/*
 * Include the required files
*/
// page settings sections & fields
require_once('theme-admin-options.php');

add_action('widgets_init','webfish_angler_footerWidgetInit');
add_action('after_setup_theme','webfish_angler_baseSetup',15);
add_action('wp_enqueue_scripts','webfish_angler_enqueueScripts');
add_action('wp_enqueue_scripts','webfish_angler_enqueueSyles');


function webfish_angler_baseSetup(){	
	//load translations
	load_theme_textdomain( 'webfish_theme_angler', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
	//add css to the TinyMCE editor
	add_editor_style('css/theme_appearance.css');

	
	if(WEBFISH_USE_THUMBNAILS){
		//This theme uses post thumbnails. Don't forget to do something fun with these
		add_theme_support( 'post-thumbnails' );
	}
	
	if(WEBFISH_CUSTOM_HEADER){
		if ( is_wp_version( '3.4' ) )
			add_theme_support( 'custom-header', array(
					'wp-head-callback'       => 'webfish_angler_headerStyle',
					'admin-head-callback'    => 'webfish_angler_headerStyleAdmin',)
			);
		else
			add_custom_image_header('webfish_angler_headerStyle', 'webfish_angler_headerStyleAdmin');

	}
}

/**
 * Register the footer sidebars
 */
function webfish_angler_footerWidgetInit(){
	for($i=1;$i<=WEBFISH_SIDEBARS_IN_FOOTER;$i++){
		webfish_angler_registerSidebars(array(
			'Footer'.$i=>__("Sidebar in footer", 'webfish_theme_angler'),
		));
	
	}
}



/**
 * a register sidebar simplyfier
 * @param array $sidebar as name=>description
 */
function webfish_angler_registerSidebars(array $sidebars){
	foreach($sidebars as $name=>$description){
		register_sidebar(array(
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'before_title' => '<h5 class="widgettitle">',
			'after_title' => '</h5>',
			'after_widget' => '</li>',
			'name' =>$name,
	        'id' => $name,
	        'description' => $description   
		));
	}
}


/**
 * The styles should be enqueued here
 */
function webfish_angler_enqueueSyles(){
	if(is_admin()){//if admin page
		//register styles
		wp_register_style('webfish_angler_webfishStyleAdmin', get_template_directory_uri().'/css/admin.css');
		
		wp_enqueue_style("webfish_angler_webfishStyleAdmin");
		
	}
	else{//if not admin page
	
		//register styles
		wp_register_style("webfish_angler_reset", get_template_directory_uri().'/css/reset.css');
		wp_register_style("webfish_angler_wordpress", get_template_directory_uri().'/css/wordpress.css');
		wp_register_style("webfish_angler_theme_design", get_template_directory_uri().'/css/theme_design.css');
		wp_register_style("webfish_angler_theme_appearance", get_template_directory_uri().'/css/theme_appearance.css');
		wp_register_style("webfish_angler_print", get_template_directory_uri().'/css/print.css');
		wp_register_style("webfish_angler_menu", get_template_directory_uri().'/css/menuStyle.css');
		
		
		
		//enqueue styles
		wp_enqueue_style("webfish_angler_reset");
		wp_enqueue_style("webfish_angler_default");
		wp_enqueue_style("webfish_angler_wordpress");
		wp_enqueue_style("webfish_angler_theme_design");
		wp_enqueue_style("webfish_angler_theme_appearance");
		wp_enqueue_style("webfish_angler_print");
		wp_enqueue_style("webfish_angler_fonts");
		wp_enqueue_style("webfish_angler_menu");
	
		if(is_user_logged_in()){
			//enqueue styles
			wp_register_style("webfish_angler_user", get_template_directory_uri().'/css/user.css');
				
			wp_enqueue_style("webfish_angler_user");
		}
	}
}

/**
* The scripts should be enqueued here
*/
function webfish_angler_enqueueScripts(){
	if(is_admin()){
		
	}
	else{//not admin page
		wp_register_script("webfish_default",get_template_directory_uri()."/js/default.js", array("jquery"), false, true);
		
		wp_enqueue_script("webfish_default");
		
		if( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		
	}
}



/**
 * gets included in the site header
 */ 
function webfish_angler_headerStyle() {
	?>
	<style type="text/css">
	#<?php echo WEBFISH_COSTOM_HEADER_ID; ?> {
		background: url(<?php header_image();?>);
		
	}
	#<?php echo WEBFISH_COSTOM_HEADER_ID; ?>, #<?php echo WEBFISH_COSTOM_HEADER_ID; ?> a{
		color: #<?php header_textcolor();?>;
	}
	</style>
	<?php
}

function webfish_angler_headerStyleAdmin(){
	//no style to add to the admin page
}


/**
 *
 * A simple search form. No nonce is needed because its a GET form.
 */
function webfish_angler_getSearchForm(){
	//Get the search text and escape it because it may be untrusted
	$text=esc_attr(__('Search','webfish_theme_angler'));
	?>
	<div id="search">
		<form id="searchform" action="" method="GET">
			<input name="s" type="text" id="s" placeholder="<?php echo $text;?>" results="5" />
		</form>
	</div>
	<?php 
}



/*
 * From here is just admin stuff. You dont need to declare those for every user
 */
add_action('admin_init','webfish_angler_themeActivation',1);
add_action('admin_menu', 'webfish_angler_adminMenu');


/*
 * Add custom header funtionality. 
 */
function webfish_angler_adminMenu() {
	$page=array();
	
  	//Add some submenus
  	//parent, title, link, rights, url, function
  	$page[]=add_theme_page('Webfish Options', 'Webfish Options','edit_theme_options','webfish-options', 'webfish_angler_adminOptionsPage');	
  		
  	foreach($page as $p){
  		add_action("load-$p", 'webfish_angler_adminLoad');
  	}
}

	

/**
 * Load style on 
 */
function webfish_angler_adminLoad(){
	wp_enqueue_style('webfish_angler_webfishStyleAdmin');
}

/**
 * Load defualt settings when theme is beeing activated
 */
function webfish_angler_themeActivation(){
	global $pagenow;
	if (isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
		add_option('webfish_angler_options', webfish_angler_getDefaultOptions(),'','yes');
	}
}

/**
 * Collects our theme options
 *
 * @return array
 */
function webfish_angler_getGlobalOptions(){

	$webfish_settings = array();

	$webfish_settings  = get_option('webfish_angler_options');

	return $webfish_settings;
}

/**
 * Call the function and collect in variable
 *
 * Should be used in template files like this:
 * <?php echo $webfish_settings['webfish_angler_txt_input']; ?>
 *
 * Note: Should you notice that the variable ($webfish_settings) is empty when used in certain templates such as header.php, sidebar.php and footer.php
 * you will need to call the function (copy the line below and paste it) at the top of those documents (within php tags)!
 */
$webfish_settings = webfish_angler_getGlobalOptions();
