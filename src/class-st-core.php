<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class ST_Core
 *
 * The main class of the plugin. Here are defined all the constants, included all the files and instanced all the
 * classes that have to be instanced automatically.
 * Also load the localization files.
 *
 * @author Antonio Mangiacapra
 */
final class ST_Core {

	/**
	 * @var null|ST_Core The unique instance of the class
	 */
	private static $instance = null;

	/**
	 * YASP version
	 *
	 * @var string
	 */
	public $version = '1.0.0';


	/**
	 * ST_Core constructor
	 */
	protected function __construct() {

		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'st_loaded' );
	}

	/**
	 * Hook all the actions and the filters         *
	 */
	protected function init_hooks() {

		add_action( 'init', array( $this, 'init' ) );

	}

	/**
	 * Init the plugin when WordPress Initialises.
	 */
	public function init() {
		// Before init action
		do_action( 'st_init_before' );

		// Set up localization
		$this->load_plugin_textdomain();

		// Init action
		do_action( 'st_init' );
	}

	/**
	 * Define the constants of the plugin
	 */
	protected function define_constants() {

		// ST_PLUGIN_BASENAME
		if ( ! defined( 'ST_PLUGIN_BASENAME' ) ) {
			define( 'ST_PLUGIN_BASENAME', plugin_basename( ST_PLUGIN_FILE ) );
		}

		// ST_CLASSES_PATH
		if ( ! defined( 'ST_CLASSES_PATH' ) ) {
			define( 'ST_CLASSES_PATH', $this->plugin_path() . '/includes/classes/' );
		}

		// ST_ADMIN_PATH
		if ( ! defined( 'ST_ADMIN_PATH' ) ) {
			define( 'ST_ADMIN_PATH', $this->plugin_path() . '/includes/admin' );
		}

		// ST_VERSION
		if ( ! defined( 'ST_VERSION' ) ) {
			define( 'ST_VERSION', $this->version );
		}

	}

	/**
	 * Load languages files
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/starter-plugin/starter-plugin-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/starter-plugin-LOCALE.mo
	 *      - wp-content/plugins/starter-plugin/languages/starter-plugin-LOCALE.mo
	 */
	protected function load_plugin_textdomain() {
		$locale = ( is_admin() && function_exists( 'get_user_locale' ) ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'starter-plugin' );

		unload_textdomain( 'starter-plugin' );
		load_textdomain( 'starter-plugin', WP_LANG_DIR . '/starter-plugin/starter-plugin-' . $locale . '.mo' );
		load_plugin_textdomain( 'starter-plugin', false, plugin_basename( dirname( ST_PLUGIN_FILE ) ) . '/languages' );
	}


	/**
	 * Handle all the files to include:
	 * register the autoload function, include all other files, instance the classes that need to be instanced
	 */
	public function includes() {

		// Autoload classes that will be used
		spl_autoload_register( array( $this, 'autoload' ) );

		// Include any other file here (helpers, template files, ecc)
		$files_paths = apply_filters( 'st_files_paths_to_include', array(
			$this->plugin_path() . '/includes/helpers.php'
		) );

		foreach ( $files_paths as $path ) {
			require_once $path;
		}

		// Include classes that need to be instanced
		$classes_paths = array(
			'ST_Assets'         => ST_CLASSES_PATH . '/class-st-assets.php',

			// Include this also if it is an admin class, so that options can be used on front end
			'ST_Admin_Settings' => ST_ADMIN_PATH . '/class-st-admin-settings.php',
		);

		// Include classes that need to be instanced only in admin side
		if ( is_admin() ) {
			$classes_paths = array_merge( $classes_paths, array() );
		}

		/**
		 * Filters the classes automatically instanced
		 *
		 * @var array $classes_paths
		 */
		$classes_paths = apply_filters( 'st_classes_paths_to_init', $classes_paths );

		foreach ( $classes_paths as $class => $path ) {
			require_once $path;

			/**
			 * Confirm that it's been successfully included before instantiating.
			 */
			if ( class_exists( $class ) ) {
				call_user_func( array( $class, 'instance' ) );
			}
		}

	}

	/**
	 * Autoload the classes of the plugin.
	 * At the current moment it autoload only the classes present in the ST_CLASSES_PATH folder, but not in
	 * ST_ADMIN_PATH
	 *
	 * @param  string      $class
	 * @param  string|null $directory_path
	 */
	public function autoload( $class, $directory_path = null ) {

		if ( is_null( $directory_path ) ) {
			$directory_path = ST_CLASSES_PATH;
		}

		foreach ( scandir( $directory_path ) as $directory_item ) {

			// If the current directory item is a directory too && it isn't assumed to be hidden, re-run the function recursively
			if ( is_dir( $directory_path . $directory_item ) && substr( $directory_item, 0, 1 ) !== '.' ) {
				$this->autoload( $class, $directory_path . $directory_item );
			}

			// If the current directory item is a php file file
			if ( preg_match( "/.php$/i", $directory_item ) ) {

				$file_name = strtolower( str_replace( '_', '-', $class ) );

				$file_path = $directory_path . "/class-{$file_name}.php";

				// If exists, include the required file
				if ( file_exists( $file_path ) ) {
					require_once $file_path;
				}

			}

		}

	}

	/**
	 * Get the plugin url
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', ST_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( ST_PLUGIN_FILE ) );
	}

	/**
	 * Return the unique instance of the class. The first time it's called, it initialize the class as well
	 *
	 * @return ST_Core
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

}
