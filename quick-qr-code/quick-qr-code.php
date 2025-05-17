<?php 
/**
 * 
 * Plugin Name: Qick QR Code
 * Plugin URI: https://example.com
 * Description: A simple plugin to demonstrate WordPress hooks.
 * Author: Uzzal Chandra Dey
 * Author URI: https://example.com
 * 
 * 
 */


 class Quick_qr_code{

    function __construct(){
        add_filter("the_content", array($this, "append_qr_code"), 10);

    }

    function append_qr_code($content){
 
        if(is_single()){
            $current_url = get_permalink();

        
        $text = $current_url;
        $size = apply_filters('quick_qr_code_size', '100px');
            
        $qr_code = "https://quickchart.io/qr?text={$current_url}";

        $label  = apply_filters('quick_qr_code_label', 'Scan this QR Code');
        $position = apply_filters('quick_qr_code_position', 'right');
        $margin = apply_filters('quick_qr_code_margin', 2);
        $dark= apply_filters('quick_qr_code_dark', '#000000');
        $light= apply_filters('quick_qr_code_light', '#ffffff');
        $logo_url= apply_filters('quick_qr_code_logo_url', 'https://example.com/logo.png');

        
            // Set the side of the QR code
        $side = ($position === 'right') ? 'right:50px;' : 'left:50px;';

            // Generate the QR code HTML
        
        $qr_html = '<div style="
                        position:fixed;
                        '.esc_attr($side).'
                        bottom:20px;
                        z-index:9999;
                        text-align:center;
                        font-size:12px;
                        color:#000;
                        font-family:Arial, sans-serif;">
                        <img src="'.esc_url($qr_code).'" alt="QR Code" style="width:'.esc_attr($size).';height:'.esc_attr($size).';">
                        <p style="text-align:center;">'.esc_html($label).'</p>
                    </div>';
            return $content . $qr_html;
            }

            return $content;
        }
 

}

new Quick_qr_code();



