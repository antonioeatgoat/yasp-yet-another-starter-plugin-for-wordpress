<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class SP_Admin_Settings_Page
 *
 * Abstract class for settings pages. Every class that will implements it will becomes a different settings page in
 * the administration page of the plugin.
 * Every settings page will fill a different tab content in the same unique administration page.
 *
 * @author Antonio Mangiacapra
 */
abstract class SP_Admin_Settings_Page implements SP_Admin_Settings_Page_Interface {

	/**
	 * Settings page id.
	 *
	 * @var string
	 */
	protected $id = '';

	/**
	 * Settings page label.
	 *
	 * @var string
	 */
	protected $label = '';

	/**
	 * SP_Admin_Settings_Page constructor.
	 */
	public function __construct() {

		// Add the information of this settings page to the tabs array, that will be fetched by filter
		add_filter( 'sp_settings_tabs', array( $this, 'register_tab_title' ) );
	}

	/**
	 * Add the current settings page information to the tabs array
	 *
	 * @param $pages
	 *
	 * @return mixed
	 */
	public function register_tab_title( $pages ) {
		$pages[ $this->id ] = $this->label;

		return $pages;
	}

	/**
	 * Render all the fields of the current settings page
	 *
	 * Fields allowed:
	 *  - title
	 *  - separator
	 *  - text
	 *  - email
	 *  - number
	 *  - password
	 *  - textarea
	 *  - select
	 *  - multiselect
	 *  - radio
	 *  - checkbox
	 *  - checkboxgroup
	 */
	public function render_fields() {

		// Needed by WordPress to handle automatically the update of the settings previously registered
		settings_fields( 'sp_settings_group_' . $this->id );

		// Declare the default values of each setting
		$defaults = array(
			'id'          => '',
			'type'        => '',
			'title'       => '',
			'desc'        => '',
			'placeholder' => '',
			'options'     => array(),
			'default'     => '',
			'class'       => '',
			'custom_attr' => array()
		);

		$settings     = $this->get_settings();
		$table_opened = false;

		foreach ( $settings as $key => $setting ) {

			/*
			 * Prepare attributes and other data
			 */

			$setting = wp_parse_args( $setting, $defaults );

			$setting['id'] = ( $setting['id'] ) ? SP_Admin_Settings::OPTION_NAME_PREFIX . $setting['id'] : '';

			$custom_attr = array();
			if ( ! empty( $value['custom_attr'] ) && is_array( $value['custom_attr'] ) ) {
				foreach ( $value['custom_attr'] as $attribute => $attribute_value ) {
					$custom_attr[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
				}
			}

			$description = $this->get_field_description( $setting );

			/* Finished to prepare attributes and other data */

			// Open and close <table> tag when needed
			if ( in_array( $setting['type'], array( 'title', 'separator' ) ) ) {
				if ( $table_opened ) {
					echo '</table>';
					$table_opened = false;
				}
			} else {
				if ( ! $table_opened ) {
					echo '<table class="form-table">';
					$table_opened = true;
				}
			}

			switch ( $setting['type'] ) {

				case 'title' :

					// If the title is the first setting of the page and there isn't any nav menu, then use h1
					$tag = ( 0 === $key
					         && count( apply_filters( 'sp_settings_tabs', array() ) ) < 2
					) ? 'h1' : 'h2';
					if ( $setting['title'] ) {
						echo "<{$tag}>" . esc_html( $setting['title'] ) . "</{$tag}>";
					}

					echo $description;

					break;

				case 'separator' :

					echo '<hr>';

					break;

				case 'text' :
				case 'email' :
				case 'number' :
				case 'password' :

					$value = SP_Admin_settings::get_option( $setting['id'], $setting['default'] );

					?>
					<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $setting['id'] ); ?>"><?php echo esc_html( $setting['title'] ); ?></label>
					</th>
					<td class="st-field-input st-field-input-<?php echo sanitize_title( $setting['type'] ) ?>">
						<input
								name="<?php echo esc_attr( $setting['id'] ); ?>"
								id="<?php echo esc_attr( $setting['id'] ); ?>"
								type="<?php echo esc_attr( $setting['type'] ); ?>"
								value="<?php echo esc_attr( $value ); ?>"
								placeholder="<?php echo esc_attr( $setting['placeholder'] ); ?>"
								class="regular-text <?php echo esc_attr( $setting['class'] ); ?>"
							<?php echo implode( ' ', $custom_attr ); ?>
						/> <?php echo $description; ?>
					</td>
					</tr><?php
					break;

				case 'textarea' :

					$value = SP_Admin_settings::get_option( $setting['id'], $setting['default'] );

					?>
					<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $setting['id'] ); ?>"><?php echo esc_html( $setting['title'] ); ?></label>
					</th>
					<td class="st-field-input st-field-input-<?php echo sanitize_title( $setting['type'] ) ?>">
                            <textarea
		                            name="<?php echo esc_attr( $setting['id'] ); ?>"
		                            id="<?php echo esc_attr( $setting['id'] ); ?>"
		                            placeholder="<?php echo esc_attr( $setting['placeholder'] ); ?>"
		                            class="regular-text <?php echo esc_attr( $setting['class'] ); ?>"
	                            <?php echo implode( ' ', $custom_attr ); ?>
                            ><?php echo esc_textarea( $value ); ?></textarea>
						<?php echo $description; ?>
					</td>
					</tr><?php
					break;

				case 'select' :
				case 'multiselect' :

					$value = SP_Admin_settings::get_option( $setting['id'], $setting['default'] );

					?>
					<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $setting['id'] ); ?>"><?php echo esc_html( $setting['title'] ); ?></label>
					</th>
					<td class="st-field-input st-field-input-<?php echo sanitize_title( $setting['type'] ) ?>">
						<select
								name="<?php echo esc_attr( $setting['id'] ); ?><?php echo ( 'multiselect' === $setting['type'] ) ? '[]' : ''; ?>"
								id="<?php echo esc_attr( $setting['id'] ); ?>"
								class="regular-text <?php echo esc_attr( $setting['class'] ); ?>"
							<?php echo implode( ' ', $custom_attr ); ?>
							<?php echo ( 'multiselect' == $setting['type'] ) ? 'multiple="multiple"' : ''; ?>
						>
							<?php
							foreach ( $setting['options'] as $option_value => $option_label ) {
								?>
								<option value="<?php echo esc_attr( $option_value ); ?>" <?php

								if ( is_array( $value ) ) {
									selected( in_array( $option_value, $value ), true );
								} else {
									selected( $value, $option_value );
								}

								?>><?php echo $option_label ?></option>
								<?php
							}
							?>
						</select> <?php echo $description; ?>
					</td>
					</tr><?php
					break;

				case 'radio' :

					$value = SP_Admin_settings::get_option( $setting['id'], $setting['default'] );

					?>
					<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="<?php echo esc_attr( $setting['id'] ); ?>"><?php echo esc_html( $setting['title'] ); ?></label>
					</th>
					<td class="st-field-input st-field-input-<?php echo sanitize_title( $setting['type'] ) ?>">
						<fieldset>
							<ul>
								<?php
								foreach ( $setting['options'] as $option_value => $option_label ) {
									?>
									<li>
										<label><input
													name="<?php echo esc_attr( $setting['id'] ); ?>"
													value="<?php echo $option_value; ?>"
													type="radio"
													class="<?php echo esc_attr( $setting['class'] ); ?>"
												<?php echo implode( ' ', $custom_attr ); ?>
												<?php checked( $option_value, $value ); ?>
											/> <?php echo $option_label ?></label>
									</li>
									<?php
								}
								?>
							</ul>
							<?php echo $description; ?>
						</fieldset>
					</td>
					</tr><?php
					break;

				case 'checkbox' :
				case 'checkboxgroup' :

					?>
					<tr valign="top">
					<th scope="row" class="titledesc"><?php echo esc_html( $setting['title'] ) ?></th>
					<td class="st-field-input st-field-input-checkbox">

						<?php

						if ( 'checkboxgroup' == $setting['type'] && is_array( $setting['options'] ) ) {
							$checkboxes = $setting['options'];
						} else {
							$checkboxes = array(
								array(
									'id'    => $setting['id'],
									'title' => $setting['desc']
								)
							);
						}

						foreach ( $checkboxes as $checkbox ):

							$checkbox['default'] = ( isset( $checkbox['default'] ) ) ? $checkbox['default'] : false;

							if ( 'checkboxgroup' == $setting['type'] ) {
								$checkbox['id'] = SP_Admin_Settings::OPTION_NAME_PREFIX . $checkbox['id'];
							}

							$value = SP_Admin_settings::get_option( $checkbox['id'], $checkbox['default'] );

							?>
							<fieldset>
							<?php
							if ( ! empty( $checkbox['title'] ) ) {
								echo '<legend class="screen-reader-text"><span>' . esc_html( $checkbox['title'] ) . '</span></legend>';
							}
							?>
							<label for="<?php echo $checkbox['id'] ?>">
								<input
										name="<?php echo esc_attr( $checkbox['id'] ); ?>"
										id="<?php echo esc_attr( $checkbox['id'] ); ?>"
										type="checkbox"
										class="<?php echo esc_attr( $setting['class'] ); ?>"
										value="1"
									<?php checked( $value, 1 ); ?>
									<?php echo implode( ' ', $custom_attr ); ?>
								/> <?php echo wp_kses_post( $checkbox['title'] ) ?>
							</label>

							</fieldset><?php
						endforeach;

						if ( 'checkboxgroup' == $setting['type'] ) {
							echo $description;
						}

						?></td>
					</tr><?php
					break;
			}

		}

		// Close the <table> tag if it has been opened before
		if ( $table_opened ) {
			echo '</table>';
		}

	}

	/**
	 * Returns the formatted description of a given setting
	 *
	 * @param $setting
	 *
	 * @return string
	 */
	public function get_field_description( $setting ) {

		if ( empty( $setting['desc'] ) ) {
			return '';
		}

		if ( in_array( $setting['type'], array( 'checkbox' ) ) ) {
			$description = wp_kses_post( $setting['desc'] );
		} else {
			$description_class = ( 'title' != $setting['type'] ) ? 'description' : '';
			$description       = '<p class="' . $description_class . '">' . wp_kses_post( $setting['desc'] ) . '</p>';
		}

		return $description;
	}

	/**
	 * Get the settings page id
	 *
	 * @return string
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Get the settings page label
	 *
	 * @return string
	 */
	public function get_label() {
		return $this->label;
	}

}