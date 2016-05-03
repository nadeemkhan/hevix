<?php
/*
Plugin Name: VKontakte (VK.com) Community Widget Cache
Plugin URI: http://naturalwebdesign.net/plugins/wordpress/vkontakte-community-widget-cache/
Description: Prevent loading unwanted resources from VK.com, lots of external images, CSS files, and JS files? VKontakte (VK.com) Community Widget Cache.
Version: 0.9.1
Author: Dariusz Zielonka / Natural Web Design
Author URI: http://naturalwebdesign.net/
License: GPLv2
*/

defined('ABSPATH') or die;
		
$GLOBALS['vkcw_styles'] = array(
	"Inline (Requires Cache Refresh)" => 'inline',
	"Clean (Basic)" => "style_default.css",
	"VK Style" => "style_vk.css",
	"Disable" => NULL
);

register_activation_hook(__FILE__, 'nwd_vk_cache_activation');
function nwd_vk_cache_activation()
{
	if (version_compare(PHP_VERSION, '5.0.0', '<'))
	{
		wp_die('PHP version 5 or greater is required to use this plugin. You are running '. PHP_VERSION);
	}
}

add_action('admin_menu', 'nwd_vk_create_menu');
function nwd_vk_create_menu()
{
	add_options_page('VK Cache', 'VK Cache', 'manage_options', 'nwd_vk_options', 'nwd_vk_options_page');
	add_action('admin_init', 'nwd_vk_settings');
}

function nwd_vk_settings()
{
	register_setting('nwd_vk_settings', 'vk_community_widget_id');
	register_setting('nwd_vk_settings', 'vk_community_widget_limit');
	register_setting('nwd_vk_settings', 'vk_community_widget_width');
	register_setting('nwd_vk_settings', 'vk_community_widget_expire');
	register_setting('nwd_vk_settings', 'vk_community_widget_css');

	if (get_option('vk_community_widget_css') == '')
	{
		update_option('vk_community_widget_css', 'inline');
	}

	if (get_option('vk_community_widget_width') == '')
	{
		update_option('vk_community_widget_width', '240px');
	}

	if (get_option('vk_community_widget_expire') == '')
	{
		update_option('vk_community_widget_expire', '3600');
	}
}

function nwd_vk_options_page()
{ 
	global $vkcw_styles;
	
	if ($_POST['update'] == true) 
	{
	   if ($_POST['vk_community_widget_width'] != get_option('vk_community_widget_width')
	   || $_POST['vk_community_widget_limit'] != get_option('vk_community_widget_limit')
	   || $_POST['vk_community_widget_id'] != get_option('vk_community_widget_id')
	   || $_POST['vk_community_widget_css'] != get_option('vk_community_widget_css')
	   || $_POST['vk_community_widget_expire'] != get_option('vk_community_widget_expire')
	   ) {  
	   
		$file = dirname(__FILE__) . '/cache/vk_community_widget_cache_' . get_option('vk_community_widget_id') . get_option('vk_community_widget_limit') . '.html';

			if (file_exists($file))
			{
				unlink($file);
			}

		}

		if ($_POST['vk_community_widget_clear'] == 'on')
		{
			$path = dirname(__FILE__) . '/cache/';
			if ($handle = opendir($path))
			{
				while(false !== ($file = readdir($handle)))
				{
					if (preg_match("/vk_community_widget_cache_/", $file))
					{
						unlink($path.$file);
					} 
				}

				$vk_msg = '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>Cached VK.com Community Widget cleared.</strong></p></div>';
				closedir($handle);
			}
		}
	}
?>
<div class="wrap">
	<h2>VK Community Widget Cache</h2>
	<?php if ($vk_msg) echo $vk_msg; ?>
	<p>Changing any of the settings below will clear the cache.</p>
	<form method="post" action="options.php">
    	<?php settings_fields( 'nwd_vk_settings' ); ?>
    	<table class="form-table">
        	<tr valign="top">
        		<th scope="row">VK Page ID</th>
        		<td><input type="text" name="vk_community_widget_id" value="<?php echo get_option('vk_community_widget_id'); ?>" /></td>
        	</tr>
	        <tr valign="top">
    		    <th scope="row">Show Number of Connections</th>
        		<td><input type="text" name="vk_community_widget_limit" value="<?php echo get_option('vk_community_widget_limit'); ?>" /></td>
        	</tr>
	        <tr valign="top">
    		    <th scope="row">Set Default Width</th>
        		<td><input type="text" name="vk_community_widget_width" value="<?php echo get_option('vk_community_widget_width'); ?>" /> * In px - ie. 240px</td>
        	</tr>
	        <tr valign="top">
    		    <th scope="row">Cache Expiration</th>
        		<td><input type="text" name="vk_community_widget_expire" value="<?php echo get_option('vk_community_widget_expire'); ?>" /> * In seconds - ie. 3600 (3600 seconds - 1 hour)</td>
        	</tr>
	        <tr valign="top">
    		    <th scope="row">CSS Style</th>
        		<td><select name="vk_community_widget_css">
                <?
                foreach($vkcw_styles as $name => $css)
                {
                    echo '<option value="'.$css.'" '.selected($instance['commbox_css'], $css, false).'>' . $name . '</option>';
                }
				?>
                	</select>
                </td>
        	</tr>
		</table>
        <input type="hidden" name="update" value="true" />
    	<p class="submit">
    		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    	</p>
	</form>
    <form method="post" action="">
    	<table class="form-table">
        	<tr valign="top">
        		<th scope="row">Clear the cache?</th>
        		<td><input type="checkbox" name="vk_community_widget_clear" /> * Checking this box and clicking "Clear the Cache" will delete all cached community widget files.</td>
        	</tr>
        </table>
        <input type="hidden" name="update" value="true" />
    	<p class="submit">
    		<input type="submit" class="button-primary" value="<?php _e('Clear the Cache') ?>" />
    	</p>
	</form>
	<div class="css_guide">
	<h2>CSS Guide</h2>
	<p>For those who would like to disable inline css, you can copy and paste this into your themes style.css guide to get the default look.</p>
	<textarea style="width:500px;height:500px">
.widget_vkcache .community_div {
	margin:10px auto;
	width:240px;
}
.widget_vkcache .community_div_head {
	border-bottom:1px solid #D8DFEA;
	padding-bottom:5px;
}
.widget_vkcache .connections .total {
	font-size:12px;
}
.widget_vkcache .connections .grid a {
	float:left;
	text-align:center;
	text-decoration:none;
}
.widget_vkcache .connections .grid a img {
	margin:0;
	padding:5px 5px 0 5px;
}
.widget_vkcache .connections .grid a span {
	color:#808080;
	font-size:10px;
}

.img_Link {
	float:left;
	padding-right:5px;
}
	</textarea>
	</div>
</div>
<?php
}

add_shortcode('commbox', 'nwd_vk_shortcode');

function nwd_vk_shortcode($atts)
{
	extract(shortcode_atts(array(
		'id' => get_option('vk_community_widget_id'),
		'limit' => get_option('vk_community_widget_limit'),
		'width' => get_option('vk_community_widget_width'),
		'expire' => get_option('vk_community_widget_expire'),
		'css' => get_option('vk_community_widget_css')
	), $atts));

	$vk_community_widget_cache = new nwd_vk_commbox_Cache($id, $limit, $width, $expire, $css);

	return $vk_community_widget_cache->write();
}

class nwd_vk_commbox_Cache
{
	public $commbox_ua = 'Mozilla/5.0';
	public $commbox_css = NULL;

	protected $_html;
	protected $_fanCount = 0;
	protected $_fans = array();
	protected $_pageInfo;
	protected $_output;

	public function __construct($id, $limit, $width, $expire, $css)
	{
		$this->commbox_id = $id;
		$this->commbox_limit = $limit;
		$this->commbox_width = $width;
		$this->commbox_time = time() - $expire;
		$this->commbox_css = $css;

		$this->_getCacheFile();
		$this->_checkExpire();

		if ($this->expired)
		{
			$this->_buildURL();
			$this->_getHTML();
		}

		if ($this->commbox_css)
		{
			add_action('wp_footer', array(&$this, 'add_style'));
		}
	}

	public function add_style()
	{
		wp_register_style('vkcw', plugins_url('css/'.$this->commbox_css, __FILE__));
		//wp_enqueue_styles('vkcw');
		wp_print_styles('vkcw');
	}

	public function write()
	{
		if ($this->expired)
		{
			$this->_parseHTML();
			$this->_buildOutput();
			$this->_writeOutput();
		}

		$html = file_get_contents($this->cachefile);
		$html = mb_convert_encoding($html, "UTF-8", "windows-1251");

		echo $html;
	}

	private function _getCacheFile()
	{
		$this->cachefile = dirname(__FILE__).'/cache/vk_community_widget_cache_'.$this->commbox_id.$this->commbox_limit.'.html';
	}

	private function _getHTML()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $this->commbox_ua);
		curl_setopt($ch, CURLOPT_URL, $this->commbox_url);
		curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$this->_html = curl_exec($ch);
												$this->_html = preg_replace('#<div class="community_square_user">\s*<div class="community_square_pic">\s*<a href="http://vk.com/id"(.*?)</a>\s*</div>\s*<a href="http://vk.com/id"(.*?)</a>\s*</div>#', '', $this->_html);


		if ($this->_html === false)
		{
			throw new exception(curl_errno($ch) . ': ' . curl_error($ch));
		}
 
		curl_close($ch);
		$tmpfile = dirname(__FILE__).'/cache/commbox.tmp.html';				
		file_put_contents($tmpfile, $this->_html);
	}

	private function _checkExpire()
	{
		$this->expired = true;

		if (file_exists($this->cachefile))
		{
			if (filemtime($this->cachefile) > $this->commbox_time)
			{
				$this->expired = false;
			}
		}
	}

	protected function _buildURL()
	{
		$this->commbox_url  = 'http://vk.com/widget_community.php?';
		$this->commbox_url .= /*$this->commbox_limit*/ '&width='.($this->commbox_width)*73;
		//$this->commbox_url .= '&width='.$this->commbox_width;
		$this->commbox_url .= '&gid=';
		$this->commbox_url .= $this->commbox_id;

	}

	protected function _parseHTML()
	{
		$urlExp = '#<a href="(.*?)" target="_blank" class="community_head#';
		$nameExp = '#<span id="wcommunity_name_anim" class="wcommunity_name">(.*?)</span>#';
		$fancountExp = '# id="members_count" class="color2">(.*?)</a>#';
		$fanExp ='#<div class="community_square_user">\s*<div class="community_square_pic">\s*(<(a|span).*?</(a|span)>)\n</div>\n(<(a|span).*?</(a|span)>)\s*</div>#';
		$fanUserName ='#\n</div>\n(<(a|span).*?</(a|span)>)\s*</div>#';
		$pageExp ='#title="VK"></span>.*?(.*?) />#';
		
 
		preg_match($urlExp , $this->_html, $url);
		$this->_url = $url[1];
 
		preg_match_all($nameExp , $this->_html, $name);
		$this->_name = $name[1][0];
 
		preg_match_all($fancountExp , $this->_html, $fanCount);
		$this->_fanCount = $fanCount[1][0];
		
		$fanExp = str_replace('/images/community_50.gif', '', $fanExp);
 
		preg_match_all($fanExp, $this->_html, $fans);
		$this->_fans = $fans[1];
		
		preg_match_all($fanUserName, $this->_html, $UserNames);
		$this->_usernames = $UserNames[1];
		
		
 
		preg_match_all($pageExp, $this->_html, $pageInfoLink);
		$pageImageLink = str_replace(' target="_blank"', ' target="_blank" style="float:left;padding-right:5px;"', $pageInfoLink[1][0]);
		$pageImageLink = str_replace('width="22" height="22"', 'width="50" height="50" style="margin:0;padding:0" ', $pageImageLink);

		preg_match('/src="(.*?)"/', $pageImageLink, $pageImage);
		$imgfile = dirname(__FILE__) . '/cache/' . $this->commbox_id . '.jpg';
		file_put_contents($imgfile, file_get_contents($pageImage[1]));
		$oldimage = $pageImage[0];
		$newimage = 'src="'.plugins_url('/cache/' . $this->commbox_id . '.jpg', __FILE__) . '"';
		$pageImageLink = str_replace($oldimage, $newimage, $pageImageLink);
		$this->_pageImageLink = $pageImageLink;
		
	}

	protected function _buildOutput()
	{
		if ($this->commbox_css == "inline")
		{
			$output  = '<div class="community_div" style="width:'. $this->commbox_width .';margin:10px auto;">' . "\r\n";
				$output .= "\t" . '<div class="community_div_head" style="border-bottom:1px solid #D8DFEA;padding-bottom:5px;">' . "\r\n";
					$output .= "\t\t" . '<a href="' .$this->_url . '" rel="nofollow" target="_blank" class="img_Link" style="float: left; padding-right: 5px;">' . $this->_pageImageLink . ' /></a>'."\r\n";
					$output .= "\t\t" . '<div class="community_div_name">' . "\r\n";
					$output .= "\t\t\t" .'<a href="' .$this->_url . '" rel="nofollow" target="_blank" style="font-size: 16px;">'. $this->_name .'</a> <span>&#1085;&#1072; &#1042;&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1077;</span>' . "\r\n";
					$output .= "\t\t" . '</div>' . "\r\n";
					$output .= "\t\t" . '<div style="clear:both;"></div>' . "\r\n";
				$output .= "\t" . '</div>' . "\r\n";
				$output .= "\t" . '<div class="connections">' . "\r\n";
					$output .= "\t\t" . '<div class="total" style="font-size:12px;">' . "\r\n";
						$output .= "\t\t\t" . $this->_fanCount . "\r\n";
					$output .= "\t\t" . '</div>' . "\r\n";
					$output .= "\t\t" . '<div class="grid">' . "\r\n";

					$i = 1;
					foreach (array_combine($this->_fans, $this->_usernames) as $fan => $username)
					{
						if ($i > $this->commbox_limit) continue;
						$i++;

						$uid = md5($fan);
						$file = dirname(__FILE__) . '/cache/' . $uid . '.jpg';
						preg_match('# src="(.*?)" #', $fan, $fan_image_url);
						
						file_put_contents($file, file_get_contents($fan_image_url[1]));
						$oldimage = 'src="' . $fan_image_url[1] . '"';
						$image = 'src="' . plugins_url('/cache/' . $uid . '.jpg', __FILE__) . '"';
						$fan = str_replace($oldimage, $image, $fan);
						$fan = str_replace(' height="50"', ' height="50" style="margin: 0 auto;"', $fan);
						$fan = str_replace(' target="_blank"', ' target="_blank" rel="nofollow" style="text-align:center;float:none;"', $fan);
						

						$output .= "\t\t\t<div style=\"padding: 3px 0; width: 73px;	float:left;	text-align: center; \"><div class=\"VKuser-pic\">" . $fan . "</div>\r\n\t\t\t\t" . $username . "</div>\r\n";
					}
					$output .= "\t\t" . '<div style="clear:both;"></div>' . "\r\n";
					$output .= "\t\t" . '</div>' . "\r\n";
					
				$output .= "\t" . '</div>' . "\r\n";
			$output .= '</div>';
					$output .= "\t\t" . '<div class="connect_button VKstyle" style="clear: both; font-weight: bold; text-align: center; padding-top: 5px;">' . "\r\n";
					$output .= "\t\t\t" .'<a href="'.$this->_url.'" rel="nofollow" target="_blank" class="vkbutton_Text" style="font-size: 16px;">Follow on VK</a>';
					$output .= '</div>' . "\r\n";															
			
		}
		else
		{
			$output  = '<div class="community_div">' . "\r\n";
				$output .= "\t" . '<div class="community_div_head">' . "\r\n";
					$output .= "\t\t" . '<a href="' .$this->_url . '" rel="nofollow" target="_blank" class="img_Link">' . $this->_pageImageLink . ' /></a>' . "\r\n";
					$output .= "\t\t" . '<div class="community_div_name">' . "\r\n";
					$output .= "\t\t\t" . '<a href="' .$this->_url . '" rel="nofollow" target="_blank" class="name_Link">' . substr($this->_name,0,20) . "..." . '</a> <span>&#1085;&#1072; &#1042;&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1077;</span>' . "\r\n";
						
					$output .= "\t\t" . '</div>' . "\r\n";
					$output .= "\t\t" . '<div style="clear:both;"></div>' . "\r\n";
				$output .= "\t" . '</div>' . "\r\n";
				$output .= "\t" . '<div class="connections">' . "\r\n";
					$output .= "\t\t" . '<div class="total">' . "\r\n";
						$output .= "\t\t\t" . $this->_fanCount . "\r\n";
					$output .= "\t\t" . '</div>' . "\r\n";
					$output .= "\t\t" . '<div class="grid">' . "\r\n";

					$i = 1;
					foreach (array_combine($this->_fans, $this->_usernames) as $fan => $username)
					{
						if ($i > $this->commbox_limit) continue;
						$i++;

						$uid = md5($fan);
						$file = dirname(__FILE__) . '/cache/' . $uid . '.jpg';
						preg_match('# src="(.*?)" #', $fan, $fan_image_url);
						file_put_contents($file, file_get_contents($fan_image_url[1]));
						$oldimage = 'src="' . $fan_image_url[1] . '"';
						$image = 'src="' . plugins_url('/cache/' . $uid . '.jpg', __FILE__) . '"';
						$fan = str_replace($oldimage, $image, $fan);
						$fan = str_replace(' class="img"', '', $fan);
						$fan = str_replace('target="_blank"', 'target="_blank" rel="nofollow"', $fan);
						$username = str_replace('target="_blank" class="color2"', 'target="_blank" rel="nofollow" class="VKusername"', $username);
						$fan = str_replace('alt=""', 'alt="'.$fanname[1].'"', $fan);

						$output .= "\t\t\t<div class=\"VKuser\"><div class=\"VKuser-pic\">" . $fan . "</div>\r\n\t\t\t\t" . $username . "</div>\r\n";
					}
					$output .= "\t\t" . '<div style="clear:both;float:none"></div>' . "\r\n";
					$output .= "\t\t" . '</div>' . "\r\n";
					
				$output .= "\t" . '</div>' . "\r\n";
			$output .= '</div>';
					$output .= "\t\t" . '<div class="connect_button VKstyle">' . "\r\n";
					$output .= "\t\t\t" .'<a href="'.$this->_url.'" rel="nofollow" target="_blank" class="vkbutton_Text">Follow on VK</a>';
					$output .= "\t\t" . '</div>' . "\r\n";										
			
		}
		$this->_output = $output;
	}

	protected function _writeOutput()
	{
		file_put_contents($this->cachefile, $this->_output);
	}
}

class nwd_vk_commbox_Cache_Widget extends WP_Widget
{
	public function __construct()
	{
		$widget_ops  = array(
			'classname' => 'widget_vkcache',
			'description' => __( "VKontakte Community Widget (Cached)" )
		);

		$this->WP_Widget('vkcache', __('VK Cache'), $widget_ops);
	}

	public function widget($args, $instance)
	{
		extract($args);
		echo $before_widget;

		if (!empty($instance['title']))
		{
			echo $before_title . $instance['title'] . $after_title;
		}

		echo nwd_vk_shortcode(array(
		   'id' => $instance['commbox_id'],
		   'limit' => $instance['commbox_limit'],
		   'width' => $instance['commbox_width'],
		   'expire' => $instance['commbox_expire'],
		   'css' => $instance['commbox_css']
		));

		echo $after_widget;
	}

	public function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	public function form($instance)
	{
		global $vkcw_styles;
		
		echo '<div id="myFavoritesWidget-admin-panel">';
		echo '<label for="' . $this->get_field_id("title") . '">Title:</label><br />';
		echo '<input type="text" class="widefat" ';
		echo 'name="' . $this->get_field_name("title") .'" ';
		echo 'id="' . $this->get_field_id("title") .'" ';
		echo 'value="' . $instance['title'] . '" /><br />';
		echo '<label for="' . $this->get_field_id("commbox_id") . '">Page ID:</label><br />';
		echo '<input type="text" class="widefat" ';
		echo 'name="' . $this->get_field_name("commbox_id") .'" ';
		echo 'id="' . $this->get_field_id("commbox_id") .'" ';
		echo 'value="' . $instance['commbox_id'] . '" /><br />';
		echo '<label for="' . $this->get_field_id("commbox_limit") . '">Limit:</label><br />';
		echo '<input type="text" class="widefat" ';
		echo 'name="' . $this->get_field_name("commbox_limit") .'" ';
		echo 'id="' . $this->get_field_id("commbox_limit") .'" ';
		echo 'value="' . $instance['commbox_limit'] . '" /><br />';
		echo '<label for="' . $this->get_field_id("commbox_width") . '">Width:</label><br />';
		echo '<input type="text" class="widefat" ';
		echo 'name="' . $this->get_field_name("commbox_width") .'" ';
		echo 'id="' . $this->get_field_id("commbox_width") .'" ';
		echo 'value="' . $instance['commbox_width'] . '" /><br />';
		echo '<label for="' . $this->get_field_id("commbox_expire") . '">Expiration:</label><br />';
		echo '<input type="text" class="widefat" ';
		echo 'name="' . $this->get_field_name("commbox_expire") .'" ';
		echo 'id="' . $this->get_field_id("commbox_expire") .'" ';
		echo 'value="' . $instance['commbox_expire'] . '" /><br />';
		echo '<label for="' . $this->get_field_id("commbox_css") . '">CSS Style:</label><br />';
		echo '<select ';
		echo 'name="' . $this->get_field_name("commbox_css") .'" ';
		echo 'id="' . $this->get_field_id("commbox_css") .'"> ';

		foreach($vkcw_styles as $name => $css)
		{
			echo '<option value="'.$css.'" '.selected($instance['commbox_css'], $css, false).'>'.$name.'</option>';
		}

		echo '</select><br />';
		echo '<p>This widget will display a cached version of your VK Community Widget that refreshes based on your expiration setting.</p>';
		echo '</div>';
	}
}

add_action('widgets_init', create_function('', 'return register_widget("nwd_vk_commbox_Cache_Widget");'));
