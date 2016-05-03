<?php
/* Get Secondary Menu */

if (has_nav_menu('secondary-menu')) :

	$submenu = wp_nav_menu(
			array(
			'theme_location'=>'secondary-menu',
			'depth'=>3,
			'menu_class' => 'sf-menu',
			'walker' => new custom_nav_walker(),
			'echo' => 0 )
			);

endif;

/* Get Author */

if(get_query_var('author_name')) :
	$auth = get_userdatabylogin(get_query_var('author_name'));
else :
	$auth = get_userdata(get_query_var('author'));
endif;

/* Conditional Tags */

if( ( is_home() && is_front_page() ) || ( is_home() && ! is_front_page() ) || ( is_page_template('template-magazine.php') ) ){
	
	if( of_get_option('enable_submenu') && has_nav_menu('secondary-menu') ){ ?>
	
		<!-- BEGIN #sub-header -->
		<div id="sub-header">
			<!-- BEGIN .center-wrap -->
			<div id="secondary-nav" class="center-wrap clearfix">
				<?php echo $submenu; ?>
			<!-- END .center-wrap -->
			</div>
			<div id="sub-header-line"></div>
		<!-- END #sub-header -->
		</div> 	
	
	<?php } ?>
	
<?php }elseif( of_get_option('enable_submenu') && has_nav_menu('secondary-menu') && ( ( is_single() && get_post_type() != 'portfolio' ) || is_category() || is_tag() || is_search() || is_day() || is_month() || is_year() || is_archive() ) ){ ?>
	
	<!-- BEGIN #sub-header -->
	<div id="sub-header">
		<!-- BEGIN .center-wrap -->
		<div id="secondary-nav" class="center-wrap clearfix">
			<?php echo $submenu; ?>
		<!-- END .center-wrap -->
		</div>
		<div id="sub-header-line"></div>
	<!-- END #sub-header -->
	</div>
		
<?php }elseif( is_page_template('template-portfolio-two-columns.php') || is_page_template('template-portfolio-three-columns.php') || is_page_template('template-portfolio-four-columns.php') ){ ?>

	<?php $data = get_post_meta( get_the_ID(), 'key', true ); ?>

	<!-- BEGIN #sub-header -->
	<div id="sub-header">
		<!-- BEGIN .center-wrap -->
	 	<div class="center-wrap clearfix">
	 		<?php echo ( $data[ 'heading' ] != '' ) ? '<h1 class="portfolio-header">'.$data[ 'heading' ].'</h1>' : the_title('<h1 class="portfolio-header">','</h1>',false); ?>
	 		<!-- BEGIN #portfolio-nav -->
	 		<div id="portfolio-nav" >
		 		<!-- .filter-list -->
		 		<ul class="filter-list filter">
		 			<li class="active all-projects" ><a href="#" title="All categories"><?php _e('All', 'theme_textdomain'); ?></a></li>
		 			<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'portfolio-category', 'walker' => new filterable_portfolio_walker())); ?>
		 			<li class="hidden">Bug</li>
		 		<!-- END .filter-list -->
		 		</ul>
		 	<!-- END #portfolio-nav -->
		 	</div>
	 	<!-- END .center-wrap -->
	 	</div>
	 	<div id="sub-header-line"></div>
	<!-- END #sub-header -->
	</div>
	
<?php }else{ ?>	

	<!-- BEGIN #sub-header -->
	<div id="sub-header" class="tagline-wrap">
	
	<?php if( is_author() ){ ?>
	
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
			<h1 class="header-title"><?php _e('Archive', 'theme_textdomain'); ?></h1>
			<p class="tagline"><?php _e('You are viewing the author archive for:', 'theme_textdomain'); echo ucfirst( $auth->display_name ); ?></h1>
		<!-- END .center-wrap -->
		</div>
		
	<?php }elseif( is_tax() ){ ?>
	
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
			<h1 class="header-title"><?php _e('Tax : Portfolio Category', 'theme_textdomain'); ?></h1>
		<!-- END .center-wrap -->
		</div> 
	
	<?php }elseif( is_page() || get_post_type() == 'portfolio' ){
	
		if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<?php $data = get_post_meta( get_the_ID(), 'key', true ); ?>
			<!-- BEGIN .center-wrap -->
			<div class="center-wrap clearfix <?php if( is_page_template('template-home.php') ) echo 'center homepage-header'; ?>">
				<?php if( get_post_type() == 'portfolio' ) : ?>
					<?php echo ( $data[ 'heading' ] != '' ) ? '<h1 class="header-title">Portfolio: '.$data[ 'heading' ].'</h1>' : the_title('<h1 class="header-title">Portfolio: ','</h1>',false); ?>
				<?php else : ?>
					<?php echo ( $data[ 'heading' ] != '' ) ? '<h1 class="header-title">'.$data[ 'heading' ].'</h1>' : the_title('<h1 class="header-title">','</h1>',false); ?>
				<?php endif; ?>
				<?php if( $data[ 'tagline' ] != '' ) : echo '<p class="tagline">'.$data[ 'tagline' ].'</p>'; endif; ?>
			<!-- END .center-wrap -->
			</div> 	
		
		<?php endwhile; endif;	
	
	}elseif( is_404() ){ ?>
	
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
			<h1 class="header-title"><?php _e('Error 404 - Page Not Found','theme_textdomain'); ?></h1>
			<p class="tagline"><?php _e('Sorry, but you are looking for something that isn\'t here.', 'theme_textdomain'); ?></p>
		<!-- END .center-wrap -->
		</div>
					
	<?php }elseif( ! of_get_option('enable_submenu') ){ ?>
	
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
		
		<?php /* Blog options */
		if( is_single() ){
		
			if (have_posts()) : while (have_posts()) : the_post();
			
				$data = get_post_meta( get_the_ID(), 'key', true ); ?>
				<?php echo ( $data[ 'heading' ] != '' ) ? '<h1 class="header-title">'.$data[ 'heading' ].'</h1>' : the_title('<h1 class="header-title">','</h1>',false); ?>
				<?php if( $data[ 'tagline' ] != '' ) : echo '<p class="tagline">'.$data[ 'tagline' ].'</p>'; endif; ?>	
			
			<?php endwhile; endif;
		
		}elseif( is_category() ){ ?>
		
			<h1 class="header-title"><?php echo single_cat_title('',false); ?></h1>
		
		<?php }elseif( is_tag() ){ ?>
		
			<h1 class="header-title"><?php printf( __('All posts tagged %s', 'theme_textdomain'), single_tag_title('',false) ); ?></h1>
		
		<?php }elseif( is_search() ){ ?>
		
			<h1 class="header-title"><?php _e('Search Results for', 'theme_textdomain'); ?> "<?php echo htmlspecialchars($_GET['s']); ?>"</h1>
		
		<?php }elseif( is_day() ){ ?>
		
			<h1 class="header-title"><?php _e('Archive for', 'theme_textdomain') ?> <?php the_time('F jS, Y'); ?></h1>
		
		<?php }elseif( is_month() ){ ?>
		
			<h1 class="header-title"><?php _e('Archive for', 'theme_textdomain') ?> <?php the_time('F, Y'); ?></h1>
		
		<?php }elseif( is_year() ){ ?>
		
			<h1 class="header-title"><?php _e('Archive for', 'theme_textdomain') ?> <?php the_time('Y'); ?></h1>
		
		<?php } ?>
		
		<!-- END .center-wrap -->
		</div>
		
	<?php }else{ ?>
		<!-- BEGIN .center-wrap -->
		<div class="center-wrap clearfix">
			<h1 class="header-title"><?php echo of_get_option('default_header'); ?></h1>
			<p class="tagline"><?php echo of_get_option('default_description'); ?></h1>
		<!-- END .center-wrap -->
		</div>
	 <?php } ?>
	
		<div id="sub-header-line"></div>
	<!-- END #sub-header -->
	</div>

<?php } ?>