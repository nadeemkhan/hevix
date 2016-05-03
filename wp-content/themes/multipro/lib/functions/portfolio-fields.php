<?php
/*******************************************************************/
//						PORTFOLIO FIELDS
/*******************************************************************/

$img_key = 'portfolio_imgs';
$video_key = 'portfolio_video';
$meta_box_imgs = array(
				array(
						'name' => 'image-1',
						'title' => __('Image 1', 'theme_textdomain'),
					),
				array(
						'name' => 'image-2',
						'title' => __('Image 2', 'theme_textdomain'),
					),
				array(
						'name' => 'image-3',
						'title' => __('Image 3', 'theme_textdomain'),
					),
				array(
						'name' => 'image-4',
						'title' => __('Image 4', 'theme_textdomain'),
					),	
				);
$meta_box_videos = array(
				array(
						'name' => 'vimeo-youtube',
						'title' => __('YouTube or Vimeo : Video URL', 'theme_textdomain'),
					),	
				array(
						'name' => 'embedded-code',
						'title' => __('Other plataforms : Embedded Code', 'theme_textdomain'),
					),	
				);


// Enable the meta boxes

function create_portfolio_meta_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'portfolio-imgs-boxes', __('Slider Portfolio Images', 'theme_textdomain'), 'display_portfolio_img_box', 'portfolio', 'normal', 'high' );
		add_meta_box( 'portfolio-video-boxes', __('Video Settings', 'theme_textdomain'), 'display_portfolio_video_box', 'portfolio', 'normal', 'high' );
	}
}

function display_portfolio_img_box(){
	global $post, $meta_box_imgs, $img_key;	

	?>

	<div class="form-wrap">
		<p>Recommended Size: 600*450px</p>
		<?php
		wp_nonce_field( plugin_basename( __FILE__ ), $img_key . '_wpnonce', false, true );
		$i=0;
		foreach($meta_box_imgs as $meta_box) {
			$data = get_post_meta($post->ID, $img_key, true);
			$i++;
			?>
			<div class="form-field form-required">
			<label for="<?php echo $meta_box[ 'name' ]; ?>"><?php echo $meta_box[ 'title' ]; ?></label>
			<input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?>" style="width:85%; margin-right: 20px;" id="upload_image_<?php echo $i; ?>" />
			<input type="button" class="button" id="upload_image_button_<?php echo $i; ?>" name="upload_image_button" value="Browse" style="width:5%" />
			</div>
		<?php } ?>

	</div>
<?php
}


function display_portfolio_video_box(){
	global $post, $meta_box_videos, $video_key;	

	?>

	<div class="form-wrap">
		<?php
		wp_nonce_field( plugin_basename( __FILE__ ), $video_key . '_wpnonce', false, true );
		foreach($meta_box_videos as $meta_box) {
			$data = get_post_meta($post->ID, $video_key, true);
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

function save_portfolio_meta_box( $post_id ) {
	global $post, $meta_box_imgs, $meta_box_videos, $img_key, $video_key;
	
	// images
	foreach( $meta_box_imgs as $meta_box ) {
		$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
	}
	
	if ( !wp_verify_nonce( $_POST[ $img_key . '_wpnonce' ], plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $img_key, $data );
	
	// video
	foreach( $meta_box_videos as $meta_box ) {
		$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
	}
	
	if ( !wp_verify_nonce( $_POST[ $video_key . '_wpnonce' ], plugin_basename(__FILE__) ) )
		return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
		return $post_id;
	
	update_post_meta( $post_id, $video_key, $data );
}

// Queue Scripts

function portfolio_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('upload-img', get_template_directory_uri() . '/lib/functions/js/upload-img.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('upload-img');
}

add_action( 'admin_menu', 'create_portfolio_meta_box' );
add_action( 'save_post', 'save_portfolio_meta_box' );
add_action('admin_print_scripts', 'portfolio_admin_scripts');
?>