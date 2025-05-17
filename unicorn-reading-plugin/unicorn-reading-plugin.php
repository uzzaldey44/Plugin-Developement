<?php


/*
 * Plugin Name: Unicorn Reading Plugin
 * Description: A simple plugin demostrate plugin development.
 * Version:1.0.0
 * Author:Uzzal Chnadra Dey
 * Author URI: https://example.com
 * Requires at least: 5.0
 * Requires PHP: 8.0
 * License:GPL2
 * Plugin URI:https://example.com/our-first-plugin
*/

function urp_unicorn_reading_time($content){
   $word_count = str_word_count(strip_tags($content));

   $reading_time = ceil($word_count /200);
$content = $content . "Reading time is " . $reading_time . " munite(s)";

return $content;
}

add_filter("the_content","urp_unicorn_reading_time");