<?php
/*
Plugin Name: Сообщить об ошибке
Plugin URI: http://prihod.ru
Description: Cообщения об опечатках или ошибках, замеченных на ваших сайтах.
Author: ortox
Author URI: http://prihod.ru
Version: 1.0.1
*/ 

define( 'RERR__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RERR__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( RERR__PLUGIN_DIR . '/inc/class.main.php' );
require_once( RERR__PLUGIN_DIR . '/inc/class.widget.php' );

add_action( 'admin_init', 'RERRRegisterSettings' );
add_action( 'widgets_init', create_function( '', 'register_widget( "Report_an_Error" );' ) );

add_action('init', 'RERR_init', 0);
function RERR_init() {
        load_plugin_textdomain("RERR", false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'  );
}

wp_enqueue_script( 'jquery' );

function RERRRegisterSettings(){
  register_setting( 'RERRSettingsGroup', 'RERRAccauntMail' );
}

if (class_exists("RERR")) {$RERR_obj = new RERR();
}


// зарегистрируем тригер и переменную для фоновой отправки 
add_filter('query_vars','RERR_add_trigger');
function RERR_add_trigger($vars) {
    $vars[] = 'RERR';
    return $vars;
}
 
add_action('template_redirect', 'RERR_trigger_check');
function RERR_trigger_check() {

    if(get_query_var('RERR') == 'send' and isset($_POST['txt'])) {

    	$RERRAccauntMail  = (get_option('RERRAccauntMail') ? esc_attr(get_option('RERRAccauntMail')): '');
		$array_emails = explode(",", $RERRAccauntMail);
		$_error = "";

		$selection 	= htmlspecialchars(esc_attr($_POST['txt']));
		$comment 	= htmlspecialchars(esc_attr($_POST['err']));
		$page 		= htmlspecialchars(esc_attr($_POST['url']));
	
		$error = "";
		$count = count($array_emails);
		$error_count = 0;
		
		foreach ($array_emails as $value) {
			if(is_email(trim($value))){
				$headers[] = 'From: '.$value;
				$headers[] = 'content-type: text/html';
			
				$message = "<b>".__('Selection:','RERR')."</b><br>".$selection."<br><br><b>".__('Comment:','RERR')."</b><br>".$comment."<br><br><b>".__('Page:','RERR')."</b><br>".$page."<br><br><hr><em>".date('d.m.Y H:i:s', time())."<br>IP: <b>". $_SERVER['REMOTE_ADDR']."</b><br>".$_SERVER['HTTP_USER_AGENT']."</em>";
				$error = wp_mail( trim($value), __('Report an error','RERR')." : ".$page, $message, $headers );

				if($error==false){

					$error_count++;
				}
			}
		}

		echo '{"result":  "'.($error_count>0 ? "notok":"ok").'","message": "'.__('Thank you, error data sent!','RERR').'","error": "'.__('Error while sending the message to support!','RERR').' (#'.$error_count.':'.$count.')"}';
    exit;
    }
}