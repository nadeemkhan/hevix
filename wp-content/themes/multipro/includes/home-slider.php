<?php
//get the feaured category posts
$args=array('post_type' => 'slides',);
query_posts($args);

if(have_posts()) : ?>

	<div id="home-slider-wrap" class="grey-bg clearfix">
		<div id="slideshow" class="clearfix">
			<?php while(have_posts()) : the_post();
				$video = get_post_meta( get_the_ID(), 'slide_video', true );
				 if($post->post_content == ""){
				 	
						if(has_post_thumbnail()){ ?>
							<div class="image clearfix beforeload">
								<?php resize_img("width=970&height=310"); ?>
							</div>
						<?php }elseif( $video['vimeo-youtube'] != '' || $video['embedded-code'] != '' ){ ?>
							<div class="video clearfix beforeload">
								<?php embed_video(get_the_ID(), 970, 310, 'slide_video'); ?>
							</div>
						<?php } ?>
				
				<?php }else{ ?>
			
						<?php if(has_post_thumbnail()){ ?>
							<div class="image-content clearfix beforeload">
							    <?php resize_img("width=550&height=310"); ?>	
							    <div class="slide-description">
								    <h2 class="slide-title"><?php the_title(); ?></h2>
								    <?php the_content(); ?>
								</div>
							</div>
						<?php }elseif( $video['vimeo-youtube'] != '' || $video['embedded-code'] != '' ){ ?>
							<div class="video-content clearfix beforeload">
								<?php embed_video(get_the_ID(), 550, 310, 'slide_video'); ?>
								<div class="slide-description">
								    <h2 class="slide-title"><?php the_title(); ?></h2>
								    <?php the_content(); ?>
								</div>
							</div>
						<?php } ?>
			
				<?php } ?>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	</div>
	
<?php endif; ?>