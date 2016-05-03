<?php
/*
Plugin Name: VK Image
Plugin URI: http://ajayver.com
Description: Forces vk.com to use the first image from post while sharing a link.
Version: 1.1
Author: ajayver
Author URI: http://ajayver.com
*/

add_action('wp_head', 'add_image_for_vk');

function add_image_for_vk() {
	$image = get_option('vk_default_image');
	if (is_single()) {		
		global $post; 
		$current_post = get_post( $post->ID );
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $current_post->post_content, $matches);
		if (!empty($matches[1][0])) $image = $matches[1][0];	
	}

	if(!empty($image)) {
		echo "<!-- Added by VK Image Plugin -->\n";
		echo '<link rel="image_src" href="' . $image . '" />' . "\n";
	}
	
	
}

include( plugin_dir_path( __FILE__ ) . 'admin.php');
?>