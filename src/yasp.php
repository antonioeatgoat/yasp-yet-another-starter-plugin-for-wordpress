<?php
/**
 *
 * Plugin Name: YASP - Yet Another Starter Plugin for WordPress
 * Description: A well-organized, easy-to-use, object-oriented boilerplate to create your next high-quality WordPress
 * Plugin efficiently. Version:     1.0.0 Plugin URI: Author:      Antonio Mangiacapra Author URI:
 * https://twitter.com/AntonioEatGoat Text Domain: yasp Domain Path: /languages/
 *
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define SP_PLUGIN_FILE.
if ( ! defined( 'SP_PLUGIN_FILE' ) ) {
	define( 'SP_PLUGIN_FILE', __FILE__ );
}

// Include the main class
if ( ! class_exists( 'Starter_Plugin' ) ) {
	include_once dirname( __FILE__ ) . '/class-sp-core.php';
}

if ( ! function_exists( 'yasp_' ) ) {
	/**
	 * Return the unique instance of the main class
	 *
	 * @return SP_Core
	 */
	function yasp_() {
		return SP_Core::instance();
	}
}

// Init the main class
yasp_();