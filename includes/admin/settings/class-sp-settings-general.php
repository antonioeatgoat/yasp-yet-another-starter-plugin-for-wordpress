<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class SP_Settings_General
 *
 * @author Antonio Mangiacapra
 */
class SP_Settings_General extends SP_Admin_Settings_Page {

	/**
	 * SP_Settings_General constructor.
	 */
	public function __construct() {
		$this->id    = 'general';
		$this->label = __( 'General', 'yasp' );

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
				'type'    => 'title',
				'title'   => __( 'Input types', 'yasp' ),
				'desc'    => __( 'All the simple input text types.', 'yasp' ),
			),
			array(
				'id'      => 'sample_text',
				'type'    => 'text',
				'title'   => __( 'Text', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'default' => 'Test default',
			),
			array(
				'id'          => 'sample_email',
				'type'        => 'email',
				'title'       => __( 'Email address', 'yasp' ),
				'desc'        => __( 'This is an optional description.', 'yasp' ),
				'default'     => '',
				'placeholder' => 'email@example.com'
			),
			array(
				'id'      => 'sample_number',
				'type'    => 'number',
				'title'   => __( 'Number', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'default' => '',
			),
			array(
				'id'      => 'sample_password',
				'type'    => 'password',
				'title'   => __( 'Password', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'default' => '',
			),
			array(
				'id'      => 'sample_textarea',
				'type'    => 'textarea',
				'title'   => __( 'Textarea', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'default' => '',
			),

			// Select boxes
			array(
				'type'  => 'title',
				'title' => __( 'Select boxes', 'yasp' ),
				'desc'  => __( 'Both single select and multi-select.', 'yasp' ),
			),
			array(
				'id'      => 'sample_select',
				'type'    => 'select',
				'title'   => __( 'Select', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'options' => array(
					'option-1' => __( 'Option 1', 'yasp' ),
					'option-2' => __( 'Option 2', 'yasp' ),
					'option-3' => __( 'Option 3', 'yasp' ),
					'option-4' => __( 'Option 4', 'yasp' ),
					'option-5' => __( 'Option 5', 'yasp' ),
				),
				'default' => '',
			),
			array(
				'id'      => 'sample_multiselect',
				'type'    => 'multiselect',
				'title'   => __( 'Multi-select', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'options' => array(
					'option-1' => __( 'Option 1', 'yasp' ),
					'option-2' => __( 'Option 2', 'yasp' ),
					'option-3' => __( 'Option 3', 'yasp' ),
					'option-4' => __( 'Option 4', 'yasp' ),
					'option-5' => __( 'Option 5', 'yasp' ),
				),
				'default' => array( 'option-3', 'option-5' ),
			),

			// Radio and checkboxes
			array(
				'type'  => 'title',
				'title' => __( 'Radio and checkboxes', 'yasp' ),
			),
			array(
				'id'      => 'sample_radio',
				'type'    => 'radio',
				'title'   => __( 'Radio', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'options' => array(
					'option-1' => __( 'Option 1', 'yasp' ),
					'option-2' => __( 'Option 2', 'yasp' ),
					'option-3' => __( 'Option 3', 'yasp' ),
				),
				'default' => '',
			),
			array(
				'id'      => 'sample_checkbox',
				'type'    => 'checkbox',
				'title'   => __( 'Single checkbox', 'yasp' ),
				'desc'    => __( 'This is the label of this specific checkbox', 'yasp' ),
				'default' => '',
			),
			array(
				'type'    => 'checkboxgroup',
				'title'   => __( 'Checkbox group', 'yasp' ),
				'desc'    => __( 'This is an optional description.', 'yasp' ),
				'options' => array(
					array(
						'id'      => 'sample_checkbox_group_1',
						'title'   => __( 'This is the label of this specific checkbox', 'yasp' ),
						'default' => true
					),
					array(
						'id'    => 'sample_checkbox_group_2',
						'title' => __( 'This is the label of this specific checkbox', 'yasp' ),
					),
					array(
						'id'    => 'sample_checkbox_group_3',
						'title' => __( 'This is the label of this specific checkbox', 'yasp' ),
					),
				),
				'default' => '',
			),

		);

		return apply_filters( 'sp_get_settings_' . $this->id, $settings );
	}
}

// Return an instance of the the settings page
return new SP_Settings_General();