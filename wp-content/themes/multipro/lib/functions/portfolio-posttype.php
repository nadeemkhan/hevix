<?php

/************************************************************/
//			CREATE PORTFOLIO POST TYPE
/************************************************************/

/* codex : 
   http://codex.wordpress.org/Function_Reference/register_post_type 
   http://codex.wordpress.org/Function_Reference/register_taxonomy	   
*/

/* Register post type */

function create_portfolio_post_type() 
{
	$labels = array(
		'name' => __( 'Portfolio' ),
		'singular_name' => __( 'Portfolio' ),
		'rewrite' => array('slug' => __( 'portfolios' )),
		'add_new' => _x('Add New', 'portfolio'),
		'add_new_item' => __('Add New Portfolio'),
		'edit_item' => __('Edit Portfolio'),
		'new_item' => __('New Portfolio'),
		'view_item' => __('View Portfolio'),
		'search_items' => __('Search Portfolio'),
		'not_found' =>  __('No portfolios found'),
		'not_found_in_trash' => __('No portfolios found in Trash'), 
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
	  
	  register_post_type(__( 'portfolio' ),$args);
}


/* Update messages */

function portfolio_updated_messages( $messages ) {

  $messages[__( 'portfolio' )] = 
  	array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Portfolio updated. <a href="%s">View portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Portfolio updated.'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Portfolio published. <a href="%s">View portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Portfolio saved.'),
		8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio</a>'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  
  return $messages;
  
}  


/* Register taxonomies */

function register_portfolio_taxonomies(){
	register_taxonomy(__( "portfolio-category" ), array(__( "portfolio" )), array("hierarchical" => true, "label" => __( "Portfolio Categories" ), "singular_label" => __( "Portfolio Category" ), "rewrite" => array('slug' => 'portfolio-category', 'hierarchical' => true)));
}

add_action( 'init', 'register_portfolio_taxonomies', 0 );
add_action( 'init', 'create_portfolio_post_type' );
add_filter('post_updated_messages', 'portfolio_updated_messages');
?>