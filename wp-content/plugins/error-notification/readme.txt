=== Error Notification ===
Contributors: taskotr
Tags: error, notification, misspell, report, email, message, spell-check, mistake, typo, notify
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 0.2.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin gives an ability for your website visitors to notify you about any errors that have been found in your posts or pages.

== Description ==

This plugin gives an ability for your website visitors to notify you about any errors that have been found in your posts or pages.

How it works?
For example, somebody visited your website where you have a post/page that has this content: "WordPres started in 2003 with a single bit of code to enhance the typography of everyday writing and with fewer users than you can count on your fingers and toes."
As you noticed, the first word "WordPres"  is missing one "s" in the end. So, to notify you about this, your visitor has to highlight a word "WordPres" and press Shift + E or click on a link under the content body. Then you will get an email that will have the page name, url to that page and highlighted word/sentence.

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==



== Screenshots ==
1. Screenshot #1
2. Screenshot #2
3. Screenshot #3


== Changelog ==
= 0.2.7 =
* Changed key combination from Shift+E to Shift+Enter (Update your front-end action text).
* Fixed ajaxurl issue.
2013-07-29

= 0.2.6 =
* Added Localization
* Changed post ID and "Thank You" message output location.
* Fixed register_script issue
2013-06-22

= 0.2.5 =
* Fixed some issues
2013-06-15

= 0.2.4 =
* Added feature that allows you to specify custom emails and the post/page author. 2013-01-20

= 0.2.3 =
* Fixed Dashboard bug (keys combination). 2013-01-02

= 0.2.2 =
* Fixed duplicate notification bug. 2012-12-19

= 0.2.1 =
* Plugin allows to have a larger "Thank You" message.
* Plugin allows to send an email notification just to WP Admin or WP Admin & Post/Page Author or custom email address(es).
* Plugin allows to have multiple email addresses.
* Plugin allows to have a confirmation box before sending a notification email.
* Plugin allows to use custom action text placement (via PHP function).
* Plugin allows to turn off default action text placement (default: after your content).
* Plugin allows to exclude Posts/Pages where you do not want to have action text.
* Plugin allows to change the action text ("If you found an error...").
* Fixed form options. 2012-12-18

= 0.2 =
* Fixed Shift+E combination
* Added z-index to notification bar
* Fixed notification function. 2012-12-11

= 0.1 =
* Initial Release. 2012-11-25


== Upgrade notice ==
