<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

		<!-- BEGIN #featured-top -->
		<div id="featured-top">
			<div class="grey-line"></div>
			<!-- BEGIN .center-wrap -->
			<div class="center-wrap clearfix">
				
				<?php if( of_get_option('enable_slider') ) :
					include 'includes/home-slider.php';
				endif; ?>
				
				<!-- BEGIN #featured-top-wrap -->
				<div id="featured-top-wrap" class="clearfix">
					<div class="one-three-widget margin-left-none">
						<!-- Widget Area -->
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage Top Left') ) ?>
					</div>
					<div class="one-three-widget">
						<!-- Widget Area -->
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage Top Center') ) ?>
					</div>
					<div class="one-three-widget margin-right-none">
						<!-- Widget Area -->
						<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage Top Right') ) ?>
					</div>			
				<!-- END #featured-top-wrap -->
				</div>
			<!-- END .center-wrap -->
			</div>
		<!-- END #featured-top -->
		</div>
		
		<?php if( of_get_option('enable_featured_portfolio') ) :
			include 'includes/home-portfolio.php';
		endif; ?>
		
		<!-- BEGIN featured-bottom -->
		<div id="featured-bottom">
			<!-- BEGIN .center-wrap -->
			<div class="center-wrap clearfix">
				<div class="one-three-widget margin-left-none">
					<!-- Widget Area -->
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage Bottom Left') ) ?>
				</div>
				<div class="one-three-widget">
					<!-- Widget Area -->
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage Bottom Center') ) ?>
				</div>
				<div class="one-three-widget margin-right-none">
					<!-- Widget Area -->
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Homepage Bottom Right') ) ?>
				</div>
			<!-- END .center-wrap -->
			</div>
		<!-- END #featured-bottom -->
		</div>


<?php get_footer(); ?>