<?php
/*
Plugin Name: wp-days-ago
Version: 2.6
Plugin URI: http://wordpress.org/extend/plugins/wp-days-ago/
Author: Vegard Skjefstad
Author URI: http://www.vegard.net/
Description: Displays the number of years and days since a post or page was written. 

Copyright 2008-2013 Vegard Skjefstad vegard@vegard.net

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

function wp_days_ago_ajax($mode = 0, $prepend = "", $append = "", $threshold = 86400, $showDateAfter = -1, $showDateFormat = null) {
	
	$post_id = get_the_ID();
	$the_time = get_the_time("U", $post_id);
	if(gmmktime() + (get_option('gmt_offset') * 3600) - $the_time > $threshold) {
		echo wp_days_ago_internal($the_time, $post_id, $mode, $prepend, $append, null, $showDateAfter, $showDateFormat);
	} else {
		echo "<script type=\"text/javascript\"><!--\n";
		echo "jQuery(document).ready(function(){";
		echo "get_wp_days_ago(" . $post_id . ", " . $mode . ", '" . $prepend . "', '" . $append . "', '" . $showDateAfter . "', '" . $showDateFormat . "');";
		echo "})\n";
		echo "--></script>\n";
		echo "<span class=\"wp_days_ago\" id=\"wp_days_ago-" . $post_id . "\"></span>";
	}
}

function wp_days_ago_ajax_handler () {
	$showDateFormat = $_POST["showDateFormat"];
	if($showDateFormat == 'null' || $showDateFormat == '') {
		$showDateFormat = null;
	}
	die(wp_days_ago_internal(get_the_time("U", $_POST["postId"]), $_POST["postId"], $_POST["mode"], $_POST["prepend"], $_POST["append"], null, $_POST["showDateAfter"], $showDateFormat));
}

function wp_days_ago ($mode = 0, $prepend = "", $append = "", $texts = null, $showDateAfter = -1, $showDateFormat = null) {
	$postId = get_the_ID();
	echo wp_days_ago_internal(get_the_time("U", $postId), $postId, $mode, $prepend, $append, $texts, $showDateAfter, $showDateFormat);
}

function wp_days_ago_internal ($the_time, $postId, $mode = 0, $prepend = "", $append = "", $texts = null, 
		$showDateAfter = -1, $showDateFormat = null) {

	if($texts == null) {
		$texts = array("Today", "Yesterday", "One week ago", "days ago", "year",
		"years", "ago", "day ago", "days ago", "Just now", "One minute ago", "minutes ago", "1 hour ago", "hours ago", "Some time in the future");
	}
			
	$gmt_offset = get_option('gmt_offset');
	
	$output = $prepend;

	if($showDateAfter > 0 && (gmmktime() + ($gmt_offset * 3600) - $the_time > $showDateAfter)) {
		if($showDateFormat == null) {
			$showDateFormat = get_option('date_format') . " " . get_option('time_format');
		}
		$output .= get_the_time($showDateFormat, $postId);
	} else {
		$days = round((gmmktime() + ($gmt_offset * 3600) - $the_time) / 86400);
		$minutes = round((gmmktime() + ($gmt_offset * 3600) - $the_time) / 60);
	
		if($minutes < 0) {
			$output .= $texts[14];
		} else if($mode == 0 && $minutes < 1440) {
			if($minutes == 0) {
				$output .= $texts[9];
			} else if($minutes == 1) {
				$output .= $texts[10];
			} else if($minutes < 60) {
				$output .= $minutes . " " . $texts[11];
			} else if($minutes < 120) {
				$output .= $texts[12];
			} else {
				$output .= floor($minutes / 60) . " " . $texts[13];
			}
		} else {
			if($days == 0)
				$output = $output . $texts[0];
			elseif($days == 1)
				$output = $output . $texts[1];
			elseif($days == 7)
				$output = $output . $texts[2];
			else {
				$years = floor($days / 365);
				if($years > 0) {
					if($years == 1)
						$yearappend = $texts[4];
					else
						$yearappend = $texts[5];

					$days = $days - (365 * $years);
					if($days == 0)
						$output = $output . $years . " " . $yearappend . " " . $texts[6];
					else if($days == 1)
						$output = $output . $years . " " . $yearappend . ", " . $days . " " . $texts[7];
					else
						$output = $output . $years . " " . $yearappend . ", " . $days . " " . $texts[8];
				} else {
					$output = $output . $days . " " . $texts[3];
				}
			}
		}
	}

	return $output . $append;
}

function wp_days_ago_enqueue_scripts() {
	wp_enqueue_script( "wp_days_ago", plugin_dir_url( __FILE__ ) . '/wp_days_ago.js', array( 'jquery' ), "2.6");
	wp_localize_script( 'wp_days_ago', 'wp_days_ago_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	
}
add_action('wp_enqueue_scripts', 'wp_days_ago_enqueue_scripts');
add_action('wp_ajax_nopriv_wp_days_ago_ajax', 'wp_days_ago_ajax_handler');
add_action('wp_ajax_wp_days_ago_ajax', 'wp_days_ago_ajax_handler');
?>