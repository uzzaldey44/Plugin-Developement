<?php

/*
 * Plugin Name: Our First Plugin
 * Description: A simple plugin demostrate plugin development.
 * Version:1.0.0
 * Author:Uzzal Chnadra Dey
 * Author URI: https://example.com
 * Requires at least: 5.0
 * Requires PHP: 8.0
 * License:GPL2
 * Plugin URI:https://example.com/our-first-plugin
*/


defined("ABSPATH") || exit;

echo "Hello";

require_once(plugin_dir_path( __FILE__ ) ."/includes/class-our-first-plugin.php");

new ofp_first_plugin();