<?php 

/**
 * Plugin Name: Asset Demo
 * Description: A simple plugin to demonstrate asset management in WordPress.
 * Version: 1.0
 * Author:WP Theme Coder
 * Author URI: https://wpthemecoder.com
 * License: GPL2

*/



class Asset_Demo {

    const VERSION = '1.0.1';
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'load_assets'));

        add_action('admin_enqueue_scripts', array($this, 'load_admin_assets'));
    }


    // for admin
    function load_admin_assets($screen) {
    
        // Get the plugin directory URL
        $admin_main_css = plugin_dir_path(__FILE__) . 'admin/assets/css/admin-main.css';
        $admin_main_js = plugin_dir_path(__FILE__) . 'admin/assets/js/admin-main.js';
        $plugin_js = plugin_dir_path(__FILE__) . 'admin/assets/js/plugin.js';

        // Enqueue the CSS file
        wp_enqueue_style('ad-admin-css', $admin_main_css, [], self::VERSION);

        // Enqueue the JS file
        wp_enqueue_script('ad-admin-js', $admin_main_js, [], self::VERSION, true);

        if($screen == 'plugins.php') {
              wp_enqueue_script('ad-plugin-js', $plugin_js, [], self::VERSION, true);
        }

        $data = array(
            'name' => 'Uzzal Chandra Dey',
      
        );

        wp_localize_script('ad-admin-js', 'ad_data', $data);
      
    }







    // For  frontend
    function load_assets() {
        // Get the plugin directory URL
        $main_css = plugin_dir_path(__FILE__) . 'assets/css/style.css';
        $dummy_css = plugin_dir_path(__FILE__) . 'assets/css/dummy.css';


        $main_js = plugin_dir_path(__FILE__) . 'assets/js/main.js';
        $utility_js = plugin_dir_path(__FILE__) . 'assets/js/utility.js';
        $module_js = plugin_dir_path(__FILE__) . 'assets/js/module.js';

        // Enqueue the CSS file
        wp_enqueue_style('ad-main-css', $main_css, [], self::VERSION);
        wp_enqueue_style('ad-dummy-css', $dummy_css, [], self::VERSION);

       

        wp_enqueue_script('ad-main',$main_js, ['ad-jquery','ad-utility'], self::VERSION, ['in_footer' => true, 'strategy' => 'defer']);

        wp_enqueue_script('ad-jquery', '//code.jquery.com/jquery-3.6.0.min.js', [], '3.6.0', true);


        wp_enqueue_script('ad-utility', $utility_js, [], self::VERSION, ['in_footer' => true, 'strategy' => 'defer']);

        wp_enqueue_script_module('ad-module', $module_js, [], '1.0.0', true);
    }
  
}

new Asset_Demo();