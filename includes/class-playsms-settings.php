<?php


class Playsms_Settings {
	/**
	 * Singleton instance of this class
	 *
	 * @var \Playsms_Settings
	 */
	private static $instance;


	/**
	 * Returns the singleton instance of the settings class
	 */
	public static function get_instance() {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new Playsms_Settings();
		}

		return self::$instance;
	}

	/**
	 * Register plugin settings
	 */
	public function settings_page() {
		$this->add_settings_fields();
		// Check that the user is allowed to update options.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'playsms' ) );
		}

		// save options.
		$this->save_settings();

		?>
		<?php settings_errors(); ?>

        <form method="post" action="">

			<?php settings_fields( 'playsms_settings_group' );               //settings group, defined as first argument in register_setting ?>
			<?php do_settings_sections( 'playsms_settings_page_section' );   //same as last argument used in add_settings_section ?>
			<?php submit_button(); ?>

			<?php wp_nonce_field( 'playsms_settings_nonce' ); ?>
            <div class="clear"></div>
        </form>
		<?php

	}

	protected function save_settings() {

	}

	public function validate_settings_fields( $field ) {

	}

	/**
	 * Registers plugin settings
	 */
	protected function add_settings_fields() {
		register_setting( 'playsms_settings_group', 'playsms_settings', array( $this, 'validate_settings_fields' ) );
		add_settings_section( 'playsms_settings_section', null, null, 'playsms_settings_page_section' );

		foreach ( $this->get_settings() as $setting ) {
			add_settings_field( $setting['id'], $setting['title'], array( $this, 'render_settings_field' ),
				'playsms_settings_page_section', 'playsms_settings_section' );
		}
	}

	public function render_settings_field( $field ) {
		switch ( $field['type'] ) {
			case 'text':
			default:
				echo '<input id="' . esc_attr( $field['id'] ) . '" type="text" value="' . esc_attr( $field['default'] ) . '" />';
				break;
		}

	}

	private function get_settings() {
		$settings = apply_filters(
			'playsms_settings',
			array(
				array(
					'id'      => 'playsms_username',
					'title'   => __( 'Username', 'playsms' ),
					'desc'    => '',
					'default' => '',
					'type'    => 'text',
					'tip'     => true,
				),
				array(
					'id'      => 'playsms_password',
					'title'   => __( 'Password', 'playsms' ),
					'desc'    => '',
					'default' => '',
					'type'    => 'password',
					'tip'     => true,
				),
				array(
					'id'      => 'playsms_webservices_token',
					'title'   => __( 'Web Services Token', 'playsms' ),
					'desc'    => '',
					'default' => '',
					'type'    => 'text',
					'tip'     => true,
				),
			)
		);

		return $settings;
	}

}