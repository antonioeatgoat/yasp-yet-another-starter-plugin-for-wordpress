<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class SP_Assets
 *
 * Enqueue all the stylesheets and javascript files of the plugin
 *
 * @author Antonio Mangiacapra
 */
class SP_Assets implements SP_Singleton_Interface {

	/**
	 * @var null|SP_Assets The unique instance of the class
	 */
	private static $instance = null;

	/**
	 * SP_Assets constructor
	 */
	private function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

	}

	/**
	 * Return the unique instance of the class
	 *
	 * @return SP_Assets|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new static();
		}

		return self::$instance;
	}


	/**
	 * Enqueue all the stylesheets and javascript files
	 */
	public function enqueue_assets() {

		$min_suffix = ( ! defined( 'SCRIPT_DEBUG' ) || SCRIPT_DEBUG === false ) ? '.min' : '';

		// Styles
		wp_enqueue_style(
			'yasp',
			yasp_()->plugin_url() . "/assets/css/yasp{$min_suffix}.css"
		);

		// Scripts
		wp_enqueue_script(
			'yasp',
			yasp_()->plugin_url() . "/assets/js/yasp{$min_suffix}.js",
			array( 'jquery' ),
			SP_VERSION,
			true
		);

	}

}
