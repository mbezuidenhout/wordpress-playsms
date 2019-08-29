<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.facebook.com/marius.bezuidenhout1
 * @since             1.0.0
 * @package           Playsms
 *
 * @wordpress-plugin
 * Plugin Name:       PlaySMS
 * Plugin URI:        https://github.com/mbezuidenhout/wordpress-playsms
 * Description:       Add functions to WordPress to send SMS via a PlaySMS gateway
 * Version:           1.0.1
 * Author:            Marius Bezuidenhout
 * Author URI:        https://www.facebook.com/marius.bezuidenhout1
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       playsms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLAYSMS_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-playsms-activator.php
 */
function activate_playsms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-playsms-activator.php';
	Playsms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-playsms-deactivator.php
 */
function deactivate_playsms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-playsms-deactivator.php';
	Playsms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_playsms' );
register_deactivation_hook( __FILE__, 'deactivate_playsms' );

/**
 * Create a function similar to wp_mail for sending sms messages
 */
if ( ! function_exists( 'wp_sms' ) ) {
	/**
	 * Send SMS message to phone number
	 *
	 * @param string $to Phone number to send message to.
	 * @param string $message String message to send.
	 */
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-playsms-send.php';

	/**
	 * Send a sms text message to a cell phone
	 *
	 * @param string $to Phone number to send to.
	 * @param string $message Message to send.
	 *
	 * @return bool Has the message been sent successfully?
	 */
	function wp_sms( $to, $message ) {
		$playsms = Playsms_Send::get_instance();

		return $playsms->send( $to, $message );
	}
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-playsms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_playsms() {

	$plugin = new Playsms();
	$plugin->run();

}

run_playsms();
