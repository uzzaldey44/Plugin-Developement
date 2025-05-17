<?php 
/**
 * 
 * Plugin Name: Hook Demo
 * Plugin URI: https://example.com
 * Description: A simple plugin to demonstrate WordPress hooks.
 * Author: Uzzal Chandra Dey
 * Author URI: https://example.com
 * 
 * 
 */

 class Hook_Demo{
    function __construct(){
      //   add_filter('the_title', [ $this,'change_title'],9 );
      //   add_filter('the_title', [ $this,'change_title_again'], 10 );
       

      add_action("wp_head", array($this, "inline_css"));
     // add_action("wp_footer", array($this, "inline_js",99));

      add_filter('the_title', [ $this,'show_id'],10,2);
        
    }

    function show_id($title, $id){
         if(is_admin()){
          $title = "{$id} - {$title}";
         }
         return $title;
      }

       
      // function inline_js() {
      //    $js = "<script>console.log('Hello from the footer!');</script>";
      //    echo $js;
      // }

   function inline_css() {
      $css = "<style>.wp-block-post-title{ color: green; font-size: 28px; }</style>";
      echo $css;
    }
    function change_title($title){

            return -$title . "!!!";
    }
    function change_title_again($title){
    
            return $title . ".....";

    }
 }

 new Hook_Demo();