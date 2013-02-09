=== wp-days-ago ===
Contributors: vskjefst
Tags: facebook, twitter, posts, pages, date, day, days, hours, minutes, relative date, days ago, hours ago, minutes ago
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=28LC77UW3XFBY&lc=NO&item_name=www%2evegard%2enet&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Requires at least: 2.1
Tested up to: 3.5.1
Stable tag: trunk

Displays the number of years, days, hours and minutes since a post or a page was published in the same format as Facebook, Twitter etc.

== Description ==

This plugin displays the number of years, days, hours and minutes since a post or a page was published in the same format as Facebook, Twitter etc. Examples are “Just now” (less than a minute ago), “47 minutes ago” (less than an hour ago), “3 hours ago” (less than a day ago), “Yesterday”, “3 days ago”, “One week ago”, “76 days ago”, “2 years, 13 days ago” and so on. It’s also possible to make the plugin behave like the 1.x version and turn off displaying minutes and hours. The plugin will then fall back to “Today” for everything published less than 24 hours ago and not display minutes and hours. There are options for defining a prepending and appending text and change all the textual output from the plugin, for instance “minutes ago” and “One week ago”, making it easy for you to translate it to any language you want. It's also possible to configure wp-days-ago to fall back to displaying the actual date and time when a post or page was published when a certain number of seconds after publishing time has been reached.

Cache plugins, like W3 Total Cache and WP Super Cache, are supported through the use of AJAX. Please see the installation instructions for details.

== Installation ==

1. [Download](http://downloads.wordpress.org/plugin/wp-days-ago.zip) the plugin.
2. Unzip the contents of the downloaded file to the /wp-content/plugins/ directory of your Wordpress installation.
3. Log in to your Wordpress dashboard and activate the wp_days_ago plugin that should now be visible in the list.
4. You can now insert &lt;? wp_days_ago(); ?&gt; (or &lt;? wp_days_ago_ajax(); ?&gt;) anywhere in [The Loop](http://codex.wordpress.org/The_Loop) in your Wordpress theme.
5. Optionally, you can use &lt;? wp_days_ago(1); ?&gt; (or &lt;? wp_days_ago_ajax(1); ?&gt;) instead to turn off the fine grained option (see the changelog). This will make the plugin behave like the 1.x version.

Plugin URL: [http://www.vegard.net/archives/3781/](http://www.vegard.net/archives/3781/)

= Support for cache plugins =
Since version 2.5, wp-days-ago supports cache plugins by making an AJAX call from the client to correctly display the time since a post or page was published.

To achieve this, use the wp_days_ago_ajax function instead of wp_days_ago. Please note that the wp_days_ago_ajax function does not support the $texts parameter. Other than that, it behaves the same way as the wp_days_ago method. Please see below for details.

If you decide to use the wp_days_ago_ajax function, you should be aware of this: The way WordPress handles AJAX functions is less than efficient and if you have a lot of views on your site you will experience a higher load on the system. Please see the usage documentation for the wp_days_ago_ajax method for details.

= Usage for non-cached sites =
`<?php wp_days_ago( $mode, $prepend, $append, $texts, $showDateAfter, $showDateFormat); ?>`

= Parameters =
$mode
 (int) (optional) Use any value larger than 0 to turn off displaying minutes and hours and instead fall back to "Today" for everything published less than 24 hours ago. Default value is 0.

$prepend
 (string) (optional) This text will be prepended to the plugin's default output. Default value is &quot;&quot; (empty string).

$append
 (string) (optional) This text will be appended to the plugin's default output. Default value is &quot;&quot; (empty string).
 
$texts
 (array) (optional) This array allows you to change the texts used by the plugin. This will, for instance, allow you to translate the output to your language. *Use null as the parameter value to force the plugin to use the default string array:* array("Today", "Yesterday", "One week ago", "days ago", "year", "years", "ago", "day ago", "days ago", "Just now", "One minute ago", "minutes ago", "1 hour ago", "hours ago", "Some time in the future").
 
$showDateAfter
 (int) (optional) The number of seconds since a post or page was published before the plugin falls back to showing the actual date and time the post or page was published. The default is -1 seconds, i.e. the feature is turned off by default.
 
$showDateFormat
 (string) (optional) The format the plugin should use to display the date and time a post or page was published if the number of seconds configured in the showDateAfter parameter has been reached. The default behaviour is to use the date and time formats configured in Wordpress. See [Formatting Date and Time](http://codex.wordpress.org/Formatting_Date_and_Time) for other time and date formats if you want to override the configured formats.

= Usage for cached sites =
 
`<?php wp_days_ago_ajax( $mode, $prepend, $append, $threshold, $showDateAfter, $showDateFormat); ?>`

= Parameters =
$mode
 (int) (optional) Use any value larger than 0 to turn off displaying minutes and hours and instead fall back to "Today" for everything published less than 24 hours ago. Default value is 0.

$prepend
 (string) (optional) This text will be prepended to the plugin's default output. Default value is &quot;&quot; (empty string).

$append
 (string) (optional) This text will be appended to the plugin's default output. Default value is &quot;&quot; (empty string).

$threshold
 (int) (optional) The number of seconds since a post or page was published before the AJAX method should revert to serving date information without using AJAX (in the same way as the wp_days_ago method). The default value is 86400 (one day). The value should match the configured invalidation threshold of your cache plugin.
 
$showDateAfter
 (int) (optional) The number of seconds since a post or page was published before the plugin falls back to showing the actual date and time the post or page was published. The default is -1 seconds, i.e. the feature is turned off by default.
 
$showDateFormat
 (string) (optional) The format the plugin should use to display the date and time a post or page was published if the number of seconds configured in the showDateAfter parameter has been reached. The default behaviour is to use the date and time formats configured in Wordpress. See [Formatting Date and Time](http://codex.wordpress.org/Formatting_Date_and_Time) for other time and date formats if you want to override the configured formats.
 
The output from wp_days_ago_ajax will be enclosed in a span-element that uses the class "wp_days_ago".
 
== Upgrade notice ==
No changes to your theme or configuration are necessary when you upgrade from a previous version.

== Changelog ==

= 2.6.1 =
* Change: When calculating days, the plugin will now ignore the publishing time and only use the actual date.
* Change: When calculating years, the plugin will now take into account leap years.

Both changes should lead to a more accurate output from the plugin.

= 2.6 =
* New feature: Support for falling back to showing the date and time a post or page is published instead of "X days ago" and similar a configured number of seconds after the post or page is published. The feature is turned off by default, so if you are upgrading from a previous version of wp-days-ago, there is no need for you to change anything unless you want to use this new feature.

= 2.5.2 =
* Bugfix: Fixed a major bug that happened when using the wp_days_ago method. Thanks to user heinnge for reporting this.

= 2.5.1 =
* New feature: Added a threshold parameter to control when AJAX should be used and when the plugin should automatically fall back to the old way of displaying information. After a day, the plugin doesn't display any detailed information anyway so there is no need to strain the server with a lot of AJAX calls. The information displayed by wp-days-ago will of course be updated when your cache plugin invalidates the content and rebuilds it. The value of the wp_days_ago_ajax method threshold paramterer should match the configured invalidation threshold of your cache plugin.
* Change: Optimized date calculation and database access code.

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