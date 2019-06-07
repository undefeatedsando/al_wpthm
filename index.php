<?php get_header(); ?>
<div class="wrapper">
  <?php get_template_part( 'content', get_post_format() );?>
	<div class="feed">
		<div class="feed-item">
			<div class="feed-item-flag"><i class="fa fa-bookmark"></i> </div>
			<div class="feed-item-image"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/pic1.jpg" alt=""></div>
			<div class="feed-item-title">Текст как способ справляться с жизнью</div>
			<div class="feed-item-preview">Этот текст — про слабость, уязвимость, стыд и зависть.</div>
			<a href="" class="feed-item-link">Читать</a>
		</div>
		<div class="feed-item">
			<div class="feed-item-flag"><i class="fa fa-bookmark"></i></div>
			<div class="feed-item-image"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/pic1.jpg" alt=""></div>
			<div class="feed-item-title">Текст как способ справляться с жизнью</div>
			<div class="feed-item-preview">Этот текст — про слабость, уязвимость, стыд и зависть.</div>
			<a href="" class="feed-item-link">Читать</a>
		</div>
		<div class="feed-item">
			<div class="feed-item-flag"><i class="fa fa-bookmark"></i></div>
			<div class="feed-item-image"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/pic1.jpg" alt=""></div>
			<div class="feed-item-title">Текст как способ справляться с жизнью</div>
			<div class="feed-item-preview">Этот текст — про слабость, уязвимость, стыд и зависть.</div>
			<a href="" class="feed-item-link">Читать</a>
		</div>
	</div>
</div>

  <?php wp_footer(); ?>
</body>
</html>
