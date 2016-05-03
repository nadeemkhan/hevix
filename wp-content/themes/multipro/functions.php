<?php

/* Init */
require_once(TEMPLATEPATH . '/lib/functions/init-functions.php');
/* Custom fields */
require_once(TEMPLATEPATH . '/lib/functions/custom-fields.php');
/* Resize Images */
require_once(TEMPLATEPATH . '/lib/functions/resize-images.php');
/* Portfolio post type */
require_once(TEMPLATEPATH . '/lib/functions/portfolio-posttype.php');
/* Portfolio custom fields */
require_once(TEMPLATEPATH . '/lib/functions/portfolio-fields.php');
/* Slide post type */
require_once(TEMPLATEPATH . '/lib/functions/slides-posttype.php');
/* Slides custom fields */
require_once(TEMPLATEPATH . '/lib/functions/slides-fields.php');
/* Embed Video */
require_once(TEMPLATEPATH . '/lib/functions/embed-video.php');
/* Embed Widgets */
require_once(TEMPLATEPATH . '/lib/functions/load-widgets.php');
/* Shortcodes */
require_once(TEMPLATEPATH . '/lib/functions/shortcodes.php');

if ( !function_exists( 'optionsframework_init' ) ) {

/*******************************************************************/
//						FRAMEWORK OPTIONS
/*******************************************************************/

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
} else {
	define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
}

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}


function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}

function vk_likes($url, $api_id) {
  $html = @file_get_contents("http://vk.com/widget_like.php?app={$api_id}&url=".urlencode($url)."&type=button");
  preg_match('#<span id="stats_num">([0-9]+)</span>#', $html, $matches);
  return (count($matches) > 1) ? intval($matches[1]) : false;
}

add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );