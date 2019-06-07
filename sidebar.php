<?php 
$max=WEBFISH_COLUMNS_INDEX;
$type="index";
if(is_home()){
	$max=WEBFISH_COLUMNS_INDEX;
	$type="index";
}
elseif(is_front_page()){
	$max=WEBFISH_COLUMNS_FRONT_PAGE;
	$type="frontpage";
}
elseif(is_page()){
	$max=WEBFISH_COLUMNS_PAGE;
	$type="page";
}
elseif(is_single()){
	$max=WEBFISH_COLUMNS_SINGLE;
	$type="single";
}

for($i=1;$i<$max;$i++):?>
	<div id="sb<?php echo $i;?>_wrap" class="sb_wrap sb_<?php echo $type;?>_wrap">
	<div id="sb<?php echo $i;?>_top" class="sb_top sb_<?php echo $type;?>_top"></div>
	<div id="sidebar<?php echo $i;?>" class="sidebar widget-area sb_<?php echo $type;?>">
		<ul>
			<?php 
			if ( is_active_sidebar( "sidebar$i-$type" )){
				dynamic_sidebar("sidebar$i-$type"); 
			}
			elseif( is_active_sidebar( "sidebar-$type" )){
				dynamic_sidebar("sidebar-$type"); 
			}
			elseif( is_active_sidebar( "sidebar$i" )){
				dynamic_sidebar("sidebar$i"); 
			}
			elseif( is_active_sidebar( "sidebar" )){
				dynamic_sidebar("sidebar"); 
			}
			else{
				?>
			
				<li id="pages" class="widget-container widget_search">
			<h5 class="widgettitle"><?php _e( 'Pages', 'webfish_theme_angler' ); ?></h5>
				<ul>
				<?php wp_list_pages(array("depth"=>"1","title_li"=>'')); ?>
				</ul>
			</li>

			<li id="archives" class="widget-container">
				<h5 class="widgettitle"><?php _e( 'Archives', 'webfish_theme_angler' ); ?></h5>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

			<li id="meta" class="widget-container">
				<h5 class="widgettitle"><?php _e( 'Meta', 'webfish_theme_angler' ); ?></h5>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>
			<?php }
			?>

		</ul>
	</div>
	<div id="sb<?php echo $i;?>_bottom" class="sb_bottom sb_<?php echo $type;?>_bottom"></div>
	<div class="clear"></div>
	</div><!-- sb_wrap -->
<?php endfor;?>