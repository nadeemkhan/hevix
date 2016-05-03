<?php get_header(); ?>

<div class="container">
	<!-- BEGIN .center-wrap -->
	<div class="row">
		<!-- #path > nav location -->
		<?php if(function_exists('yoast_breadcrumb')){ ?>
			<div id="path"><?php yoast_breadcrumb(); ?></div>
		<?php } ?>
		<!-- BEGIN #blog-posts -->
		<div id="blog-posts" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!-- BEGIN .post -->
				<div <?php post_class('single-entry'); ?> id="post-<?php the_ID(); ?>">
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">

						<?php if(has_post_thumbnail()) : ?>
							<div class="post-thumb"><?php resize_img("width=750&height=350"); ?></div>
						<?php endif; ?>
		
						<div class="entry-title-wrap">
							<div class="entry-title-line"></div>
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<p>Опубликовано <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' назад'; ?> // <a href="<?php comments_link(); ?>"><?php comments_number(__('Без комментариев', 'theme_textdomain'), __('1 Комментарий' ,'theme_textdomain'), __('% Комментариев', 'theme_textdomain')); ?></a> 

								
							</p>
							<div class="entry-title-line"></div>
						</div>
						<div class="entry-content">

							<?php the_content(); ?>
							<div class="inner_center">
											<?php if ( get_post_meta($post->ID, 'demo', true) ) { ?>
												<a rel="nofollow" target="_blank" href="<?php echo (get_post_meta($post->ID, 'demo', true)); ?>"><div class="demo">
													Полученный результат
												</div></a>
											<?php } ?>
							</div>
						</div>
						
					<!-- END .post-content -->	
					</div>
					
					
				<!-- END .post -->
				</div>
				
				<?php endwhile; ?>

				<?php if ( get_post_meta($post->ID, 'source', true) ) { ?>
						<div class="source_article">
							<?php echo (get_post_meta($post->ID, 'source', true)); ?>
						</div>
				<?php } ?>
				
				<!-- BEGIN comments -->
				<?php comments_template('', true); ?>
				<!-- END comments -->
				
			<?php else : ?>
				<div <?php post_class(); ?> id="post-0">

					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'theme_textdomain') ?></h2>
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "theme_textdomain") ?></p>
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