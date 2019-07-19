<?php
/**
 * Defined the plugin settings.
 *
 * @link       https://www.facebook.com/marius.bezuidenhout1
 * @since      1.0.0
 *
 * @package    Playsms
 * @subpackage Playsms/includes
 */

/**
 * Class Playsms_Settings defined the plugin options.
 */
class Playsms_Settings {
	/**
	 * Singleton instance of this class.
	 *
	 * @var Playsms_Settings
	 */
	private static $instance;

	/**
	 * Instance of the Playsms_Settings_API class.
	 *
	 * @var Playsms_Settings_API
	 */
	private $settings_api;

	/**
	 * Array of plugin settings.
	 *
	 * @var array
	 */
	protected $basic_settings;

	/**
	 * Returns the singleton instance of the settings class
	 */
	public static function get_instance() {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

	/**
	 * Get setting by name
	 *
	 * @param string $name Name of setting to retrieve.
	 *
	 * @return mixed
	 */
	public function get_setting( $name ) {
		if ( isset( $this->basic_settings[ $name ] ) ) {
			return $this->basic_settings[ $name ];
		} else {
			return false;
		}
	}

	/**
	 * Return all settings
	 *
	 * @return array
	 */
	public function get_settings() {
		return $this->basic_settings;
	}

	/**
	 * Get the token to use for sending messages.
	 *
	 * @return string
	 */
	public function get_token() {
		return $this->basic_settings['token'];
	}

	/**
	 * Playsms_Settings constructor.
	 */
	public function __construct() {
		$this->settings_api = new Playsms_Settings_API();

		$default_settings = array();
		foreach ( $this->get_settings_fields()['playsms_basics'] as $setting ) {
			$default_settings[ $setting['name'] ] = $setting['default'];
		}

		$settings             = empty( get_option( 'playsms_basics' ) ) ? array() : get_option( 'playsms_basics' );
		$this->basic_settings = array_merge( $settings, $default_settings );
	}

	/**
	 * Register plugin settings
	 */
	public function settings_page() {
		echo '<div class="wrap">';

		$this->settings_api->show_navigation();
		$this->settings_api->show_forms();

		echo '</div>';
	}

	/**
	 * Define the settings sections.
	 *
	 * @return array
	 */
	private function get_settings_sections() {
		$sections = array(
			array(
				'id'    => 'playsms_basics',
				'title' => __( 'Basic Settings', 'playsms' ),
			),
		);

		return apply_filters( 'playsms_settings_sections', $sections );
	}

	/**
	 * Registers plugin settings
	 */
	public function add_settings_fields() {
		// set the settings.
		$this->settings_api->set_sections( $this->get_settings_sections() );
		$this->settings_api->set_fields( $this->get_settings_fields() );

		// initialize settings.
		$this->settings_api->admin_init();
	}

	/**
	 * Returns all the settings fields
	 *
	 * @return array settings fields
	 */
	public function get_settings_fields() {
		$settings_fields = array(
			'playsms_basics' => array(
				array(
					'name'              => 'username',
					'label'             => __( 'Username', 'playsms' ),
					'desc'              => __( 'PlaySMS server username', 'playsms' ),
					'placeholder'       => __( 'Username', 'playsms' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
				),
				array(
					'name'              => 'endpoint',
					'label'             => __( 'Endpoint', 'playsms' ),
					'desc'              => __( 'PlaySMS server URL endpoint', 'playsms' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
				),
				array(
					'name'              => 'token',
					'label'             => __( 'Token', 'playsms' ),
					'desc'              => __( 'PlaySMS server webservice token', 'playsms' ),
					'placeholder'       => __( 'Token', 'playsms' ),
					'type'              => 'text',
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
				),
			),
		);

		return apply_filters( 'playsms_settings', $settings_fields );
	}


}