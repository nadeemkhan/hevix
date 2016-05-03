<?php
/*******************************************************************/
//						CUSTOM FIELDS
/*******************************************************************/

// Create a header option
$key = "key";

$meta_boxes = array(
	"title" => array(
		"name" => "heading",
		"title" => __('Heading', 'theme_textdomain'),
	),
	"desc" => array(
		"name" => "tagline",
		"title" => __('Tagline', 'theme_textdomain'),
	)
);

// Enable the meta boxes

function create_meta_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'new-meta-boxes', __('Heading &amp; Tagline', 'theme_textdomain'), 'display_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'new-meta-boxes', __('Heading &amp; Tagline', 'theme_textdomain'), 'display_meta_box', 'portfolio', 'normal', 'high' );
	}
}

// Create the meta boxes

function display_meta_box() {
	global $post, $meta_boxes, $key;
	?>

	<div class="form-wrap">
		<?php
		wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );

		foreach($meta_boxes as $meta_box) {
			$data = get_post_meta($post->ID, $key, true);
			?>
			<div class="form-field form-required">
			<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
			<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
			</div>
		<?php } ?>

	</div>
<?php
}

// Save custom fields

function save_meta_box( $post_id ) {
	global $post, $meta_boxes, $key;
	
	foreach( $meta_boxes as $meta_box ) {
		$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
	}
	
	if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $key, $data );
}

add_action( 'admin_menu', 'create_meta_box' );
add_action( 'save_post', 'save_meta_box' );
?>