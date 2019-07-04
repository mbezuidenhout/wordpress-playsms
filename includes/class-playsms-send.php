<?php

class Playsms_Send {

	/**
	 * Singleton instance of this class
	 *
	 * @var Playsms_Send
	 */
	private static $instance;

	/**
	 * Returns the singleton instance of this class
	 *
	 * @return Playsms_Send
	 */
	public static function get_instance() {
		if ( ! self::$instance instanceof self ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Sends a text message to phone number
	 *
	 * @param string $to The phone number to send the message to.
	 * @param string $message The message to send.
	 */
	public function send( $to, $message ) {

	}
}