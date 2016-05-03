<?php 
/* 
Plugin Name: Error Notification 
Plugin URI: http://tasko.us/ 
Version: 0.2.7
Author: Taras Dashkevych 
Description: This plugin gives an ability for your website visitors to notify you about any errors that have been found in your posts or pages.
Author URI: http://tasko.us/
*/

/* Do some actions when the plugin is activated */
register_activation_hook(__FILE__, 'error_notification_plugin_install');

/* Do some actions when the plugin is deactivated */
register_deactivation_hook( __FILE__, 'error_notification_plugin_remove' );

/* Plugin uninstalled */
if ( function_exists('register_uninstall_hook') ) { 
	register_uninstall_hook(__FILE__, 'error_notification_plugin_uninstall');
}

/* Function that does some work when plugin is uninstalled */
function error_notification_plugin_uninstall() { 
	delete_option('error_notification_options');
}

/* Function that does some work when plugin is activated */
function error_notification_plugin_install() {
	$error_notification_options = array(
		'bar_color' => 'dark',
		'bar_position' => 'bottom',
		'thx_msg' => 'Thank you very much for your help. We will fix it soon!',
		'action_button' => 'click here',
		'action_text' => 'If you found an error, highlight it and press <strong>Shift + Enter</strong> or <a href="#" class="enp-report"><strong>click here</strong></a> to inform us.',
		'action_text_color' => '#aaaaaa',
		'notification_emails' => get_bloginfo('admin_email'),
		'notification_emails_option' => 'wpemail',
		'exclude_posts_pages' => '',
		'custom_placement' => false,	
		'confirmation_box' => false,			
	);
	
	if( !get_option( 'error_notification_options' ) ) {
		add_option('error_notification_options', $error_notification_options);
	}
	
	/* Plugin Options */
	$notificationOptions = get_option('error_notification_options');
	
	if( !isset($notificationOptions['action_text_color']) ) {
		$notificationOptions['action_text_color'] = "#aaaaaa";
		update_option('error_notification_options', $notificationOptions);
	}	
	
}

/* Function that does some work when plugin is deactivated */
function error_notification_plugin_remove() {
	wp_deregister_script('error_notification_script');
}

/* Init plugin js file */
function error_notification_init() {
	if(!is_admin() && (!is_single() || !is_page() || !is_home() || !is_archive() || !is_category()) ) {
		wp_register_script('error_notification_script', plugins_url('/error_notification.js', __FILE__), array( 'jquery' ), null, true);
		wp_enqueue_script('error_notification_script');
	}
	
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker');
	
	/* Plugin Options */
	$notificationOptions = get_option('error_notification_options');
	
	/* Notification Bar Style */
	$barStyle = get_error_notification_plugin_style();
	
	/* Define javascript parameters */
	$error_notification_params =  array(
  		'ajaxurl' => admin_url("admin-ajax.php"),
  		'barBackground' => $barStyle["bg-color"],
  		'barPosition' => $notificationOptions['bar_position'],
  		'barTextColor' => $barStyle['text-color'],
  		'baseurl' => get_bloginfo('url'),
  		'confirmation' => $notificationOptions['confirmation_box'],
  		'cbTitle' => __( "Are you sure?", "enp" ),
  		'cbError' => __( "Error", "enp" ),
  		'cbOK' => __( "OK", "enp" ),
  		'cbCancel' => __( "Cancel", "enp" )
	);
	
	wp_localize_script( 'error_notification_script', 'enp', $error_notification_params );
}
add_action('init', 'error_notification_init');

/* Translations */
function myplugin_init() {
  load_plugin_textdomain( 'enp', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('plugins_loaded', 'myplugin_init');

/* Plugin admin css styling */
function error_notification_admin_style() {
	echo '
			<style>
				.en_container { width: 600px; float:left; background: #f9f9f9;}
				.en_container .header { background: #DA3610; padding:40px 20px; }
				.en_container .header h2 { font-size: 3em; text-transform:uppercase; color: #fff !important; text-shadow: none;}
				.en_container .header h2 span { font-weight: 300; font-size: 0.6em; color: #990000 !important;}
				.en_container .inner .title {position: relative; background: #f1f1f1; color: #fff; padding: 0; margin-top: 15px; margin-left:-20px; color: #1A1919; text-transform:uppercase; font-weight: 300;}
				.en_container .inner h4 {position: absolute; top: -5px; left: 45px;}
				.en_container .inner .title img {background: #1A1919; padding: 5px; width: 24px; margin-right: 20px;}
				.en_container .inner form {padding: 10px 25px;}
				.en_container .inner form input[type="text"], 
				.en_container .inner form select,
				.en_container .inner form button {border: none; -webkit-border-radius: 0; border-radius: 0;}
				
				.en_container .inner form .options {background: #eee; margin-top: 10px;}
				
				.en_container .inner form textarea {min-width: 92%; max-width: 92%; min-height: 140px; margin: 20px;}
				
				.en_container .inner form input[type="text"], 
				.en_container .inner form select {width: 85%; margin: 10px 5px 10px 10px; padding: 4px 7px;}
				.en_container .inner form button {background: #7F961E; padding: 0 7px; line-height: 24px; margin-top: 4px; margin-bottom: 4px; color: #fff;}
				.en_container .inner form button:hover {background: #b0d12c; cursor: pointer;}
				
				.en_support { width: 300px; background: #f4f4f4; color: #1A1919; font-weight: 300; float: left; }
				.en_support .inner {text-align: center;}
				.en_support .secret {height: 128px; background: #f9f9f9;}
				.en_support .inner, .en_container .inner {padding: 10px 20px 10px;}
				.en_support .inner h4 {background: #595550; color: #fff; padding: 10px 0; margin-right:-20px; border-right:20px solid #DA3610; text-transform:uppercase; font-weight: 300;}
			</style>
		 ';
}
add_action( 'admin_head', 'error_notification_admin_style' );

/* Plugin additional javascript */
function error_notification_admin_scripts() { 
	echo '	<script type="text/javascript">
				jQuery(document).ready(function($){
    				$("#en-action-text-color").wpColorPicker();
				});
			</script>
		 ';
}
add_action('in_admin_footer', 'error_notification_admin_scripts');

/* Add plugin to dashboard menu */
function error_notification_plugin_menu() {
	add_options_page('Error Notification Settings', 'Error Notification', 'manage_options', 'error_notification_page', 'error_notification_plugin_page');
}
add_action('admin_menu', 'error_notification_plugin_menu');

/* This is plugin page that you can find in your admin panel (Dashboard) */
function error_notification_plugin_page() {
	/* Plugin Options */
	$notificationOptions = get_option('error_notification_options');
	
	/* Save notification bar color */
	if (isset($_POST['en_bar_color'])) {
		$notificationOptions['bar_color'] = sanitize_text_field($_POST['bar_color']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save "thank you" message */
	} else if (isset($_POST['en_thx_msg'])) {
		$notificationOptions['thx_msg'] = sanitize_text_field($_POST['thx-message']);
		update_option('error_notification_options', $notificationOptions);
	
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save notification bar position */
	} else if(isset($_POST['en_bar_possition'])) {
		$notificationOptions['bar_position'] = sanitize_text_field($_POST['bar_position']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save button title for a link (fron-end action text) */
	} else if(isset($_POST['en_click_btn'])) {
		$tempButtonTitle = $notificationOptions['action_button'];
		
		$notificationOptions['action_button'] = sanitize_text_field($_POST['click-button']);
		
		$actionText = $notificationOptions['action_text'];
		$actionText = str_replace('<a href="#" class="enp-report"><strong>'.$tempButtonTitle.'</strong></a>', '<a href="#" class="enp-report"><strong>'.$notificationOptions['action_button'].'</strong></a>', $actionText);
		
		$notificationOptions['action_text'] = $actionText;
		
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save front-end text action */
	} else if(isset($_POST['en_action_text'])) {
		$input = sanitize_text_field($_POST['action-text']);
		
		/*find button position*/
		$buttonPosition = strpos($input, '[button]');
			  
		/*find combination position*/
		$combinationPosition = strpos($input, '[combination]');
		
		if ($buttonPosition === false || $combinationPosition === false) {
   			echo '<div class="wrap"><div id="message" class="error"><p>Button or Combination is missing.</p></div></div>'; 
		} else {
    		$input = str_replace('[button]', '<a href="#" class="enp-report"><strong>'.$notificationOptions['action_button'].'</strong></a>', $input);
    		$input = str_replace('[combination]', '<strong>Shift + Enter</strong>', $input);
    		$notificationOptions['action_text'] = $input;
			update_option('error_notification_options', $notificationOptions);
    		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
		}
	
	/* Save email option */
	} else if(isset($_POST['en_email_options'])) {
		$newEmailOption = sanitize_text_field($_POST['email_options']);
		$notificationOptions['notification_emails_option'] = $newEmailOption;
		
		/* Update Options */
		switch ($newEmailOption) {
    		case "wpemail":
        		$notificationOptions['notification_emails'] = get_bloginfo('admin_email');
        		break;
			case "wpppaemail":
				$notificationOptions['notification_emails'] = get_bloginfo('admin_email');
				break;
		}
		
		update_option('error_notification_options', $notificationOptions);

		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 	
	
	/* Save custom emails */
	} else if(isset($_POST['en_custom_emails'])) {
		$notificationOptions['notification_emails'] = sanitize_text_field($_POST['custom-emails']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save excluded ids */
	} else if(isset($_POST['en_exclude_ids'])) {
		$notificationOptions['exclude_posts_pages'] = sanitize_text_field($_POST['exclude-ids']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save custom placement option */
	} else if(isset($_POST['en_custom_placement'])) {
		$notificationOptions['custom_placement'] = sanitize_text_field($_POST['custom_placement']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	
	/* Save confirmation box option */
	} else if(isset($_POST['en_confirmation_box'])) {
		$notificationOptions['confirmation_box'] = sanitize_text_field($_POST['confirmation_box']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>';
		
	/* Save action text color option */ 
	} else if(isset($_POST['en_action_text_color'])) {
		//$notificationOptions['confirmation_box'] = sanitize_text_field($_POST['confirmation_box']);
		update_option('error_notification_options', $notificationOptions);
		
		echo '<div class="wrap"><div id="message" class="updated"><p>Error Notification Plugin was updated.</p></div></div>'; 
	}
	
		
		/* Form options for Bar Position*/
		$barPositionOptions = error_notification_bar_position();
		
		/* Form options for Bar Color */
		$barColorOptions = get_error_notification_plugin_style();
		
		/* Form options for email options */
		$emailOptions = error_notification_email_options_form();
		
		/* Form options for custom placement */
		$customPlacementOptions = error_notification_onoff_options_form($notificationOptions['custom_placement']);
		
		/* Form options for confirmation */
		$confirmationOptions = error_notification_onoff_options_form($notificationOptions['confirmation_box']);
		
		/* Textarea for custom emails */
		if($notificationOptions['notification_emails_option'] === 'customemail' || 
		   $notificationOptions['notification_emails_option'] === 'pacustomemail') {
			$customEmailsForm = '
						<form method="POST" action="">
    						<label>
    							Please enter email address(es) you would like to be able to receive email notifications:
    							<i>If you want to have multiple email addresses, make sure you separate them by comma.</i>
    						</label>
    						<div class="options">
    							<textarea name="custom-emails">'.$notificationOptions['notification_emails'].'</textarea>
    							<button type="submit" name="en_custom_emails" style="float: right;">SAVE</button>
    							<div style="clear: both;"></div>
    						</div>
    					</form>';
		} else {
			$customEmailsForm = "";
		}
		
		echo '<div class="wrap">
				<div class="en_container">
					<div class="header">
    					<h2>Error <span>Notification</span></h2>
  					</div>
  					
  					<div class="inner">
  						<div class="title">
  							<img src="'.plugins_url( 'img/settings.png' , __FILE__ ).'">
  							<h4>General Settings</h4>
  						</div>
				
  						<form method="POST" action="">
    						<label>Hide default action text:</label>
    						<p class="options">
    							<select name="custom_placement">
    								'.$customPlacementOptions.'
    							</select>
    							<button type="submit" name="en_custom_placement">SAVE</button>
    						</p>
    						<p><strong>Include action text via PHP:</strong> <i>&lt;?php echo error_notification_action_text(); ?&gt;</i></p>
    					</form>
  						
  						<form method="POST" action="">
    						<label>Confirmation box:</label>
    						<p class="options">
    							<select name="confirmation_box">
    								'.$confirmationOptions.'
    							</select>
    							<button type="submit" name="en_confirmation_box">SAVE</button>
    						</p>
    					</form>
  						
    				</div>
  					
  					<div class="inner">
  						<div class="title">
  							<img src="'.plugins_url( 'img/settings.png' , __FILE__ ).'">
  							<h4>Email Settings</h4>
  						</div>
				
  						<form method="POST" action="">
    						<label>Who will receive email notification?:</label>
    						<p class="options">
    							<select name="email_options">
    								'.$emailOptions.'
    							</select>
    							<button type="submit" name="en_email_options">SAVE</button>
    						</p>
    					</form>
    					
    					'.$customEmailsForm.'
  						
    				</div>
  					
  					<div class="inner">
  						<div class="title">
  							<img src="'.plugins_url( 'img/settings.png' , __FILE__ ).'">
  							<h4>Notification Bar Settings</h4>
  						</div>
  							
  						<form method="POST" action="">
    						<label>Choose position for your notification bar:</label>
    						<p class="options">
    							<select name="bar_position">
    								'.$barPositionOptions.'
    							</select>
    							<button type="submit" name="en_bar_possition">SAVE</button>
    						</p>
    					</form>
    					
    					<form method="POST" action="">
    						<label>Choose color for your notification bar:</label>
    						<p class="options">
    							<select name="bar_color">
    								'.$barColorOptions["form-options"].'
    							</select>
    							<button type="submit" name="en_bar_color">SAVE</button>
    						</p>
    					</form>
    					
    				</div>
    				
    				<div class="inner">
  						<div class="title">
  							<img src="'.plugins_url( 'img/settings.png' , __FILE__ ).'">
  							<h4>"Thank You" message Settings</h4>
  						</div>
  							
  						<form method="POST" action="">
    						<label>Please enter your "Thank You" message:</label>
    						<div class="options">
    							<textarea name="thx-message" maxlength="2500">'.$notificationOptions['thx_msg'].'</textarea>
    							<button type="submit" name="en_thx_msg" style="float: right;">SAVE</button>
    							<div style="clear: both;"></div>
    						</div>
    					</form>
    					
    				</div>
    				
    				<div class="inner">
  						<div class="title">
  							<img src="'.plugins_url( 'img/settings.png' , __FILE__ ).'">
  							<h4>Front-End Action Text Settings</h4>
  						</div>
  						
  						<form method="POST" action="">
    						<label>Please enter your button title:</label>
    						<div class="options">
    							<input type="text" name="click-button" value="'.$notificationOptions['action_button'].'">
    							<button type="submit" name="en_click_btn">SAVE</button>
    						</div>
    					</form>
    					
    					<form method="POST" action="">
    						<label>Please enter your front-end action text: <i>see example below</i></label>
    						<div class="options">
    							<textarea name="action-text" maxlength="1500"></textarea>
    							<button type="submit" name="en_action_text" style="float: right;">SAVE</button>
    							<div style="clear: both; padding: 10px 20px">
    								<p><strong>EXAMPLE</strong></p>
    								<p><strong>Textarea: </strong> If you found an error, highlight it and press [combination] or [button] to inform us.</p>
    								<p><strong>Output: </strong>If you found an error, highlight it and press <strong>Shift + E</strong> or <a href="#"><strong>click here</strong></a> to inform us.</p>
    							</div>
    						</div>
    					</form>
    					
    					<form method="POST" action="">
    						<label>Front-end action text color:</label>
    						<p><input type="text" id="en-action-text-color" name="action-text-color" value="'.$notificationOptions['action_text_color'].'" data-default-color="#effeff" /></p>
    						<div class="options" style="padding: 5px;">
    							<button type="submit" name="en_action_text_color" style="margin: 0 auto; display: block;">SAVE</button>
    						</div>
    					</form>
    					
    				</div>
    				
    				<div class="inner">
  						<div class="title">
  							<img src="'.plugins_url( 'img/settings.png' , __FILE__ ).'">
  							<h4>Posts/Pages Settings</h4>
  						</div>
  							
  						<form method="POST" action="">
    						<label>Please enter post/page ID that you want to exclude:<i>If you want to have multiple IDs, make sure you separate them by comma.</i></label>
    						<div class="options">
    							<textarea name="exclude-ids" maxlength="2500">'.$notificationOptions['exclude_posts_pages'].'</textarea>
    							<button type="submit" name="en_exclude_ids" style="float: right;">SAVE</button>
    							<div style="clear: both;"></div>
    						</div>
    					</form>
    					
    				</div>
				</div>
				<div class="en_support">
					<div class="secret"></div>
    				<div class="inner">
    					<p>By the way, do you know that I build themes very often? You can subscribe to my newsletter and I will keep you up-to-date with news about my themes and special deals or updates.</p>
    					<a href="http://gmail.us4.list-manage1.com/subscribe?u=ddadd81989a5a1476985020d7&id=60f57c76a1" target="_blank">Subscribe</a>
    				</div>
    				<div class="inner">
    					<h4>Rating</h4>
    					<h3><a href="http://wordpress.org/support/view/plugin-reviews/error-notification?filter=5" target="_blank">Rate</a> this plugin <a href="http://wordpress.org/support/view/plugin-reviews/error-notification?filter=5" style="text-decoration: none;" target="_blank"><span style="color: #ffff00; background: black; padding: 3px;"> &#9733; &#9733; &#9733; &#9733; &#9733;</span></a></h3>
    				</div>
    				<div class="inner">
    					<h4>Article</h4>
    					<h3>Tell others about this plugin on your website.</h3>
    				</div>
 	 			</div>

				<div style="clear: both;"></div>
			  </div>';

}

/* Add plugin to the front */
function error_notification_plugin_front_page($content) {
	global $post;
	/* Plugin Options */
	$notificationOptions = get_option('error_notification_options');
	
	/* Get Custom Placement Value */
	$isCustomPlacement = $notificationOptions['custom_placement'];
	
	/* Array of excluded IDs */
	$excludedIDs = array_map('intval', explode(',', $notificationOptions['exclude_posts_pages']));
	
	if(!is_feed() && !is_home() && !in_array($post->ID, $excludedIDs)) {
		if(!$isCustomPlacement) { 
			$content .= '
							<p style=" color: #999999;">'.$notificationOptions['action_text'].'</p>
						';
		}

	}
	return $content;
}
add_filter('the_content', 'error_notification_plugin_front_page');

/* Return Post id */
function error_notification_post_id_front_page() {
	global $post;
	/* Plugin Options */
	$notificationOptions = get_option('error_notification_options');
	
	/* Array of excluded IDs */
	$excludedIDs = array_map('intval', explode(',', $notificationOptions['exclude_posts_pages']));
	
	if(!is_feed() && !is_home() && !in_array($post->ID, $excludedIDs)) { 
		$content = '
						<div id="error-notification-id" class="enp-'.$post->ID.'"></div>
						<div id="error-notification-settings" style="display: none;"><p>'.$notificationOptions["thx_msg"].'</p></div>
				   ';
		echo $content;
	}
}
add_action('wp_footer', 'error_notification_post_id_front_page');

/* This function returns action text (front-end) */
function error_notification_action_text() {
	global $post;
	/* Plugin Options */
	$notificationOptions = get_option('error_notification_options');
	
	/* Array of excluded IDs */
	$excludedIDs = array_map('intval', explode(',', $notificationOptions['exclude_posts_pages']));
	
	if(!is_feed() && !is_home() && !in_array($post->ID, $excludedIDs)) {
		$content = '
						<p style=" color: #999999;">'.$notificationOptions['action_text'].'</p>
						<div id="error-notification-settings" style="display: none;"><p>'.$notificationOptions["thx_msg"].'</p></div>
					';
					
		$content .= '
						<div id="error-notification-id" class="enp-'.$post->ID.'"></div>
					';
	}
	
	return $content;
}

/* Returns notification background color */
function get_error_notification_plugin_style() {
	$notificationOptions = get_option('error_notification_options');
	
	/* Temporary container */
	$styleContainer = array();
	
	switch ($notificationOptions['bar_color']) {
		case "light":
			$styleContainer['form-options'] = '
				<option value="light" selected>Light</option>
				<option value="dark">Dark</option>
				<option value="blue">Blue</option>
				<option value="red">Red</option>
				<option value="yellow">Yellow</option>
				<option value="green">Green</option>
			';
			
			$styleContainer['bg-color'] = "#E5E5E5";
			$styleContainer['text-color'] = '#191919';
			
			return $styleContainer;
			break;
		case "dark":
			$styleContainer['form-options'] = '
				<option value="light">Light</option>
				<option value="dark" selected>Dark</option>
				<option value="blue">Blue</option>
				<option value="red">Red</option>
				<option value="yellow">Yellow</option>
				<option value="green">Green</option>
			';
			
			$styleContainer['bg-color'] = "#0C132E";
			$styleContainer['text-color'] = '#ffffff';
			
			return $styleContainer;
			break;
		case "blue":
			$styleContainer['form-options'] = '
				<option value="light">Light</option>
				<option value="dark">Dark</option>
				<option value="blue" selected>Blue</option>
				<option value="red">Red</option>
				<option value="yellow">Yellow</option>
				<option value="green">Green</option>
			';
			
			$styleContainer['bg-color'] = "#0099cc";
			$styleContainer['text-color'] = '#ffffff';
		
			return $styleContainer;
			break;
		case "red":
			$styleContainer['form-options'] = '
				<option value="light">Light</option>
				<option value="dark">Dark</option>
				<option value="blue">Blue</option>
				<option value="red" selected>Red</option>
				<option value="yellow">Yellow</option>
				<option value="green">Green</option>
			';
			
			$styleContainer['bg-color'] = "#cc3333";
			$styleContainer['text-color'] = '#ffffff';
		
			return $styleContainer;
			break;
		case "yellow":
			$styleContainer['form-options'] = '
				<option value="light">Light</option>
				<option value="dark">Dark</option>
				<option value="blue">Blue</option>
				<option value="red">Red</option>
				<option value="yellow" selected>Yellow</option>
				<option value="green">Green</option>
			';
			
			$styleContainer['bg-color'] = "#ffff00";
			$styleContainer['text-color'] = '#191919';
			
			return $styleContainer;
			break;
		case "green":
			$styleContainer['form-options'] = '
				<option value="light">Light</option>
				<option value="dark">Dark</option>
				<option value="blue">Blue</option>
				<option value="red">Red</option>
				<option value="yellow">Yellow</option>
				<option value="green" selected>Green</option>
			';
			
			$styleContainer['bg-color'] =  "#669900";
			$styleContainer['text-color'] = '#ffffff';
			
			return $styleContainer;
			break;
		default:
			$styleContainer['form-options'] = '
				<option value="light">Light</option>
				<option value="dark" selected>Dark</option>
				<option value="blue">Blue</option>
				<option value="red">Red</option>
				<option value="yellow">Yellow</option>
				<option value="green">Green</option>
			';
			
			$styleContainer['bg-color'] = "#0C132E";
			$styleContainer['text-color'] = '#ffffff';
			
			return $styleContainer;
			break;
	}
}

/* get position of notification bar*/
function error_notification_bar_position() {
	$notificationOptions = get_option('error_notification_options');
	switch ($notificationOptions['bar_position']) {
		case "top":
			return '<option value="top" selected>Top</option><option value="bottom">Bottom</option>';
			break;
		case "bottom":
			return '<option value="top">Top</option><option value="bottom" selected>Bottom</option>';
			break;
		default:
			return '<option value="top">Top</option><option value="bottom" selected>Bottom</option>';
			break;
	}
}

/* This function returns options for form */
function error_notification_email_options_form() {
	$notificationOptions = get_option('error_notification_options');
	switch ($notificationOptions['notification_emails_option']) {
		case "wpemail":
			return '
						<option value="wpemail" selected>Wordpress Admin</option>
						<option value="wpppaemail">Wordpress Admin & Post/Page Author</option>
						<option value="pacustomemail">Post/Page Author & Custom Emails</option>
    					<option value="customemail">Custom</option>
    				';
			break;
		case "wpppaemail":
			return '
						<option value="wpemail">Wordpress Admin</option>
						<option value="wpppaemail" selected>Wordpress Admin & Post/Page Author</option>
						<option value="pacustomemail">Post/Page Author & Custom Emails</option>
    					<option value="customemail">Custom</option>
					';
			break;
		case "pacustomemail":
			return '
						<option value="wpemail">Wordpress Admin</option>
						<option value="wpppaemail">Wordpress Admin & Post/Page Author</option>
						<option value="pacustomemail" selected>Post/Page Author & Custom Emails</option>
    					<option value="customemail">Custom</option>
					';
			break;
		case "customemail":
			return '
						<option value="wpemail">Wordpress Admin</option>
						<option value="wpppaemail">Wordpress Admin & Post/Page Author</option>
						<option value="pacustomemail">Post/Page Author & Custom Emails</option>
    					<option value="customemail" selected>Custom</option>
					';
			break;
		default:
			return '
						<option value="wpemail" selected>Wordpress Admin</option>
						<option value="wpppaemail">Wordpress Admin & Post/Page Author</option>
						<option value="pacustomemail">Post/Page Author & Custom Emails</option>
    					<option value="customemail">Custom</option>
    				';
			break;
	}
}

/* This function returns options for form (with on/off) */
function error_notification_onoff_options_form($options) {
	switch ($options) {
		case 1:
			return '
						<option value="1" selected>On</option>
						<option value="0">Off</option>
    				';
			break;
		case 0:
			return '
						<option value="1">On</option>
						<option value="0" selected>Off</option>
					';
			break;
		default:
			return '
						<option value="1">On</option>
						<option value="0" selected>Off</option>
					';
			break;
	}
}

/* 
  This function sends email notifications 
  @param - $array
  	- [0] = pageName => ''
  	- [1] = pageUrl=> ''
  	- [2] = pageError => ''
  	- [3] = pageWpId = ''
*/
function error_notification_send($get) {
	/* Plugin Options*/
	$notificationOptions = get_option('error_notification_options');

	/* Email notification Sending options */
	$sendingOption = $notificationOptions['notification_emails_option'];
	
	/* Email Subject */
 	$subject = "Error Notification" . " - " . get_bloginfo('name');
 	
 	/* Email Message */
 	$message = "A visitor found an error on your website \n\n";
 	$message .= "Page Title: " . $get[pageName] . "\n";
 	$message .= "Page URL: " . $get[pageUrl] . "\n";
 	$message .= "Error: " . $get[pageError] . "\n";
 	$message .= "Date: " . date("F j, Y, g:i a") . "\n";	

	if($sendingOption === 'pacustomemail') {
		/* Get Post/Page info */
 		$postPageInfo = get_post($get[pageWpId]);
 	
 		/* Get author info */
 		$authorInfo = get_user_by('id', $postPageInfo->post_author);
 		
 		/* Temporary array with emails that we need for sending notifications */
		$tempArray =  explode(",",$notificationOptions['notification_emails']);
		
		/* Add Post/Page Author to this array */
		if(!in_array($authorInfo->user_email, $tempArray)) {
			$tempArray[] = $authorInfo->user_email;
		}
		
		/* send email notification to admin and author */
		foreach($tempArray as $emailAddress) {
			$result = wp_mail($emailAddress, $subject, $message);
		}
		
		return $result;
 		
	} else if($sendingOption === 'wpppaemail') {
		/* Get Post/Page info */
 		$postPageInfo = get_post($get[pageWpId]);
 	
 		/* Get author info */
 		$authorInfo = get_user_by('id', $postPageInfo->post_author);
 		
 		/*check if author's email not the same as admin's email*/
 		if($notificationOptions['notification_emails'] !== $authorInfo->user_email) {
 			/* Temporary array with emails that we need for sending notifications */
 			$tempArray = array($notificationOptions['notification_emails'], $authorInfo->user_email);
 			
 			/* send email notification to admin and author */
 			foreach($tempArray as $emailAddress) {
 				$result = wp_mail($emailAddress, $subject, $message);
 			}
 			
 			return $result;
 			
 		} else {
 			/* send email notification */
			$result = wp_mail($authorInfo->user_email, $subject, $message);
			
			return $result;
 		}
	} else if($sendingOption === 'customemail') {
		/* Temporary array with emails that we need for sending notifications */
		$tempArray =  explode(",",$notificationOptions['notification_emails']);
		
		/* send email notification to admin and author */
 		foreach($tempArray as $emailAddress) {
 			$emailAddress = trim($emailAddress);
 			/* check if value is not empty */
 			if(!empty($emailAddress) && is_email($emailAddress)) {
 				$result = wp_mail($emailAddress, $subject, $message);
 			} 
 		}
 		
 		return $result;
	} else {
		/* email address where we will send notification */
		$emailAddress = $notificationOptions['notification_emails'];
		
		/* send email notification */
		$result = wp_mail($emailAddress, $subject, $message);
		
		return $result;
	}
}

/* Process AJAX. Send Email */
function error_notification_process_ajax() {
 
 	/* Text that was selected by the visitor */
 	$errorText = sanitize_text_field($_POST['pageError']);
 	
 	/* Web Page name where an error was found */
 	$errorPage = sanitize_text_field($_POST['pageName']);
 	
 	/* Web Page URL where an error was found */
 	$errorUrl = esc_url($_POST['pageUrl']);
 	
 	/* Current Post/Page ID */
 	$currentPPID = intval(substr(sanitize_text_field($_POST['postPageID']), 4));

	/* Send email notification */
 	$notificationInformation = array('pageName'=>$errorPage,'pageUrl'=>$errorUrl,'pageError'=>$errorText, 'pageWpId'=>$currentPPID);
	$result = error_notification_send($notificationInformation);
	
	/* return the result */
	echo $result;
	
	die();
}
add_action('wp_ajax_error_notification_email', 'error_notification_process_ajax');
add_action('wp_ajax_nopriv_error_notification_email', 'error_notification_process_ajax');

?>