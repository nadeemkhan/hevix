<?php
// create custom plugin settings menu
add_action('admin_menu', 'vk_image_options');

function vk_image_options() {

	//call register settings function
	add_action( 'admin_init', 'register_vk_image_settings' );

    add_options_page( 'VK Image', 'VK Image', 'manage_options', 'vk_image', 'vk_image_settings_page' );
}


function register_vk_image_settings() {
	//register our settings
	register_setting( 'vk-image-settings-group', 'vk_default_image' );
}

function vk_image_settings_page() {
?>
<div class="wrap">
    <?php screen_icon(); ?>
    <h2>VK Image</h2>

    <form method="post" action="options.php">
        <?php settings_fields( 'vk-image-settings-group' ); ?>
        <?php //do_settings( 'vk-image-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Default Image Url</th>
            <td><input type="text" name="vk_default_image" value="<?php echo get_option('vk_default_image'); ?>" /></td>
            </tr>
        </table>
        
        <?php submit_button(); ?>

    </form>
</div>
<?php } ?>