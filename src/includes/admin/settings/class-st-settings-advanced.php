<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class ST_Settings_Advanced
 *
 * @author Antonio Mangiacapra
 */
class ST_Settings_Advanced extends ST_Admin_Settings_Page {

	/**
	 * ST_Settings_Advanced constructor.
	 */
	public function __construct() {
		$this->id    = 'advanced';
		$this->label = __( 'Advanced', 'starter-plugin' );

		parent::__construct();
	}

	/**
	 * Returns an array containing all the settings of the current settings page
	 *
	 * @return array
	 */
	public function get_settings() {

		$settings = array(

			array(
				'type'     => 'title',
				'title'    => __( 'Advanced Settings', 'starter-plugin' ),
				'desc'     => __( 'Add any other kind of settings you want here and create how many tabs you want.', 'starter-plugin' ),
			),
			array(
				'id'            => 'advanced_text',
				'type'          => 'text',
				'title'         => __( 'Advanced text', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),
				'placeholder'   => __( 'Something cool here.', 'starter-plugin' ),
				'default'       => '',
			),

		);

		return apply_filters( 'st_get_settings_' . $this->id, $settings );
	}
}

// Return an instance of the the settings page
return new ST_Settings_Advanced();