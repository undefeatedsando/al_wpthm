<?php
/**
 * @package Angler
 * 
 */

get_header();
?>
<div id="c_wrap">
<div id="c_top"></div>

	<div id="content" class="narrowcolumn">

		<?php if (have_posts()) : ?>

	<h1 class="pagetitle">
 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<?php single_cat_title(); ?>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<?php single_tag_title(); ?>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		 <?php _e('Archive for', 'webfish_theme_angler'); echo " "; the_time('F jS, Y'); ?>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		  <?php _e('Archive for', 'webfish_theme_angler'); echo " "; the_time('F, Y'); ?>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		  <?php _e('Archive for', 'webfish_theme_angler'); echo " "; the_time('Y'); ?>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		 <?php _e('Author Archives', 'webfish_theme_angler') ?>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		 <?php _e('Blog Archives', 'webfish_theme_angler') ?>
 	  <?php } ?>
		</h1>
		
		<?php if(is_category()){echo "<div class='post'>".category_description()."</div>";} ?>
		

		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link(__('&laquo; Newer Entries', 'webfish_theme_angler')) ?></div>
			<div class="alignright"><?php next_posts_link(__('Older Entries &raquo;', 'webfish_theme_angler')) ?></div>
			<div class="clear"></div>
		</div>

		<?php while (have_posts()) : the_post(); ?>
		<div <?php post_class() ?>>
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time('l, F jS, Y') ?></small>

				<div class="entry">
					<?php the_content() ?>
				</div>
				<div class="clear"></div>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'webfish_theme_angler').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<div class="clear"></div>
				<div class="postmetadata"><?php the_tags('<div class="tags">', ' ', '</div> '); ?><div class="categories"><?php the_category(' ') ?></div>
					<?php comments_popup_link(__('No Comments &#187;', 'webfish_theme_angler'), __('1 Comment &#187;', 'webfish_theme_angler'), __('% Comments &#187;', 'webfish_theme_angler')); 
					 edit_post_link(__('Edit', 'webfish_theme_angler'), ' | ', ''); ?>
				</div>

			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_posts_link(__('&laquo; Newer Entries', 'webfish_theme_angler')) ?></div>
			<div class="alignright"><?php next_posts_link(__('Older Entries &raquo;', 'webfish_theme_angler')) ?></div>
			<div class="clear"></div>
		</div>
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>".__("Sorry, but there aren't any posts in the %s category yet.", 'webfish_theme_angler')."</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo "<h2>".__("Sorry, but there aren't any posts with this date.", 'webfish_theme_angler')."</h2>";
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>".__("Sorry, but there aren't any posts by %s yet.", 'webfish_theme_angler')."</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>".__("No posts found.", 'webfish_theme_angler')."</h2>");
		}
		get_search_form();

	endif;
?>

	</div>
<div id="c_bottom"></div>
<div class="clear"></div>
</div><!-- End: c_wrap -->


<?php get_footer(); ?>
