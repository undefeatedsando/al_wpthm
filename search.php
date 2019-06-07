<?php
/**
 * @package Angler
 *  */

get_header(); ?>
<div id="c_wrap">
<div id="c_top"></div>
	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h1 class="pagetitle"><?php _e("Search results for", 'webfish_theme_angler')?> <?php the_search_query() ?></h1>

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
			<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'webfish_theme_angler')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'webfish_theme_angler')) ?></div>
			<div class="clear"></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e("No posts found. Try a different search?", 'webfish_theme_angler')?></h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<div id="c_bottom"></div>
<div class="clear"></div>
</div><!-- End: c_wrap -->

<?php get_footer(); ?>
