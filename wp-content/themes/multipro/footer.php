
<div class="grey-line bottom"></div>
			
			<?php if( is_active_sidebar('footer_left') || is_active_sidebar('footer_center') || is_active_sidebar('footer_right') ) { ?>
			
				<!-- BEGIN #footer -->
				<div id="footer">
					<div id="footer-line-top"></div>
					<!-- BEGIN .center-wrap -->
					<div class="container">
						<div class="one-three-widget clearfix margin-left-none">
							<!-- Widget Area - Footer #1 -->
							<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left') ) ?>
						</div>
						<div class="one-three-widget clearfix">
							<!-- Widget Area - Footer #2 -->
							<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Center') ) ?>
						</div>
						<div class="one-three-widget clearfix margin-right-none">
							<!-- Widget Area - Footer #3 -->
							<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right') ) ?>
						</div>
					<!-- END .center-wrap -->	
					</div>
					<div id="footer-line-bottom"></div>
				<!-- END #footer -->
				</div>
				
			<?php } ?>
			
			<!-- BEGIN #sub-footer -->
			<div id="sub-footer">
				<!-- BEGIN .center-wrap -->
				<div class="container">
					<div class="row">
						<div class="hidden-xs col-md-9">
							  <?php

								$defaults = array(
									'exclude' => '',
									'theme_location'  => '',
									'menu'            => '',
									'container'       => 'div',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'menu',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul class="footermenu">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
								);

								wp_nav_menu( $defaults );

							?>
						</div>

						<div class="hidden-sm col-md-3">
							<div class="row footersocialmenu">
								2013–<?php echo date('Y'); ?> &copy; Hevix.ru
							</div>
						</div>
					</div>

			

					<div id="copy" class="clearfix">
						
					</div>
					<div id="scroll-up"><a href="#top" title="top"><img src="<?php echo get_template_directory_uri(); ?>/resources/images/scroll.png" alt="scroll up" /></a></div>
				<!-- END .center-wrap -->
				</div>
			<!-- END #sub-footer -->
			</div>			
		
		<!-- Theme Hook -->
		<?php wp_footer(); ?>
		
	<!-- END body -->
	</body>
<!--END html  -->	
</html>