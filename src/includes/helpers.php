<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Get the value of the given option saved in the database by the plugin
 *
 * @param string $option_name
 * @param string $default
 *
 * @return mixed
 *
 * @author Antonio Mangiacapra
 */
function st_get_option( $option_name, $default = '' ) {

	$value = ST_Admin_Settings::get_option( $option_name, $default);

	return apply_filters( 'st_get_option', $value, $option_name, $default );

}
