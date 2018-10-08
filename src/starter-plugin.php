<?php
/**
 *
 * Plugin Name: YASP - Yet Another Starter Plugin for WordPress
 * Description: A well-organized, easy-to-use, object-oriented boilerplate to create your next high-quality WordPress
 * Plugin efficiently. Version:     1.0.0 Plugin URI: Author:      Antonio Mangiacapra Author URI:
 * https://twitter.com/AntonioEatGoat Text Domain: starter-plugin Domain Path: /languages/
 *
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define ST_PLUGIN_FILE.
if ( ! defined( 'ST_PLUGIN_FILE' ) ) {
	define( 'ST_PLUGIN_FILE', __FILE__ );
}

// Include the main class
if ( ! class_exists( 'Starter_Plugin' ) ) {
	include_once dirname( __FILE__ ) . '/class-st-core.php';
}

if ( ! function_exists( 'starter_plugin' ) ) {
	/**
	 * Return the unique instance of the main class
	 *
	 * @return ST_Core
	 */
	function starter_plugin() {
		return ST_Core::instance();
	}
}

// Init the main class
starter_plugin();