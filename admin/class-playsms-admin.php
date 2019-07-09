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
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * The settings class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      \Playsms_Settings $settings Instance of the settings class.
	 */
	private $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->settings    = Playsms_Settings::get_instance();

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/playsms-admin' . $suffix . '.css',
			array(), $this->version, 'all' );

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/playsms-admin' . $suffix . '.js',
			array( 'jquery' ), $this->version, false );

	}

	/**
	 * Output for the send sms page.
	 */
	public function send_sms_page() {

	}

	/**
	 * Callback action to add admin menu options
	 */
	public function admin_menu() {
		add_menu_page( __( 'PlaySMS', 'playsms' ), __( 'Send SMS', 'playsms' ), 'manage_options', 'playsms',
			array( $this, 'send_sms_page' ), 'dashicons-phone' );
		add_submenu_page( 'playsms', __( 'Settings', 'playsms' ), __( 'Settings', 'playsms' ), 'manage_options',
			'playsms-settings', array( Playsms_Settings::get_instance(), 'settings_page' ) );
	}


}
