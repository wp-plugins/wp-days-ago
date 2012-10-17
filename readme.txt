=== Plugin Name ===
Contributors: vskjefst
Tags: facebook, twitter, posts, pages, date, day, days, hours, minutes, relative date, days ago, hours ago, minutes ago
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=28LC77UW3XFBY&lc=NO&item_name=www%2evegard%2enet&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Requires at least: 2.1
Tested up to: 3.4.2
Stable tag: trunk

Displays the number of years, days, hours and minutes since a post or a page was published in the same format as Facebook, Twitter etc.

== Description ==

This plugin displays the number of years, days, hours and minutes since a post or a page was published in the same format as Facebook, Twitter etc. Examples are “Just now” (less than a minute ago), “47 minutes ago” (less than an hour ago), “3 hours ago” (less than a day ago), “Yesterday”, “3 days ago”, “One week ago”, “76 days ago”, “2 years, 13 days ago” and so on. It’s also possible to make the plugin behave like the 1.x version and turn off displaying minutes and hours. The plugin will then fall back to “Today” for everything published less than 24 hours ago and not display minutes and hours. There are options for defining a prepending and appending text and change all the textual output from the plugin, for instance “minutes ago” and “One week ago”, making it easy for you to translate it to any language you want.

Cache plugins, like W3 Total Cache and WP Super Cache, are supported through the use of AJAX. Please see below for details.

== Installation ==

1. [Download](http://downloads.wordpress.org/plugin/wp-days-ago.zip) the plugin.
2. Unzip the contents of the downloaded file to the /wp-content/plugins/ directory of your Wordpress installation.
3. Log in to your Wordpress dashboard and activate the wp_days_ago plugin that should now be visible in the list.
4. You can now insert &lt;? wp_days_ago(); ?&gt; (or &lt;? wp_days_ago_ajax(); ?&gt;) anywhere in [The Loop](http://codex.wordpress.org/The_Loop) in your Wordpress theme.
5. Optionally, you can use &lt;? wp_days_ago(1); ?&gt; (or &lt;? wp_days_ago_ajax(1); ?&gt;) instead to turn off the fine grained option (see changelog below). This will make the plugin behave like the 1.x version.

Plugin URL: [http://www.vegard.net/archives/3781/](http://www.vegard.net/archives/3781/)

= Support for cache plugins =
Since version 2.5, wp_days_ago supports cache plugins by making an AJAX call from the client to correctly display the time since a post or page was published.

To achieve this, use the wp_days_ago_ajax function instead of wp_days_ago. Please note that the wp_days_ago_ajax function does not support the $texts parameter. Other than that, it behaves the same way as the wp_days_ago method. Please see below for details.

If you decide to use the wp_days_ago_ajax function, you should be aware of this: The way WordPress handles AJAX functions is less than efficient and if you have a lot of views on your site you will experience a higher load on the system. In future versions of the plugin I plan to write a stand alone AJAX handler that doesn't use the WordPress core for AJAX. It's not the recommended way, but currently the recommended way is not good enough for request-intensive plugins like this one.

= Usage non-cached sites =
`<?php wp_days_ago( $mode, $prepend, $append, $texts); ?>`

= Parameters =
$mode
 (int) (optional) Use any value larger than 0 to turn off displaying minutes and hours and instead fall back to "Today" for everything published less than 24 hours ago. Default value is 0.

$prepend
 (string) (optional) This text will be prepended to the plugin's default output. Default value is &quot;&quot; (empty string).

$append
 (string) (optional) This text will be appended to the plugin's default output. Default value is &quot;&quot; (empty string).
 
$texts
 (array) (optional) This array allows you to change the texts used by the plugin. This will, for instance, allow you to translate the output to your language. The default value is array("Today", "Yesterday", "One week ago", "days ago", "year", "years", "ago", "day ago", "days ago", "Just now", "One minute ago", "minutes ago", "1 hour ago", "hours ago", "Some time in the future").

= Usage for cached sites =
 
`<?php wp_days_ago_ajax( $mode, $prepend, $append); ?>`

= Parameters =
$mode
 (int) (optional) Use any value larger than 0 to turn off displaying minutes and hours and instead fall back to "Today" for everything published less than 24 hours ago. Default value is 0.

$prepend
 (string) (optional) This text will be prepended to the plugin's default output. Default value is &quot;&quot; (empty string).

$append
 (string) (optional) This text will be appended to the plugin's default output. Default value is &quot;&quot; (empty string).

The output from wp_days_ago_ajax will be enclosed in a span-element that uses the class "wp_days_ago".
 
== Upgrade notice ==
No changes to your theme or configuration are necessary when you upgrade from a previous version.

== Changelog ==

= 2.5 =
* New feature: Cached sites are now supported through the use of the wp_days_ago_ajax function. See above for details.
* Change: Minimum required version of WordPress is now 2.1.

= 2.0.2 =
* New feature: Added text "Some time in the future" for scheduled posts (visible in preview mode only).

= 2.0.1 =
* Change: Removed some debug code that had made its way into the release.

= 2.0 =
* New feature: The plugin now by default displays minutes and hours since a post or page was created.
* Change: The $offset parameter from the 1.x version is now replaced with a $mode parameter that enables you to prevent the plugin from displaying the minutes and hours since a post or page was published and instead fall back to “Today” for everything published lest than 24 hours ago.

= 1.7.1 =
* Changed some of the default texts so that they start with a capital letter.

= 1.7 =
* Backwards compatible all the way back to Wordpress 1.5.
* The plugin now uses the internal Wordpress timezone settings.
* Added optional parameters that allows configuration of appended text, prepended text and the texts displayed by the plugin.

= 1.0 =
* Initial version.