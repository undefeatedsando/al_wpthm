<?php
get_header();
global $webfish_settings; 
?>
	<div class="wrapper">

	<?php if (have_posts()) : the_post(); ?>


  <div class="post">
    <div class="post-header">
      <div class="post-header-image"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/pic1.jpg" alt=""></div>
      <div class="post-header-title"><?php the_title(); ?></div>
    </div>
    <div class="post-content">
      <?php 
        if (WEBFISH_USE_THUMBNAILS && $webfish_settings['thumbnails_single']=="1")
            if ( has_post_thumbnail()) 
                the_post_thumbnail();
        the_content('<p class="serif">'.__('Read the rest of this entry &raquo;', 'webfish_theme_angler').'</p>'); ?>
        <div class="clear"></div>
        <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'webfish_theme_angler').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
    </div>
  </div>


<?php endif; ?>

<?php get_sidebar(); ?>

	</div><!-- End: content1 -->

<?php get_footer(); ?>
