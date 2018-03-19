<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Interface ST_Admin_Settings_Page
 *
 * @author Antonio Mangiacapra
 */
interface ST_Admin_Settings_Page_Interface
{
	/**
	 * Returns an array containing all the settings of the current settings page
	 *
	 * @return array
	 */
	public function get_settings();
}