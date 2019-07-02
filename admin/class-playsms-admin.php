<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.facebook.com/marius.bezuidenhout1
 * @since      1.0.0
 *
 * @package    Playsms
 * @subpackage Playsms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Playsms
 * @subpackage Playsms/admin
 * @author     Marius Bezuidenhout
 */
class Playsms_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name  The name of this plugin.
	 * @param    string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Add plugin caps to admin role
		if ( is_admin() and is_super_admin() ) {
			$this->add_cap();
		}
	}

	public function add_cap() {
		$role = get_role( 'administrator' );

		$role->add_cap( 'playsms_sendsms' );
		$role->add_cap( 'playsms_setting' );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Playsms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Playsms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$suffix = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/playsms-admin' . $suffix . '.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Playsms_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Playsms_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/playsms-admin' . $suffix . '.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Callback action to add admin menu options
	 */
	public function admin_bar() {
		add_menu_page( 'PlaySMS', 'PlaySMS', 'playsms_sendsms', 'playsms', array( $this, 'send_sms_page' ), 'dashicons-email-alt' );
		add_submenu_page( 'playsms', 'Send SMS', 'Send SMS', 'playsms_sendsms', 'playsms', array( $this, 'send_sms_callback' ) );
	}

	public function send_sms_page() {

	}

}
