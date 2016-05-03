<?php get_header(); ?>
<div class="container">
	<div class="row">
		<?php if(function_exists('yoast_breadcrumb')){ ?>
			<div id="path"><?php yoast_breadcrumb(); ?></div>
		<?php } ?>

		<div id="blog-posts" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<?php if( ( (is_home() && is_front_page()) || (is_home() && !is_front_page()) ) && of_get_option('enable_blog_slider') ){
				$args=array('cat' => of_get_option('featured_blog_category'), 'posts_per_page' => of_get_option("blog_slider_number") ,);
				query_posts($args);
				if(have_posts()): ?>
					<!-- #begin #grey-bg -->
					<div class="grey-bg blog-slider-wrap">
						<!-- #begin blog-slider-wrap -->
							<div id="blog-slider-wrap">
							<!-- BEGIN #blog-slider -->
							<div id="slider" class="blog-slider">
							<?php while(have_posts()) : the_post();
								if(has_post_thumbnail()){ 
									$image = vt_resize( get_post_thumbnail_id(),'' , 640, 190, true ); ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" title="<?php the_title(); ?>" alt="slider image" /></a>
								<?php } ?>
							<?php endwhile; ?>
							<!-- END #slider -->
							</div>
						<!-- blog-slider-wrap -->
						</div>
					<!-- END #grey-bg -->
					</div>
				<?php endif; wp_reset_query(); ?>
			<?php } ?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!-- BEGIN .post -->
				<div <?php post_class('blog-excerpt'); ?> id="post-<?php the_ID(); ?>">
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
						<?php if(has_post_thumbnail()) : ?>
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
									<?php resize_img("width=750&height=350"); ?>
								</a>
								<a href="http://vk.com/share.php?url=<?php the_permalink(); ?>" target="_blank">
									<div class="post_vk-share">
										<?php
											$post_id = get_post_meta($post->ID, 'VK Post ID', true);
											$res 		 = file_get_contents('https://api.vkontakte.ru/method/likes.getList?type=post&owner_id=-63864844&item_id='.$post_id);
											$resp = json_decode($res, true);
											   
											echo $resp['response']['count'];
										?>
									</div>
								</a>
							</div>
							<?php if($post->post_content != "") : ?>
								<div class="post-comment-count"><p><a href="<?php comments_link(); ?>"><?php comments_number(__('', 'theme_textdomain'), __('' ,'theme_textdomain'), __('Загрузка', 'theme_textdomain')); ?></a>
								
								</p></div>
							<?php endif; ?>
						<?php endif; ?>
						<div class="post-date"><span class="day"><?php the_time('j'); ?></span> <span class="month"><?php the_time('M'); ?></span> <span class="year"><?php the_time('Y') ?></span></div>
						
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="entry-content">
							<?php the_content(__('', 'theme_textdomain')); ?>
						</div>
					<!-- END .post-content -->	
					</div>
				<!-- END .post -->
				</div>
				
				<?php endwhile; ?>
			
				<!--BEGIN .page-navigation -->
				<div class="navegation page-navigation">
					<?php if( function_exists('wp_pagenavi') ) { ?>
						<div class="light">
							<?php wp_pagenavi(); ?>
						</div>
					<?php }else{ ?>
						<ul class="pager">
							<li class="previous"><?php next_posts_link(__('&larr; Предыдущие', 'theme_textdomain')) ?></li>
							<li class="next"><?php previous_posts_link(__('Следующие &rarr;', 'theme_textdomain')) ?></li>
						</ul>
					<?php } ?>
				<!--END .page-navigation -->
				</div>
				
				
			
			<?php else : ?>
				<div <?php post_class(); ?> id="post-0">

					<h2 class="entry-title"><?php _e('Ошибка 404 - Материал не найден', 'theme_textdomain') ?></h2>
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Для того, чтобы его найти вы можете воспользоваться формой поиска в правой колонке.", "theme_textdomain") ?></p>
					<!--END .entry-content-->
					</div>
					
				</div>
			<?php endif; ?>
		<!-- END #blog-posts -->
		</div>

		<?php get_sidebar(); ?>

	<!-- END .center-wrap -->
	</div>
<!-- END #content -->
</div>
  
<?php get_footer(); ?>