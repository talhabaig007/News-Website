<?php
/**
 * Plugin Name:       Maintenance Notice  
 * Plugin URI:		  https://wordpress.org/plugins/maintenance-notice/
* Description:        Maintenance Notice is a WordPress plugin that allows you to put the maintenance notice on your website. It helps to inform the visitors that your site is in maintenance mode without showing the broken site to the users.
 * Version:           1.0.3
 * Author:            CodeVibrant
 * Author URI:        https://codevibrant.com/
 * License:           GNU General Public License v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       maintenance-notice
 * 
 * @since             1.0.0
 * @package           Maintenance Notice
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
if ( !defined( 'MAINTENANCE_NOTICE' ) ) {
	define( 'MAINTENANCE_NOTICE', 'Maintenance Notice' );
}
define( 'MAINTENANCE_NOTICE_VERSION', '1.0.3' );
define( 'MAINTENANCE_NOTICE_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAINTENANCE_NOTICE_URL', plugin_dir_url( __FILE__ ) );
define( 'MAINTENANCE_NOTICE_ADMIN_PATH', plugin_dir_path( __FILE__ ). 'admin' );
define( 'MAINTENANCE_NOTICE_ADMIN_URL', plugin_dir_url( __FILE__ ). 'admin' );
define( 'MAINTENANCE_NOTICE_INCLUDES_PATH', plugin_dir_path( __FILE__ ). 'includes' );
define( 'MAINTENANCE_NOTICE_TEMPLATE_ACTIVE', false );
define( 'MAINTENANCE_NOTICE_INCLUDES_URL', plugin_dir_url( __FILE__ ). 'includes' );

if ( !function_exists( 'maintenance_notice_activation' ) ) :

	require plugin_dir_path( __FILE__ ) . 'includes/class-maintenance-notice-activator.php';
	/**
	 * When plugin is activated.
	 *  - sets transients for firing get started notice and expires after given time.
	 */
	function maintenance_notice_activation() {
		set_transient( 'maintenance-notice-admin-notice', true, 5 );
		$activator_class = new Maintenance_Notice_Activator();
		$activator_class->activate();
	}
	register_activation_hook( __FILE__, 'maintenance_notice_activation' );

endif;

/**
 * Execution of the plugin.
 *
 * @since    1.0.0
 */
if ( !function_exists( 'maintenance_notice_lite_run' ) ):

	function maintenance_notice_lite_run() {
		/**
		 * defines plugin functioning codes ( internationalization, admin-specific hooks, and public-facing site hooks )
		 */
		require plugin_dir_path( __FILE__ ) . 'includes/class-maintenance-notice.php';
		require plugin_dir_path( __FILE__ ) . 'admin/class-maintenance-notice-admin.php';
		$instance = Maintenance_Notice::instance();
	}

	add_action( 'plugins_loaded', 'maintenance_notice_lite_run' );

endif;