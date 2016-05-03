<div id="sidebar" class="hidden-xs hidden-sm col-md-4 col-lg-4">

	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Search') ) ?>

	<?php if( is_home() ){ ?>

		<!-- Widgets for home page -->
		<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
		<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Main Page Widget') ) ?>

	<?php } else if ( is_single() ) { ?>

		<!-- Widget on article pages -->
		<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Single Article Page Widget') ) ?>	
		
	<?php } else { ?>



	<?php } ?>
	
</div>	
