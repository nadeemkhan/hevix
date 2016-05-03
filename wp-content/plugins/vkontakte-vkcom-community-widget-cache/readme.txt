=== VKontakte (VK.com) Community Widget Cache ===
Contributors: webnatural
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=DTZ6VBA44ZR44&lc=PL&item_name=VK%20Community%20Widget%20Cache%20WP%2dPlugin&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted
Tags: VKontakte, VK, cache, VK community, widget, plugin, page speed, sharing, social networking, webnatural
Requires at least: 3.0
Tested up to: 3.6.1
Stable tag: 0.9.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

If you want to avoid loading weighty scripts, increase your page loading speed, use this plugin to get the VK Community Widget cached.

== Description ==

This plugin was adapted to avoid loading VKontakte Community Widget JavaScripts and images in an iframe every time a page is loaded. It is a fact, that the JavaScripts and iframes increase page loading times and are often harmful for websites' performance. Not everyone likes to have extra weight code on his/her website. Especially when functionality that is brought by the code is not essential.

This plugin is inspired by a similiar [WordPress plugin](http://wordpress.org/plugins/facebook-fan-box-cache/ "Facebook Fan Box Cache") and adapted for VKontakte Community Widget.

You can check post on my website - [Natural Web Design](http://naturalwebdesign.net/plugins/wordpress/vkontakte-community-widget-cache/ "VKontakte (VK.com) Community Widget Cache"), for tutorial, updates, and news.

*** **Please note, that Plugin is in BETA testing phase** ***

**Features:**

* Decrease page load time on pages that contain your VK.com Community Widget code
* VK Cache WordPress Widget (Default 240px wide)
* Manual Cache Refresh

**A few notes about this plugin:**

* The plugin requires PHP5 and cURL to be installed and enabled on your server.
* You can see a working demo of the Plugin on frontend [here](http://deshevoperevodchikpolskiy.ru/связаться/ "Demo on one of our Websites").

**Still to be done:**

* Shortcode for inserting into a page

== Installation ==

1. Go to WordPress Dashboard
2. Click "Plugins"
3. Click "Add New"
4. Type "VKontakte (VK.com) Community Widget Cache" in the input box.
5. Click "Search"
6. Click "Install" on the plugin that is by Dariusz Zielonka / Natural Web Design (if you want this one)

== Screenshots ==

1. The plugin's admin options
2. Widget options
3. Shortcode usage

== Frequently Asked Questions ==

= Does this plugin cost anything? =
It costs only a few clicks to install and use :)

= Where's the CSS Guide? =
On the Other Notes page.

== Changelog ==

= 0.9 =
Initial release. [Let me know](http://naturalwebdesign.net/contact/ "Natural Web Design") if you find any issues. Please be nice, it's my first plugin.

== Upgrade Notice ==

= 0.9.1 =
Initial release. [Let me know](http://naturalwebdesign.net/contact/ "Natural Web Design") if you find any issues. Please be nice, it's my first plugin.

== CSS Guide ==

If you opt to disable inline CSS, you can paste this into your themes style.css file, and it will give you the default look.

`.widget_vkcache .community_div {
	margin:10px auto;
	width:240px;
}
.widget_vkcache .community_div_head {
	border-bottom:1px solid #D8DFEA;
	padding-bottom:5px;
}
.widget_vkcache .connections .total {
	font-size:12px;
	padding: 5px 0 0;
}
.widget_vkcache .connections .grid a {
	float:none;
	text-align:center;
	text-decoration:none;
}
.widget_vkcache .connections .grid a img {
	margin:0;
	border: 0;
}
.widget_vkcache .connections .grid a span {
	color:#808080;
	font-size:10px;
}

.widget_vkcache .img_Link {
	float:left;
	padding-right:5px;
}

.widget_vkcache .VKuser {
	padding: 3px 0;
    width: 73px;
	float:left;
	text-align: center;
}

.widget_vkcache .VKuser-pic {
	height: 47px;
	clear: both;
	overflow: hidden;
	padding-bottom: 3px;
}

.widget_vkcache .img_Link img {
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
}

.widget_vkcache .VKusername { 
	font-size: 0.9em; 
	text-align: center; 
}

.widget_vkcache .connect_button.VKstyle { 
	display: block;
	clear: both;
	padding: 5px;
	text-align: center;
	font-weight: bold;
	font-size: 16px;
}`