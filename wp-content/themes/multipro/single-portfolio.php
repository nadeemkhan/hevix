<?php get_header(); ?>

<!-- BEGIN #content -->
<div id="content">
	<div class="grey-line"></div>
	<!-- BEGIN .center-wrap -->
	<div class="center-wrap clearfix">
		<!-- #path > nav location -->
		<?php if(function_exists('yoast_breadcrumb')){ ?>
			<div id="path"><?php yoast_breadcrumb(); ?></div>
		<?php } ?>
		
		<!-- BEGIN #blog-posts -->
		<div id="single-portfolio-wrap">
			
			<?php $imgs = get_post_meta( get_the_ID(), 'portfolio_imgs', true ); ?>
			<?php $video = get_post_meta( get_the_ID(), 'portfolio_video', true ); ?> 
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- BEGIN .post -->
			<div <?php post_class('single-portfolio'); ?> id="post-<?php the_ID(); ?>">
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">	
					<!-- BEGIN .portfolio-meta -->
					<div class="portfolio-meta clearfix">
							
						<?php if( $imgs['image-1'] !='' || $imgs['image-2'] !='' || $imgs['image-3'] !='' || $imgs['image-4'] !='' ){ ?>
						<div id="portfolio-slider-wrap">	
							<div id="slider" class="portfolio-slider">
								<?php for($i=1; $i<=4; $i++) : ?>
									<?php if($imgs['image-'.$i] !='') : ?>
										<?php $image = vt_resize( '', $imgs['image-'.$i] , 610, 350, true ); ?>
										<img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" alt="slider image" />
									<?php endif;?>
								<?php endfor; ?>
							</div>
						</div>
						<?php }elseif( has_post_thumbnail() ){ ?>
							<div class="post-thumb"><?php resize_img("width=610&height=350"); ?></div>
						<?php } ?>
							
						<?php if( $video['vimeo-youtube'] != '' || $video['embedded-code'] != '' ){ ?>
						
							<div class="post-video">
								<?php embed_video(get_the_ID(), 610, 350, 'portfolio_video'); ?>
							</div>
						
						<?php } ?>
					<!-- END .portfolio-meta -->	
					</div> 	
						
					<!-- BEGIN .portfolio-content -->
					<div class="single-portfolio-content">
						<?php if( current_user_can('edit_post', $post->ID) ): ?>
							<div class="edit-message">
								<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
							</div>
						<?php endif; ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
						<?php if(of_get_option('enable_related_portfolio')) : 
							include 'includes/related-portfolio.php'; 
						endif; ?>		
					<!-- END .single-portfolio-content -->
					</div>
				<!-- END .post-content -->
				</div>
			<!-- END .post --> 
			</div>
			<?php endwhile; endif; ?>
					
		<!-- END #single-portfolio-wrap -->
		</div>			
		
	<!-- END .center-wrap -->
	</div>
<!-- END #content -->
</div>

<?php get_footer(); ?>