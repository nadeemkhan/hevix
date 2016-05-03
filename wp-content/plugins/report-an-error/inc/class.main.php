<?php
class RERR 
{
	var $options;
	public function __construct()
	{
		if (is_admin()){ 
			add_action('admin_menu', array($this, 'RERR_add_menu'));
		}
			
		add_action('wp_footer', array($this, 'RERR_footer'));        

	}
	/* admin_menu hook */
	public function RERR_add_menu() {
		add_options_page( __('Report an error','RERR'),__('Report an error','RERR'),'manage_options','report_an_error', array( $this, 'report_an_error_options_page' ) );
	}

	public function RERR_footer(){
		// подключаем js


		if(wp_is_mobile()){
			?>
				<style>
				#RERR {
					position: fixed;
					display: none;
					bottom: 0;
					opacity: 1;
					background: #dddddd;
					/* width: 100%; */
					/* height: 100%; */
					padding: 30px;
					text-align: center;
					color: #000000;
					z-index: 9999;
					cursor: pointer;
					font-size: 12pt;
					top: 0;
					left: 0;
					bottom: 0;
					right: 0;
					margin: auto;
					overflow: auto;
					font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				#RERR input {padding: 5px 10px 5px 10px; margin:2px;display:inline-block;}
				</style>	
			<?php

		}else{
			?>
				<style>
				#RERR {
					position: fixed;
					display: none;
					bottom: 0;
					opacity: 1;
					background: #dedede;
					width: 400px;
					height: 200px;
					max-height: 400px;
					padding: 20px;
					text-align: center;
					color: #000000;
					z-index: 9999;
					cursor: pointer;
					top: 0;
					font-size: 12pt;
					left: 0;
					bottom: 0;
					right: 0;
					margin: auto;
					border-radius: 10px;
				    -webkit-box-shadow: 0 0 30px #969696;
				    -moz-box-shadow: 0 0 30px #969696;
				    box-shadow: 0 0 30px #969696;
					font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
				}
				#RERR input {padding: 5px 10px 5px 10px; margin:2px;display:inline-block;border-radius: 10px;height: 40px;width: 100px;}
				#RERR textarea {box-sizing:initial;border-radius:6px;overflow:hidden;width:96%;height:40px!important;margin-bottom:4px!important;padding:2px;width:100%;}
				</style>	
			<?php
			}	
		?>

		<script>
		// автор JS - jQuery.Bukvus: Nazar Tokar, 2013
			jQuery('<div>', {id: 'RERR',style: 'display:none;'}).prependTo('html');

						function RERR(){
							// :))))
							RERR_se(RERR_gs());
						}

						function RERR_gs() { // get selection
							var t = "";
							if (window.getSelection) {
								t = window.getSelection().toString();
							} else if (document.selection && document.selection.type != "Control") {
								t = document.selection.createRange().text;
							}
							return t;
						}

						function RERR_sm(m){ // show message
							button = "<br><br><input style='padding: 10px 20px 10px 20px;border-radius: 10px;' type='button' onclick='jQuery(\"#RERR\").hide();' value='<?php echo __('Ok','RERR')?>'>"
							jQuery("#RERR").show();
							jQuery("#RERR").html("<br><font style='font-size:14pt;'>"+m+"</font>"+button);

							//alert(m);
						}

						function RERR_se(t){ // send error
							if (t.length < 4) { 
								RERR_sm("<?php echo __('Please, select inaccuracy or typo for letting us know.','RERR').'<br><br>'.__('Thanks!','RERR'); ?>"); 
							} else if(t.length > 2000) {
								RERR_sm("<?php echo __('Too much text, choose less!','RERR'); ?>");
							} else {

								message = "<b><?php _e('Thanks! You selected:','RERR'); ?></b><div style='overflow:auto;width:100%;height:50px;margin-bottom:4px!important;padding-left:2px;padding-right:2px;'><font style='font-size:10pt;'><span id='rerr_selected'>" + t + "</span></font></div><b><?php _e('Your Comment:','RERR'); ?></b><br><textarea style='height:40px!important;' id='rerr_message'></textarea><br><nobr><input type='button' value='<?php _e('Submit','RERR'); ?>' onclick='post_error();'>&nbsp;<input type='button' value='<?php _e('Cancel','RERR'); ?>' onclick='jQuery(\"#RERR\").hide();'></nobr>";

								jQuery("#RERR").show();
								jQuery("#RERR").html(message);

							}
						}

						function post_error(){

								jQuery("#RERR").hide();


								jQuery.post("<?php echo get_home_url(); ?>?RERR=send", { 
									err: jQuery("#rerr_message").val(),
									url: location.href, 
									txt: jQuery("#rerr_selected").text()
								},
								  function(data){
									if (data.result == "ok") {
										RERR_sm(data.message);
									} else {
										RERR_sm(data.error);
									}
								  }, "json");


						}


						jQuery(document).keydown(function(e){
							if (e.keyCode == 13 && e.ctrlKey) { // отправка
								if (jQuery('#RERR').is(':visible')) {
									jQuery("#RERR").hide();
									jQuery("#RERR").html('');
								}			
								RERR();
							} 
						});

		 </script>
		<?php 
	 }       


	/////////////////////////////////////////////////////////////////////////////////////////////// 
	// Общие настройки плагина

	public function report_an_error_options_page() {

			$RERRAccauntMail  = (get_option('RERRAccauntMail') ? esc_attr(get_option('RERRAccauntMail')): '');

			$array_emails = explode(",", $RERRAccauntMail);
			$_error = "";

			foreach ($array_emails as $value) {
				if(strlen(trim($value))>0){
					if(!is_email(trim($value))){
						$_error.= "<li><font color='red'>".__('e-mail','RERR')." <b>".$value."</b> ".__('invalid','RERR')."</font></li>";
					}
				}
			}
			?>
			<div>
				<h2><?php _e('Settings "Report an error" plugin.','RERR'); ?></h2>
				<p><?php echo $_error; ?></p>
				<form method="post"  action="options.php">
				<?php _e("Specify the e-mail addresses, separated by commas, to send an error report.","RERR"); ?><br>
				<input type='text' class='widefat' name='RERRAccauntMail' value='<?php echo $RERRAccauntMail; ?>'>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="RERRAccauntMail" />
				<?php    
					wp_nonce_field('update-options');
					settings_fields('RERRSettingsGroup'); 
					submit_button(__("Save","RERR")); 
				?>
				</form>


			</div>
			<?php
	}


	/* install actions (when activate first time) */
	static function install() {

	}

	/* uninstall hook */
	static function uninstall() {

	}

} 