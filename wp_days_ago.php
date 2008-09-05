<?php
/*
Plugin Name: wp-days-ago
Version: 1.0
Plugin URI: http://www.vegard.net/archives/1476/
Author: Vegard Skjefstad
Author URI: http://www.vegard.net/
Description: Displays the number of years and days since a post or page was written. 

Copyright 2008  Vegard Skjefstad vegard@vegard.net

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function wp_days_ago ($offset=0) {
		$since = round((strtotime(date("Y-m-d", time() + ($offset * 3600))) - strtotime(date("Y-m-d", get_the_time("U")))) / 86400);

		if($since == 1)
			$since = "yesterday";
		elseif($since == 0)
			$since = "today";
		elseif($since == 7)
			$since = "one week ago";
		else
			$since = $since . " days ago";

		$years = substr($since / 365,0,1);
		if($years != "0")
		{
			if($years == "1")
				$yearappend = "year";
			else
				$yearappend = "years";

			$days = $since - (365 * $years);
			if($days == "0")
				$since = $years . " " . $yearappend . " ago";
			else if($days == "1")
				$since = $years . " " . $yearappend . ", " . $days . " day ago";
			else
				$since = $years . " " . $yearappend . ", " . $days . " days ago";
		}

		echo $since;
}

add_filter('Posts', 'wp_days_ago');
?>