<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class SP_Settings_Advanced
 *
 * @author Antonio Mangiacapra
 */
class SP_Settings_Advanced extends SP_Admin_Settings_Page {

	/**
	 * SP_Settings_Advanced constructor.
	 */
	public function __construct() {
		$this->id    = 'advanced';
		$this->label = __( 'Advanced', 'yasp' );

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
				'type'  => 'title',
				'title' => __( 'Advanced Settings', 'yasp' ),
				'desc'  => __( 'Add any other kind of settings you want here and create how many tabs you want.', 'yasp' ),
			),
			array(
				'id'          => 'advanced_text',
				'type'        => 'text',
				'title'       => __( 'Advanced text', 'yasp' ),
				'desc'        => __( 'This is an optional description.', 'yasp' ),
				'placeholder' => __( 'Something cool here.', 'yasp' ),
				'default'     => '',
			),

		);

		return apply_filters( 'sp_get_settings_' . $this->id, $settings );
	}
}

// Return an instance of the the settings page
return new SP_Settings_Advanced();