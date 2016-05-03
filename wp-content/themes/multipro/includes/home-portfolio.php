<?php 

//get portfolio category name
$portfolio_cats = get_categories('taxonomy=portfolio-category');
foreach ($portfolio_cats as $category) {
	if($category->cat_ID == of_get_option('featured_portfolio_category') ){
		$cat = $category->cat_name;
	}
}

//get feaured category posts
$args=array(
	'post_type' => 'portfolio',
	'posts_per_page' => 3,
	'portfolio-category' => $cat);
query_posts($args);
?>

<?php if(have_posts()): ?>
	<!-- BEGIN #featured-portfolio -->
	<div id="featured-portfolio">
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
			
			<div id="featured-portfolio-caption">
				<h2><?php echo of_get_option('featured_portfolio_title'); ?></h2>
				<p><?php echo of_get_option('featured_portfolio_description'); ?></p>
				<p class="more"><a href="<?php echo of_get_option('featured_portfolio_link'); ?>" title="<?php echo of_get_option('featured_portfolio_title'); ?>"><?php echo of_get_option('featured_portfolio_anchor'); ?></a></p>
			</div>
			
			<div id="featured-portfolio-items">
			
				<?php while(have_posts()) : the_post(); ?>
				
				<div class="featured-portfolio-item">
					<div class="post-thumb"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php resize_img("width=195&height=135"); ?></a></div>
				</div>
				
				<?php endwhile; wp_reset_query(); ?>
				
			</div>
		<!-- END .center-wrap -->
		</div>
	<!-- END #featured-portfolio -->
	</div>
<?php endif; ?>
