<?php
//include importent stuff
include_once "base-functions.php";

add_action('widgets_init','webfish_angler_widgetInit');
add_action('after_setup_theme','webfish_angler_setup');

/*
 * Define some constants. These are ment to be changed by the theme author, it is NOT sure your theme
 * supports any changes to these constants. Try at your own risk. =)
 */
function webfish_angler_setup(){
	//general
	define("WEBFISH_HEADER_INSIDE_WRAPPER",true);
	define("WEBFISH_COLUMNS_INDEX",2);
	define("WEBFISH_COLUMNS_SINGLE",2);
	define("WEBFISH_COLUMNS_PAGE",2);
	define("WEBFISH_COLUMNS_FRONT_PAGE",2);//only if frontpage is a static page
	define("WEBFISH_FOOTER_INSIDE_WRAPPER",true);
	
	//sidebar
	define("WEBFISH_SIDEBARS_IN_FOOTER",0);//these are created automaticly
	
	
	//header
	define('WEBFISH_CUSTOM_HEADER',true);
	define("WEBFISH_COSTOM_HEADER_ID","header");
	define('NO_HEADER_TEXT', false );//if true change HEADER_TEXTCOLOR to ''
	define('HEADER_TEXTCOLOR', '000000');
	define('HEADER_IMAGE', '%s/images/default_header.jpg'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 900); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 100);
	
	
	//thumbnails
	define("WEBFISH_USE_THUMBNAILS",true);
	set_post_thumbnail_size( 150, 150, true ); 
	
	/*
	* Add some built in functionallity
	*/
	
	// This theme allows users to set a custom background
	if ( is_wp_version( '3.4' ) )
		add_theme_support( 'custom-background' ); 
	else
		add_custom_background();
	
	//Wordpress wants to know the width of the page.
	if ( ! isset( $content_width ) ) $content_width = 630;
	
}


function webfish_angler_widgetInit(){
	/*
	 * Register sidebars
	 * If the sidebar should be beside the content, use this naming pattern
	 * sidebar[1-9](-(index|frontpage|page|single))?
	 * If you use more than one sidebar you must have a number 1-9
	 * If you want a different sidebar on, say single, you have to specify that with a tailoring -single
	 * See prioritation in sidebar.php
	 * 
	 * name=>description
	 */
	webfish_angler_registerSidebars(array(
	"sidebar"=>__("Just a simple sidebar", 'webfish_theme_angler'),
	));
	
	
	//register menus
	register_nav_menus( array(
		'primary' => __('Main menu', 'webfish_theme_angler'),
	) );
}


/*
 * Add the appearance for a comment
 */
if ( ! function_exists( 'webfish_angler_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function webfish_angler_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) : 
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'webfish_theme_angler' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'webfish_theme_angler' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'webfish_theme_angler' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'webfish_theme_angler' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'webfish_theme_angler' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'webfish_theme_angler'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


if ( ! function_exists( 'is_wp_version' ) ) :
// checks is WP is at least a certain version (makes sure it has sufficient comparison decimals
function is_wp_version( $is_ver ) {
    $wp_ver = explode( '.', get_bloginfo( 'version' ) );
    $is_ver = explode( '.', $is_ver );
    for( $i=0; $i<=count( $is_ver ); $i++ )
        if( !isset( $wp_ver[$i] ) ) array_push( $wp_ver, 0 );
 
    foreach( $is_ver as $i => $is_val )
        if( $wp_ver[$i] < $is_val ) return false;
    return true;
}
endif;

