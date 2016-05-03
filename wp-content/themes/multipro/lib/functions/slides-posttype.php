<?php

/************************************************************/
//			CREATE SLIDES POST TYPE
/************************************************************/

/* codex : 
   http://codex.wordpress.org/Function_Reference/register_post_type 
   http://codex.wordpress.org/Function_Reference/register_taxonomy	   
*/

/* Register post type */

function create_slides_post_type() 
{
	$labels = array(
		'name' => __( 'Slides' ),
		'singular_name' => __( 'Slides' ),
		'rewrite' => array('slug' => __( 'slides' )),
		'add_new' => _x('Add New', 'slides'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slide'),
		'not_found' =>  __('No slides found'),
		'not_found_in_trash' => __('No slides found in Trash'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields','excerpt', 'comments')
	  ); 
	  
	  register_post_type(__( 'slides' ),$args);
}


/* Update messages */

function slides_updated_messages( $messages ) {

  $messages[__( 'slides' )] = 
  	array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Slide updated. <a href="%s">View Slide</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Slide updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Slide restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Slide published. <a href="%s">View slide</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Slide saved.'),
		8 => sprintf( __('Slide submitted. <a target="_blank" href="%s">Preview slide</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Slide scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview slide</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Slide draft updated. <a target="_blank" href="%s">Preview slide</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  
  return $messages;
  
}  

add_action( 'init', 'create_slides_post_type' );
add_filter('post_updated_messages', 'slides_updated_messages');
?>