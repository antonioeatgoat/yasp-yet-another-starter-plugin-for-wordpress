<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class ST_Admin_Settings
 *
 * The core class of the admin side.
 * It handles everything about the plugin settings or anything else about the WordPress dashboard side.
 *
 * It also creates an administration page for the plugin under Settings.
 *
 * @author Antonio Mangiacapra
 */
class ST_Admin_Settings implements ST_Singleton_Interface {

	/**
	 * @var null|ST_Admin_Settings The unique instance of the class
	 */
	protected static $instance = null;

	/**
	 * @var ST_Admin_Settings_Page[] The array containing the instances of all the settings page objects
	 */
	protected static $settings_pages = null;

	/**
	 * @var string The capability needed to manage the settings of the plugin
	 */
	const SETTINGS_CAPABILITY = 'manage_options';

	/**
	 * @var string The slug of the settings page
	 */
	const SETTINGS_PAGE_SLUG = 'starter-plugin-settings';

	/**
	 * @var string The prefix used before the options names saved in the database
	 */
	const OPTION_NAME_PREFIX = 'st_option_';

	/**
	 * ST_Admin_Settings constructor
	 */
	protected function __construct() {

		// This class is instanced on the front end side too, in order to retrieve also there the plugin data saved in the DB
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'admin_menu', array( $this, 'create_menu_entries' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );

	}

	/**
	 * Include all the settings pages existent (and other related classes needed) and automatically instance them
	 */
	protected function init_settings_pages() {

		if ( ! is_null( self::$settings_pages ) ) {
			return;
		}

		// Include all the files needed for the settings pages
		include ST_ADMIN_PATH . '/class-st-admin-settings-page-interface.php';
		include ST_ADMIN_PATH . '/class-st-admin-settings-page.php';

		$settings = array();

		// Include all the settings pages here
		$settings[] = include ST_ADMIN_PATH . '/settings/class-st-settings-general.php';
		$settings[] = include ST_ADMIN_PATH . '/settings/class-st-settings-advanced.php';

		self::$settings_pages = $settings;

	}

	/**
	 * Register the settings options, so that they can be automatically updated and fetched using WordPress Settings API
	 *
	 * @see https://codex.wordpress.org/Settings_API
	 */
	public function register_settings() {

		foreach ( self::$settings_pages as $settings_page ) {
			foreach ( $settings_page->get_settings() as $setting ) {
				if ( empty( $setting['id'] ) && 'checkboxgroup' !== $setting['type'] ) {
					continue;
				}

				if ( 'checkboxgroup' != $setting['type'] ) {
					register_setting(
						'st_settings_group_' . $settings_page->get_id(),
						self::OPTION_NAME_PREFIX . $setting['id']
					);
				} else {

					// If the current setting is a checkboxgroup, then register all its options
					foreach ( $setting['options'] as $checkbox_setting ) {
						register_setting(
							'st_settings_group_' . $settings_page->get_id(),
							self::OPTION_NAME_PREFIX . $checkbox_setting['id']
						);
					}
				}

			}
		}

	}

	/**
	 * Create specific menu item for the plugin
	 */
	public function create_menu_entries() {

		// Menu item under Settings
		add_options_page(
			'YASP',
			'YASP',
			self::SETTINGS_CAPABILITY,
			self::SETTINGS_PAGE_SLUG,
			array( $this, 'render_settings_page' )
		);

	}

	/**
	 * Render the content of the settings page
	 */
	public function render_settings_page() {

		if ( ! current_user_can( self::SETTINGS_CAPABILITY ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'starter-plugin' ) );
		}

		include_once ST_ADMIN_PATH . '/views/html-settings-page.php';

	}

	/**
	 * Returns all the instances of the settings page objects loaded
	 *
	 * @return ST_Admin_Settings_Page[]
	 */
	public static function get_settings_pages() {

		if ( is_null( self::$settings_pages ) ) {
			self::init_settings_pages();
		}

		return apply_filters( 'st_get_settings_pages', self::$settings_pages );
	}

	/**
	 * Given the ID, returns a specific page settings instance. Returns null if the id is not found
	 *
	 * @param string|null $id If null, tries to detect the current tab to display
	 *
	 * @return ST_Admin_Settings_Page|null
	 */
	public static function get_settings_page( $id = null ) {

		// If the id isn't specified, try to detect the current tab to display
		if ( is_null( $id ) ) {
			if ( ! empty( $_GET['tab'] ) ) {
				$id = sanitize_title( $_GET['tab'] );
			} else {
				$default_settings_page = ST_Admin_Settings::get_default_settings_page();
				$id                    = $default_settings_page->get_id();
			}
		}

		foreach ( self::$settings_pages as $settings_page ) {
			if ( $settings_page->get_id() === $id ) {
				return $settings_page;
			}
		}

		return null;

	}

	/**
	 * Return the default settings page to display if it isn't selected any tab
	 *
	 * @return ST_Admin_Settings_Page
	 */
	public static function get_default_settings_page() {

		return apply_filters( 'st_get_default_settings_page', self::$settings_pages[0] );

	}

	/**
	 * Fetches the option value saved in the database. If the value doesn't exist yet, then returns the default value
	 *
	 * @param string $option_name
	 * @param string $default Empty by default
	 *
	 * @return mixed|string
	 */
	public static function get_option( $option_name, $default = '' ) {

		// If the option name doesn't include the prefix yet, add it
		if ( substr( $option_name, 0, strlen( self::OPTION_NAME_PREFIX ) ) !== self::OPTION_NAME_PREFIX ) {
			$option_name = self::OPTION_NAME_PREFIX . $option_name;
		}

		// Get the option from the database
		$option_value = get_option( $option_name, null );

		// If the option exists, return it, otherwise return the default value
		return ( null === $option_value ) ? $default : $option_value;
	}

	/**
	 * Return the unique instance of the class
	 *
	 * @return ST_Admin_Settings|null
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

}
