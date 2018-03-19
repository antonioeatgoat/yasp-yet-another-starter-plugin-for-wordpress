<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class ST_Assets
 *
 * Enqueue all the stylesheets and javascript files of the plugin
 *
 * @author Antonio Mangiacapra
 */
class ST_Assets implements ST_Singleton_Interface {

	/**
	 * @var null|ST_Assets The unique instance of the class
	 */
	protected static $instance = null;

	/**
	 * ST_Assets constructor
	 */
	protected function __construct() {

		add_action( 'wp_enqueue_scripts',    array( $this, 'enqueue_assets' ) );

	}

	/**
	 * Return the unique instance of the class
	 *
	 * @return ST_Assets|null
	 */
	public static function instance() {
		if(is_null(self::$instance))
			self::$instance = new static();

		return self::$instance;
	}


	/**
	 * Enqueue all the stylesheets and javascript files
	 */
	public function enqueue_assets() {

		$min_suffix = ( !defined('SCRIPT_DEBUG') || SCRIPT_DEBUG === false ) ? '.min' : '';

		// Styles
		wp_enqueue_style(
			'starter-plugin',
			starter_plugin()->plugin_url() .  "/assets/css/starter-plugin{$min_suffix}.css"
		);

		// Scripts
		wp_enqueue_script(
			'starter-plugin',
			starter_plugin()->plugin_url() .  "/assets/js/starter-plugin{$min_suffix}.js",
			array( 'jquery' ),
			ST_VERSION,
			true
		);

	}

}
