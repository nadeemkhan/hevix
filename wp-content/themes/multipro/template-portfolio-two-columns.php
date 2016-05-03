<?php
/*
Template Name: Portfolio Two Columns
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
		
		<?php  $query = new WP_Query(); 
			   $query->query('post_type=portfolio&posts_per_page=-1'); ?>
								
		<!-- BEGIN #portfolio-wrap -->	
		<div id="portfolio-wrap" class="clearfix">		
			<!-- BEGIN #portfolio-content -->
			<div id="portfolio-content" class="clearfix">
			
				<!-- BEGIN #columns-wrap .one-column -->
				<ul class="filter-posts two-columns clearfix">
				
				<?php $count = 1; ?>
				<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
					
					<?php $video = get_post_meta( get_the_ID(), 'portfolio_video', true ); ?>
					<?php $terms = get_the_terms( get_the_ID(), 'portfolio-category' ); ?>
					
				<li data-id="id-<?php echo $count; ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>" class="project clearfix">
					<!-- BEGIN .post -->
					<div <?php post_class('portfolio-two-item'); ?> id="post-<?php the_ID(); ?>">
						<!-- BEGIN .post-content -->
						<div class="post-content clearfix">
							
							<?php if( has_post_thumbnail() && of_get_option('enable_lightbox') ) { ?>
								<div class="post-thumb">
								<?php if( $video['vimeo-youtube'] != '' || $video['embedded-code'] != '' ){ ?>
									<a class="screencast-play" href="<?php echo $video; ?>" rel="prettyPhoto"><img class="opaque" src="<?php echo get_template_directory_uri(); ?>/resources/images/screencast-play.png" alt="screencast play" /></a>
								<?php video_lightbox(get_the_ID(), 430, 220); ?>
								<?php }else{ ?>
									<a href="<?php echo get_thumbnail_url(); ?>" title="<?php the_title(); ?>" rel="prettyPhoto[gallery]"><?php resize_img("width=430&height=220"); ?></a>
								<?php } ?>
									</div>
								<?php }elseif( has_post_thumbnail() ){ ?>
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php resize_img("width=430&height=220"); ?></a>
									</div>
								<?php } ?>
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								
								<!-- END .post-content -->
								</div>
							<!-- END .post -->
							</div>
						<!--END .portfolio-item -->
						</li>
				
				<?php $count++; ?>	
				<?php endwhile; endif; ?>
				<?php wp_reset_query(); ?>
				
				</ul>
				
			<!-- END #portfolio-content -->	
			</div>
		<!-- END #portfolio-wrap -->
		</div>	
	<!-- END .center-wrap -->
	</div>
<!-- END #content -->
</div>


<?php get_footer(); ?>