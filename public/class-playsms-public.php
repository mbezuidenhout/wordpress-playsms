<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.facebook.com/marius.bezuidenhout1
 * @since      1.0.0
 *
 * @package    Playsms
 * @subpackage Playsms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Playsms
 * @subpackage Playsms/public
 * @author     Marius Bezuidenhout
 */
class Playsms_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/playsms-public' . $suffix . '.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/playsms-public' . $suffix . '.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the mobile field to the user profile page.
	 *
	 * @return array
	 */
	public function add_mobile_field_to_profile_form() {
		$fields['mobile'] = __( 'Mobile', 'playsms' );

		return $fields;
	}

	/**
	 * Add the mobile field to the user registration page.
	 */
	public function add_mobile_field_to_register_form() {
		$mobile = ( isset( $_POST['mobile'] ) ) ? sanitize_text_field( wp_unslash( $_POST['mobile'] ) ) : '';
		Playsms::get_template( 'mobile-field-register.php', array( 'mobile' => $mobile ) );
	}

}
