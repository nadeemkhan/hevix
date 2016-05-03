<?php get_header(); ?>

<!-- BEGIN #content -->
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
				<div <?php post_class('single-page'); ?> id="post-<?php the_ID(); ?>">
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
						<?php if( has_post_thumbnail() ) : ?>
							<div class="post-thumb"><?php resize_img("width=650&height=250"); ?></div>
						<?php  endif; ?>
						<?php if( current_user_can('edit_post', $post->ID) ): ?>
							<div class="edit-message">
								<?php edit_post_link( __('Edit this', 'theme_textdomain') ); ?>
							</div>
						<?php endif; ?>
						<?php $data = get_post_meta( get_the_ID(), 'key', true ); ?>
						<?php if( ( !of_get_option('enable_submenu') ) || ( of_get_option('enable_submenu') && $data['heading'] != '' ) ) : ?>
							<div class="entry-title-wrap">
								<div class="entry-title-line"></div>
								<?php if( !of_get_option('enable_submenu') ) : ?>
									<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php else : ?>
									<h2 class="entry-title"><?php the_title(); ?></h2>
								<?php endif; ?>
								<div class="entry-title-line"></div>
							</div>
						<?php endif; ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					<!-- END .post-content -->	
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