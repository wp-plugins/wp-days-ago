<?php
/*
Plugin Name: wp-days-ago
Version: 1.7.1
Plugin URI: http://www.vegard.net/archives/1476/
Author: Vegard Skjefstad
Author URI: http://www.vegard.net/
Description: Displays the number of years and days since a post or page was written. 

Copyright 2008-2011 Vegard Skjefstad vegard@vegard.net

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

function wp_days_ago ($offset = 0, $prepend = "", $append = "",
		$texts = array("Today", "Yesterday", "One week ago", "days ago", "year",
			"years", "ago", " day ago", " days ago")) {
		
		$since = round((strtotime(date("Y-m-d", gmmktime() + (get_option('gmt_offset') * 3600))) - strtotime(date("Y-m-d", get_the_time("U")))) / 86400);

		$output = $prepend;
		
		if($since == 0)
			$output = $output . $texts[0];
		elseif($since == 1)
			$output = $output . $texts[1];
		elseif($since == 7)
			$output = $output . $texts[2];
		else {
			$years = floor($since / 365);
			if($years > 0)
			{
				if($years == 1)
					$yearappend = $texts[4];
				else
					$yearappend = $texts[5];

				$days = $since - (365 * $years);
				if($days == 0)
					$output = $output . $years . " " . $yearappend . " " . $texts[6];
				else if($days == 1)
					$output = $output . $years . " " . $yearappend . ", " . $days . " " . $texts[7];
				else
					$output = $output . $years . " " . $yearappend . ", " . $days . " " . $texts[8];
			} else {
				$output = $output . $since . " " . $texts[3];
			}
		}

		$output = $output . $append;
		
		echo $output;
}

add_filter('Posts', 'wp_days_ago');
?>