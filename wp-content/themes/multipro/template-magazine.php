<?php
/*
Template Name: Magazine
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
			<?php if( of_get_option('enable_blog_slider') ){ ?>
				<?php $args=array('cat' => of_get_option('featured_blog_category'), 'posts_per_page' => of_get_option("blog_slider_number") ,);
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
			
			<?php			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
			if( of_get_option('enable_blog_slider') )
				$args="cat=-".of_get_option('featured_blog_category')."&paged=$paged";
			else
				$args="cat=0&paged=$paged";
			
			query_posts($args);
			$i = 1; 
			?>
		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<!-- BEGIN .post -->
				<?php if($i != 3) : ?>
					<div <?php post_class('magazine-excerpt'); ?> id="post-<?php the_ID(); ?>">
				<?php else : ?>
					<?php $classes = array('magazine-excerpt','margin-right-none'); ?>
					<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
				<?php endif; ?>
					<!-- BEGIN .post-content -->
					<div class="post-content clearfix">
						<?php if(has_post_thumbnail()) : ?>
							<div class="post-thumb"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php resize_img("width=188&height=150"); ?></a></div>
							<div class="post-comment-count"><p><a href="<?php comments_link(); ?>"><?php comments_number(__('No Comments', 'theme_textdomain'), __('1 Comment' ,'theme_textdomain'), __('% Comments', 'theme_textdomain')); ?></a></p></div>
						<?php endif; ?>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-meta">
							<span class="date"><?php the_time( get_option('date_format') ); ?></span>
							<span class="author">// <?php _e('By', 'theme_textdomain'); ?> <?php the_author_posts_link(); ?></span>
						</div>
						<div class="entry-content">
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink(); ?>" class="more-link"><?php _e('Read more...', 'theme_textdomain'); ?></a>
						</div>
					<!-- END .post-content -->	
					</div>
				<!-- END .post -->
				</div>
				
				<?php if( $i == 3 ) : ?>
					<div class="clearfix"></div>
					<?php $i=1; ?>
				<?php else: ?>
					<?php $i++; ?>	
				<?php endif; ?>
					
				<?php endwhile; ?>
			
				<!--BEGIN .page-navigation -->
				<div class="navegation page-navigation">
					<?php if( function_exists('wp_pagenavi') ) { ?>
						<div class="light">
							<?php wp_pagenavi(); ?>
						</div>
					<?php }else{ ?>
						<div class="left"><?php next_posts_link(__('&larr; Older Entries', 'theme_textdomain')) ?></div>
						<div class="right"><?php previous_posts_link(__('Newer Entries &rarr;', 'theme_textdomain')) ?></div>
					<?php } ?>
				<!--END .page-navigation -->
				</div>
			
			<?php else : ?>
				<div <?php post_class(); ?> id="post-0">

					<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'theme_textdomain') ?></h2>
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<p><?php _e("Sorry, but you are looking for something that isn't here.", "theme_textdomain") ?></p>
					<!--END .entry-content-->
					</div>
					
				</div>
			<?php endif; wp_reset_query(); ?>
		<!-- END #blog-posts -->
		</div>

		<?php get_sidebar(); ?>

	<!-- END .center-wrap -->
	</div>
<!-- END #content -->
</div>


<?php if( is_active_sidebar('magazine_bottom_left') || is_active_sidebar('magazine_bottom_center') || is_active_sidebar('magazine_bottom_right') ) { ?>
	<!-- BEGIN #featured-magazine -->
	<div id="featured-magazine">
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
			<div class="one-three-widget margin-left-none">
				<!-- Widget Area -->
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Magazine Bottom Left') ) ?>
			</div>
			<div class="one-three-widget">
				<!-- Widget Area -->
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Magazine Bottom Center') ) ?>
			</div>
			<div class="one-three-widget margin-right-none">
				<!-- Widget Area -->
				<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Magazine Bottom Right') ) ?>
			</div>
		<!-- END .center-wrap -->
		</div>
	<!-- END #featured-magazine -->		
	</div>
<?php } ?>
  
<?php get_footer(); ?>