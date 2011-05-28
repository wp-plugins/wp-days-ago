=== Plugin Name ===
Contributors: vskjefst
Tags: posts, pages, date, day, days, relative date, days ago
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=4UXDX43P8V9EN&lc=NO&item_name=wp%2ddays%2dago&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 1.5
Tested up to: 3.1.3
Stable tag: trunk

Displays the number of years and days since a post or page was written.

== Description ==

This plugin displays the number of years and days since a post or a page was published. All calculations are based on days but it will not take into account that 24 hours are one day. If you publish a page or a post at 23:59, it will be marked with “yesterday” at 00:00 even if it's only a minute since you published. In some cases, the plugin will display a human readable text instead of the days count. Today is “today” and not “0 days ago”. Yesterday is, well, “yesterday”, while anything published seven days ago is posted “a week ago”. If an entry is more than a year old, the plugin will display the post date as "X years, Y days".

== Installation ==

1. [Download](http://downloads.wordpress.org/plugin/wp-days-ago.zip) the plugin.
2. Unzip the contents of the downloaded file to the /wp-content/plugins/ directory of your Wordpress installation.
3. Log in to your Wordpress dashboard and activate the wp_days_ago plugin that should now be visible in the list.
4. You can now insert &lt;? wp_days_ago(); ?&gt; anywhere in [The Loop](http://codex.wordpress.org/The_Loop) in your Wordpress theme.

Plugin URL: [http://www.vegard.net/archives/3530/](http://www.vegard.net/archives/3530/)

= Usage =
`<?php wp_days_ago( $offset, $prepend, $append, $texts); ?>`

= Parameters =
$offset
 (int) (deprecated) Not in use, but available to provide backwards compatibility. Note that because of how PHP handles optional parameters (parameters can be skipped from right to left), you have to provide this parameter if you decided to use any of the other parameters available. You can enter any value as its ignored by the plugin.

$prepend
 (string) (optional) This text will be prepended to the plugin's default output.

$append
 (string) (optional) This text will be appended to the plugin's default output.
 
$texts
 (array) (optional) This array allows you to change the texts used by the plugin. This will, for instance, allow you to translate the output to your language. The default values are array("today", "yesterday", "one week ago", "days ago", "year", "years", "ago", " day ago", " days ago").

== Upgrade notice ==
No changes to your theme or configuration are necessary when you upgrade from a previous version.

== Changelog ==

= 1.7 =
* Backwards compatible all the way back to Wordpress 1.5.
* The plugin now uses the internal Wordpress timezone settings.
* Added optional parameters that allows configuration of appended text, prepended text and the texts displayed by the plugin.

= 1.0 =
* Initial version.