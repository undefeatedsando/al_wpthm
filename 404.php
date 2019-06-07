<?php
/**
 * @package Angler
 * 
 */

get_header(); 
global $webfish_settings; ?>
<div id="c_wrap">
<div id="c_top"></div>

	<div id="content" class="narrowcolumn">


		<div class="page">
		<h1><?php _e("Page not found", 'webfish_theme_angler');?></h1>
			<div class="entry">
			<?php _e("We could not find the page you are looking for. We have searched in more than 404 places...", 'webfish_theme_angler');?>
			</div>
		</div>

	</div>
<div id="c_bottom"></div>
<div class="clear"></div>
</div><!-- End: c_wrap -->



<?php get_footer(); ?>

