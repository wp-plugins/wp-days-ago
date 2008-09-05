=== Plugin Name ===
Contributors: vskjefst
Tags: posts, pages, date, day, days
Requires at least: 2.6
Tested up to: 2.6.1

Displays the number of years and days since a post or page was written.

== Description ==

My very first attempt on a Wordpress plugin is actually just a copy/past job from my own CMS. I wanted to get functionality I could not find in any other plugins: I simply wanted to display the number of days since a post or page was published.

The plugin will only display years and days and will not take into account that 24 hours are one day. If you publish a page or a post at 23:59, it will be marked with “yesterday” at 00:00 even if it’s only a minute since you published. In some cases, the plugin will display a human readable text instead of the days count. Today is “today” and not “0 days ago”. Yesterday is, well, “yesterday”, while anything published seven days ago is posted “a week ago”. If an entry is more than a year old, the plugin will display the post date as "X year, Y days".

== Installation ==

If you want to use it yourself, simply follow these instructions:
1. Download the plugin.
2. Unzip the contents of the downloaded file to the /wp-content/plugins/ directory of your Wordpress installation.
3. Log in to your Wordpress dashboard and activate the wp_days_ago plugin that should now be visible in the list.
4. You can now insert <? wp_days_ago(); ?> anywhere in The Loop in your Wordpress theme.

The wp_days_ago plugin takes one parameter; the time zone offset between your Wordpress time zone settings and the server your Wordpress installation is running on. In my case I write everything in Central European Time, but the server is located in Sydney, Australia. That’s a -8 hour time zone offset from the server to my local time, and to get things right, I have to use -8 as the time zone offset parameter, like this: <? wp_days_ago(-8); ?>.

URL: http://www.vegard.net/archives/1476/