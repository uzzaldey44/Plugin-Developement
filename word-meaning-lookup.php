<?php
/**
 * Plugin Name: Word Meaning Lookup
 * Description: Click a word in post content to show its meaning using the Free Dictionary API.
 * Version: 1.0
 * Author: uzzal chandra dey
 * Author URI: https://uzzalchandradey.com
 * License: GPL2
 */

if ( ! class_exists( 'Word_Meaning_Lookup' ) ) {
    class Word_Meaning_Lookup {
        const VERSION = '1.0.0';

        public function __construct() {
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
            add_action( 'wp_ajax_wml_lookup', [ $this, 'ajax_lookup' ] );
            add_action( 'wp_ajax_nopriv_wml_lookup', [ $this, 'ajax_lookup' ] );
        }

        public function enqueue_scripts() {
            wp_enqueue_script(
                'word-meaning-lookup',
                plugin_dir_url( __FILE__ ) . 'assets/js/word-meaning-lookup.js',
                [ 'jquery' ],
                self::VERSION,
                true
            );

            wp_localize_script( 'word-meaning-lookup', 'wml_ajax_obj', [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            ] );

            wp_add_inline_style( 'wp-block-library', '
                #word-meaning-popup {
                    display: none;
                    position: absolute;
                    background: #fff;
                    border: 1px solid #ccc;
                    padding: 10px;
                    border-radius: 6px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    z-index: 9999;
                    max-width: 300px;
                    font-size: 14px;
                    line-height: 1.4;
                }
            ' );
        }

        public function ajax_lookup() {
            if ( empty( $_GET['word'] ) ) {
                wp_send_json_error( 'No word provided.' );
            }

            $word = sanitize_text_field( $_GET['word'] );
            $response = wp_remote_get( "https://api.dictionaryapi.dev/api/v2/entries/en/{$word}" );

            if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {
                wp_send_json_error( 'API request failed.' );
            }

            $data = json_decode( wp_remote_retrieve_body( $response ), true );
            $definitions = [];

            if ( ! empty( $data[0]['meanings'] ) ) {
                foreach ( $data[0]['meanings'] as $meaning ) {
                    foreach ( $meaning['definitions'] as $def ) {
                        if ( ! empty( $def['definition'] ) ) {
                            $definitions[] = $def['definition'];
                        }
                    }
                }
            }

            if ( ! empty( $definitions ) ) {
                wp_send_json_success( $definitions );
            } else {
                wp_send_json_error( 'No definition found.' );
            }
        }
    }

    new Word_Meaning_Lookup();
}