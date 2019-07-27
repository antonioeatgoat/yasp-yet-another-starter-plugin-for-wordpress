<?php
/**
 *
 * Plugin Name: YASP - Yet Another Starter Plugin for WordPress
 * Description: A well-organized, easy-to-use, object-oriented boilerplate to create your next high-quality WordPress
 * Plugin efficiently.
 * Version: 1.1.0
 * Plugin URI: https://github.com/antonioeatgoat/yasp-yet-another-starter-plugin-for-wordpress/
 * Author: Antonio Mangiacapra
 * Author URI:  https://github.com/antonioeatgoat/
 * Text Domain: yasp Domain Path: /languages/
 *
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define SP_PLUGIN_FILE.
if ( ! defined( 'SP_PLUGIN_FILE' ) ) {
	define( 'SP_PLUGIN_FILE', __FILE__ );
}

// Include the main class
if ( ! class_exists( 'SP_Core' ) ) {
	include_once dirname( __FILE__ ) . '/class-sp-core.php';
}

if ( ! function_exists( 'sp_instance' ) ) {
	/**
	 * Return the unique instance of the main class
	 *
	 * @return SP_Core
	 */
	function sp_instance() {
		return SP_Core::instance();
	}
}

// Init the main class
sp_instance();