<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  fd 
 */

function optionsframework_options() {

	$options_color_theme = array("red.css" => "Red", "green.css" => "Green", "blue.css" => "Blue", "orange.css" => "Orange", "strawberry.css" => "Strawberry", "yellow.css" => "Yellow", "brown.css" => "Brown", "kiwi.css" => "Kiwi", "wine.css" => "Wine", "soft-blue.css" => "Soft Blue");
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	$options_related_posts = array("category" => "Category", "tag" => "Tag");
	
	$options_slider_autoplay = array("1000" => "1 Second", "2000" => "2 Seconds", "3000" => "3 Seconds", "4000" => "4 Second", "5000" => "5 Second", "6000" => "6 Second", "7000" => "7 Second", "8000" => "8 Second", "9000" => "9 Second", "10000" => "10 Second", "0" => "Disable Autoplay");
	
	$options_transition_home =  array("scrollLeft" => "Left", "scrollRight" => "Right", "scrollUp" => "Up", "scrollDown" => "Down");
	
	$options_transition_effect = array("sliceDown" => "Down", "sliceDownLeft" => "Down Left", "sliceUp" => "Up", "sliceUpLeft" => "Up Left", "sliceUpDown" => "Up Down", "sliceUpDownLeft" => "Up Down Left", "fold" => "Fold", "fade" => "Fade");
	
	$options_numbers = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");
		
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories('hide_empty=0');
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	//Pull all the portfolio categories into an array
	$options_folio_categories = array();  
	$options_folio_categories_obj = get_categories('taxonomy=portfolio-category&hide_empty=0');
	foreach ($options_folio_categories_obj as $folio_category) {
		$options_folio_categories[$folio_category->cat_ID] = $folio_category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/resources/images/';
		
	$options = array();
		
	//General Settings
	$options[] = array( "name" => __("General Settings", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Logo", "theme_textdomain"),
						"desc" => __("Upload a logo for your theme, or specify the image address of your online logo. (http://www.example.com/logo.png)", "theme_textdomain"),
						"id" => "logo",
						"type" => "upload");
						
	$options[] = array( "name" => __("Favicon", "theme_textdomain"),
						"desc" => __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.", "theme_textdomain"),
						"id" => "favicon",
						"type" => "upload");
						
	$options[] = array( "name" => __("Contact Form Email", "theme_textdomain"),
						"desc" => __("Enter the email address where you'd like to receive emails from the contact form, or leave blank to use admin email.", "theme_textdomain"),
						"id" => "email",
						"type" => "text");
						
	$options[] = array( "name" => __("Default Header", "theme_textdomain"),
						"desc" => __("Type the global header tagline that will appear next to the heading underneath your logo.", "theme_textdomain"),
						"id" => "default_header",
						"type" => "text");
						
	$options[] = array( "name" => __("Default Description", "theme_textdomain"),
						"desc" => __("This appears in the cotton area opposite the breadcrumb.", "theme_textdomain"),
						"id" => "default_description",
						"type" => "text");
						
	//Homepage Options
	$options[] = array( "name" => __("Homepage Options", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Enable Slider?", "theme_textdomain"),
						"desc" => __("Check this to enable a homepage slider.", "theme_textdomain"),
						"id" => "enable_slider",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Home Slider Autoplay", "theme_textdomain"),
						"desc" => __("Choose the time between slider transitions or Disable Autoplay option.", "theme_textdomain"),
						"id" => "home_slider_autoplay",
						"type" => "select",
						"options" => $options_slider_autoplay);
						
	$options[] = array( "name" => __("Transition Effect", "theme_textdomain"),
						"desc" => __("Choose the transition effect between diferent sliders.", "theme_textdomain"),
						"id" => "home_transition_effect",
						"type" => "select",
						"options" => $options_transition_home);
						
	$options[] = array( "name" => __("Enable Featured Porfolio?", "theme_textdomain"),
						"desc" => __("Check this to display recent works in homepage.", "theme_textdomain"),
						"id" => "enable_featured_portfolio",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Featured Portfolio Category", "theme_textdomain"),
						"desc" => __("Choose the category of portfolio to show featured works in homepage.", "theme_textdomain"),
						"id" => "featured_portfolio_category",
						"type" => "select",
						"options" => $options_folio_categories);
	
	$options[] = array( "name" => __("Featured Portfolio Title", "theme_textdomain"),
						"desc" => __("Type the featured portfolio title.", "theme_textdomain"),
						"id" => "featured_portfolio_title",
						"type" => "text");
						
	$options[] = array( "name" => __("Featured Portfolio Link", "theme_textdomain"),
						"desc" => __("Type the portfolio URL link to be redirected when click it. For example: http://domain.com/portfolio/", "theme_textdomain"),
						"id" => "featured_portfolio_link",
						"type" => "text");
						
	$options[] = array( "name" => __("Featured Portfolio Anchor", "theme_textdomain"),
						"desc" => __("Type the anchor text link. For example: View the portfolio", "theme_textdomain"),
						"id" => "featured_portfolio_anchor",
						"type" => "text");
						
	$options[] = array( "name" => __("Featured Portfolio Description", "theme_textdomain"),
						"desc" => __("Type the featured portfolio description.", "theme_textdomain"),
						"id" => "featured_portfolio_description",
						"type" => "textarea");					
	//Blog Options
	$options[] = array( "name" => __("Blog Options", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Enable Featured Slider?", "theme_textdomain"),
						"desc" => __("Check this to enable a blog slider.", "theme_textdomain"),
						"id" => "enable_blog_slider",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Featured Category", "theme_textdomain"),
						"desc" => __("Choose the category to show featured posts (slider).", "theme_textdomain"),
						"id" => "featured_blog_category",
						"type" => "select",
						"options" => $options_categories);
						
	$options[] = array( "name" => __("No. of Sildes", "theme_textdomain"),
						"desc" => __("Select how many slides do you want to display.", "theme_textdomain"),
						"id" => "blog_slider_number",
						"std" => "5",
						"type" => "select",
						"options" => $options_numbers);
						
	$options[] = array( "name" => __("Blog Slider Autoplay", "theme_textdomain"),
						"desc" => __("Choose the time between slider transitions or Disable Autoplay option.", "theme_textdomain"),
						"id" => "blog_slider_autoplay",
						"type" => "select",
						"options" => $options_slider_autoplay);
						
	$options[] = array( "name" => __("Transition Effect", "theme_textdomain"),
						"desc" => __("Choose the transition effect between diferent sliders.", "theme_textdomain"),
						"id" => "blog_transition_effect",
						"type" => "select",
						"options" => $options_transition_effect);
						
	$options[] = array( "name" => __("Enable Submenu?", "theme_textdomain"),
						"desc" => __("Check this to enable submenu. (blog, blog posts, categories, etc.)", "theme_textdomain"),
						"id" => "enable_submenu",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Individual Post Options", "theme_textdomain"),
						"desc" => __("The following options apply to individual blog posts.", "theme_textdomain"),
						"type" => "info");
						
	$options[] = array( "name" => __("Show Featured Image?", "theme_textdomain"),
						"desc" => __("Check this to show the image at the beginning of the post.", "theme_textdomain"),
						"id" => "enable_featured_image",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Show Author Bio?", "theme_textdomain"),
						"desc" => __("Check this to show the author bio at the end of the post.", "theme_textdomain"),
						"id" => "enable_author_bio",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Show Related Posts?", "theme_textdomain"),
						"desc" => __("Check this to show related posts at the end of the post.", "theme_textdomain"),
						"id" => "enable_related_posts",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Related Post Type", "theme_textdomain"),
						"desc" => __("Select if you want to display posts by category or tag.", "theme_textdomain"),
						"id" => "related_post_type",
						"type" => "select",
						"options" => $options_related_posts);
						
	$options[] = array( "name" => __("No. of Related Posts", "theme_textdomain"),
						"desc" => __("Select how many related posts displayed at the end of the post.", "theme_textdomain"),
						"id" => "related_post_number",
						"std" => "4",
						"type" => "select",
						"options" => $options_numbers);
						
	//Portfolio Options
	$options[] = array( "name" => __("Portfolio Options", "theme_textdomain"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Portfolio Slider Autoplay", "theme_textdomain"),
						"desc" => "Choose the time between slider transitions or Disable Autoplay option.",
						"id" => "portfolio_slider_autoplay",
						"type" => "select",
						"options" => $options_slider_autoplay);
						
	$options[] = array( "name" => __("Transition Effect", "theme_textdomain"),
						"desc" => __("Choose the transition effect between diferent sliders.", "theme_textdomain"),
						"id" => "portfolio_transition_effect",
						"type" => "select",
						"options" => $options_transition_effect);						
						
	$options[] = array( "name" => __("Enable Lightbox?", "theme_textdomain"),
						"desc" => __("Check this to enable the lightbox effect for the portfolio items preview.", "theme_textdomain"),
						"id" => "enable_lightbox",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Enable Related Portfolio?", "theme_textdomain"),
						"desc" => __("Check this to enable the portfolio items related with the portfolio post.", "theme_textdomain"),
						"id" => "enable_related_portfolio",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Related Portfolio Title", "theme_textdomain"),
						"desc" => __("The title to related portfolio items.", "theme_textdomain"),
						"id" => "related_portfolio_title",
						"type" => "text");
						
	$options[] = array( "name" => __("No. of Related Portfolio Items", "theme_textdomain"),
						"desc" => __("Select how many related portfolio items displayed in the sidebar.", "theme_textdomain"),
						"id" => "related_portfolio_number",
						"std" => "3",
						"type" => "select",
						"options" => $options_numbers);
						
	//Styling Options
	$options[] = array( "name" => __("Styling Options", "theme_textdomain"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Theme Color", "theme_textdomain"),
						"desc" => __("Choose theme color (10 options available). Try it and enjoy!", "theme_textdomain"),
						"id" => "theme_color",
						"type" => "select",
						"options" => $options_color_theme);
						
	$options[] = array( "name" => __("Custom CSS", "theme_textdomain"),
						"desc" => __("Add your custom CSS.", "theme_textdomain"),
						"id" => "custom_css",
						"type" => "textarea");
						
											
	return $options;
}