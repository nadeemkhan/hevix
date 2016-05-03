<?php
/*
Template Name: Archive 
*/
?>

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
		<div id="blog-posts">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!-- BEGIN .post -->
				<div <?php post_class('archive-template'); ?> id="post-<?php the_ID(); ?>">
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
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
							<p><?php the_content(); ?></p>
						</div>
						<div class="archive-content">
							<h3><?php _e('Last 10 Posts', 'theme_textdomain') ?></h3>
							<ul class="archivelist">
								<?php $archive = get_posts('numberposts=10');
								foreach($archive as $post) : ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
								<?php endforeach; ?>
							</ul>
							<h3><?php _e('Archives by Month:', 'theme_textdomain') ?></h3>
							<ul class="archivelist">
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
							<h3><?php _e('Archives by Category:', 'theme_textdomain') ?></h3>
							<ul class="archivelist">
								<?php wp_list_categories( 'title_li=' ); ?>
							</ul>
						</div>
					<!-- END .post-content -->	
					</div>
				<!-- END .post -->
				</div>
				
				<?php endwhile; ?>
			
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