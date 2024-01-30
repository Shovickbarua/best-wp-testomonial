<?php
/*
 * Plugin Name:       Best WP Testomonial
 * Plugin URI:        https://wordpress.org/plugins/best-wp-testomonial/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Shovick Barua
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       bwpt
 */

 /**
 * Proper way to enqueue styles
 */
function bwpt_enqueue_style() {
	wp_enqueue_style( 'owl-carousel', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css");
	wp_enqueue_style( 'owl-theme', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css");
	wp_enqueue_style( 'bwpt-style', plugins_url( 'css/bwpt-style.css', __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'bwpt_enqueue_style' ); 
/**
 * Proper way to enqueue styles
 */
function bwpt_enqueue_scripts() {
	wp_enqueue_script( 'jquery-min', 'https://code.jquery.com/jquery-1.12.0.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'owl-carousel-min', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'bwpt-js', plugins_url( 'js/bwpt-js.js', __FILE__ ), array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'bwpt_enqueue_scripts' );
?>