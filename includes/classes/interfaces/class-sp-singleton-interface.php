<?php

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Interface SP_Singleton_Interface
 *
 * All the classes that need to be automatically instanced by the core and need to have a unique single instance,
 * must implement this interface
 *
 * @author Antonio Mangiacapra
 */
interface SP_Singleton_Interface {
	public static function instance();
}