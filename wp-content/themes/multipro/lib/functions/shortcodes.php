<?php

/*******************************************************************/
//						SHORTCODES
/*******************************************************************/

//big button shortcode
function pi_button($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'position' => 'left',
	      ), $atts ) );
	return '<a href="'.$url.'" target="'.$target.'" class="big-button '.$position.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('button', 'pi_button');

//small button shortcode
function pi_small_button($atts, $content = null){
	extract( shortcode_atts( array(
	      'url' => '#',
	      'target' => '_self',
	      'position' => 'left',
	      ), $atts ) );
	return '<a href="'.$url.'" target="'.$target.'" class="small-button '.$position.'"><span>'.do_shortcode($content).'</span></a>';
}
add_shortcode('small-button', 'pi_small_button');

//Alerts
function pi_alert_red( $atts, $content = null ) {
	return '<div class="alert red">'.do_shortcode($content).'</div>';
}
add_shortcode('alert-red', 'pi_alert_red');

function pi_alert_green( $atts, $content = null ) {
	return '<div class="alert green">'.do_shortcode($content).'</div>';
}
add_shortcode('alert-green', 'pi_alert_green');

function pi_alert_blue( $atts, $content = null ) {
	return '<div class="alert blue">'.do_shortcode($content).'</div>';
}
add_shortcode('alert-blue', 'pi_alert_blue');

function pi_alert_yellow( $atts, $content = null ) {
	return '<div class="alert yellow">'.do_shortcode($content).'</div>';
}
add_shortcode('alert-yellow', 'pi_alert_yellow');


//Column Shortcodes
function pi_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'pi_one_half');

function pi_one_half_last( $atts, $content = null ) {
   return '<div class="one_half column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'pi_one_half_last');

function pi_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'pi_one_third');

function pi_one_third_last( $atts, $content = null ) {
   return '<div class="one_third column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'pi_one_third_last');

function pi_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'pi_one_fourth');

function pi_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'pi_one_fourth_last');

function pi_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'pi_one_fifth');

function pi_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'pi_one_fifth_last');

function pi_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'pi_one_sixth');

function pi_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'pi_one_sixth_last');

?>