<?php
/*******************************************************************/
//						SLIDES FIELDS
/*******************************************************************/

$slides_key = 'slide_video';
$meta_box_slide_videos = array(
				array(
						'name' => 'vimeo-youtube',
						'title' => __('YouTube or Vimeo : Video URL', 'theme_textdomain'),
					),	
				array(
						'name' => 'embedded-code',
						'title' => __('Other plataforms : Embedded Code', 'theme_textdomain'),
					),	
				);
				
function create_slides_meta_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'slides-video-boxes', __('Video Settings', 'theme_textdomain'), 'display_slide_video_box', 'slides', 'normal', 'high' );
	}
}

function display_slide_video_box() {
	global $post, $meta_box_slide_videos, $slides_key;
	?>

	<div class="form-wrap">
			<?php
			wp_nonce_field( plugin_basename( __FILE__ ), $slides_key . '_wpnonce', false, true );
			foreach($meta_box_slide_videos as $meta_box) {
				$data = get_post_meta($post->ID, $slides_key, true);
				?>
				<div class="form-field form-required">
				<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
				<input type="textarea" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" />
				</div>
			<?php } ?>
	
		</div>
<?php
}

// Save custom fields

function save_slides_meta_box( $post_id ) {
	global $post, $meta_box_slide_videos, $slides_key;
	
	foreach( $meta_box_slide_videos as $meta_box ) {
		$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
	}
	
	if ( !wp_verify_nonce( $_POST[ $slides_key . '_wpnonce' ], plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $slides_key, $data );
}

add_action( 'admin_menu', 'create_slides_meta_box' );
add_action( 'save_post', 'save_slides_meta_box' );

?>