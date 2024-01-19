<?php
/**
 * Define the internationalization functionality
 *
 * @package Maintenance Notice
 * @since 1.0.0
 */
class Maintenance_Notice_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'maintenance-notice',
			false,
			MAINTENANCE_NOTICE_PATH . '/languages/'
		);

	}
}