<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class ST_Settings_General
 *
 * @author Antonio Mangiacapra
 */
class ST_Settings_General extends ST_Admin_Settings_Page {

	/**
	 * ST_Settings_General constructor.
	 */
	public function __construct() {
		$this->id    = 'general';
		$this->label = __( 'General', 'starter-plugin' );

		parent::__construct();
	}

	/**
	 * Returns an array containing all the settings of the current settings page
	 *
	 * @return array
	 */
	public function get_settings() {

		$settings = array(

			// Input types
			array(
				'type'     => 'title',
				'title'    => __( 'Input types', 'starter-plugin' ),
				'desc'     => __( 'All the simple input text types.', 'starter-plugin' ),
			),
			array(
				'id'            => 'sample_text',
				'type'          => 'text',
				'title'         => __( 'Text', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),
				'default'       => '',
			),
			array(
				'id'            => 'sample_email',
				'type'          => 'email',
				'title'         => __( 'Email address', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),				'default'       => '',
				'placeholder'   => 'email@example.com'
			),
			array(
				'id'            => 'sample_number',
				'type'          => 'number',
				'title'         => __( 'Number', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),				'default'       => '',
			),
			array(
				'id'            => 'sample_password',
				'type'          => 'password',
				'title'         => __( 'Password', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),				'default'       => '',
			),
			array(
				'id'            => 'sample_textarea',
				'type'          => 'textarea',
				'title'         => __( 'Textarea', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),				'default'       => '',
			),

			// Select boxes
			array(
				'type'     => 'title',
				'title'    => __( 'Select boxes', 'starter-plugin' ),
				'desc'     => __( 'Both single select and multi-select.', 'starter-plugin' ),
			),
			array(
				'id'            => 'sample_select',
				'type'          => 'select',
				'title'         => __( 'Select', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),
				'options'       => array(
					'option-1'      => __( 'Option 1', 'starter-plugin' ),
					'option-2'      => __( 'Option 2', 'starter-plugin' ),
					'option-3'      => __( 'Option 3', 'starter-plugin' ),
					'option-4'      => __( 'Option 4', 'starter-plugin' ),
					'option-5'      => __( 'Option 5', 'starter-plugin' ),
				),
				'default'       => '',
			),
			array(
				'id'            => 'sample_multiselect',
				'type'          => 'multiselect',
				'title'         => __( 'Multi-select', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),
				'options'       => array(
					'option-1'      => __( 'Option 1', 'starter-plugin' ),
					'option-2'      => __( 'Option 2', 'starter-plugin' ),
					'option-3'      => __( 'Option 3', 'starter-plugin' ),
					'option-4'      => __( 'Option 4', 'starter-plugin' ),
					'option-5'      => __( 'Option 5', 'starter-plugin' ),
				),
				'default'       => array( 'option-3', 'option-5' ),
			),

			// Radio and checkboxes
			array(
				'type'     => 'title',
				'title'    => __( 'Radio and checkboxes', 'starter-plugin' ),
			),
			array(
				'id'            => 'sample_radio',
				'type'          => 'radio',
				'title'         => __( 'Radio', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),
				'options'       => array(
					'option-1'      => __( 'Option 1', 'starter-plugin' ),
					'option-2'      => __( 'Option 2', 'starter-plugin' ),
					'option-3'      => __( 'Option 3', 'starter-plugin' ),
				),
				'default'       => '',
			),
			array(
				'id'            => 'sample_checkbox',
				'type'          => 'checkbox',
				'title'         => __( 'Single checkbox', 'starter-plugin' ),
				'desc'          => __( 'This is the label of this specific checkbox', 'starter-plugin' ),
				'default'       => '',
			),
			array(
				'type'          => 'checkboxgroup',
				'title'         => __( 'Checkbox group', 'starter-plugin' ),
				'desc'          => __( 'This is an optional description.', 'starter-plugin' ),
				'options'       => array(
					array(
						'id'        => 'sample_checkbox_group_1',
						'title'     => __( 'This is the label of this specific checkbox', 'starter-plugin' ),
						'default'   => true
					),
					array(
						'id'        => 'sample_checkbox_group_2',
						'title'     => __( 'This is the label of this specific checkbox', 'starter-plugin' ),
					),
					array(
						'id'        => 'sample_checkbox_group_3',
						'title'     => __( 'This is the label of this specific checkbox', 'starter-plugin' ),
					),
				),
				'default'       => '',
			),

		);

		return apply_filters( 'st_get_settings_' . $this->id, $settings );
	}
}

// Return an instance of the the settings page
return new ST_Settings_General();