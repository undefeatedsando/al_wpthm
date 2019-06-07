<?php
/**
 * The Footer widget areas.
 *
 */

if(WEBFISH_SIDEBARS_IN_FOOTER>0):
?>

			<div id="footer-widget-area">
			<?php for($i=1;$i<=WEBFISH_SIDEBARS_IN_FOOTER;$i++):?>
				<div id="footer_sidebar<?php echo $i;?>" class="footer-widget-area">
					<ul>
						<?php dynamic_sidebar( 'Footer'.$i ); ?>
					</ul>
				</div>
				
			<?php endfor;?>
			</div><!-- #footer-widget-area -->
<?php endif;?>