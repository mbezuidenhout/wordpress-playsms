<?php
/**
 * Defines sms sending functions.
 *
 * @link       https://www.facebook.com/marius.bezuidenhout1
 * @since      1.0.0
 *
 * @package    Playsms
 * @subpackage Playsms/includes
 */

/**
 * Class Playsms_Send defined message sending function.
 */
class Playsms_Send {

	/**
	 * Singleton instance of this class
	 *
	 * @var Playsms_Send
	 */
	protected static $instance;

	/**
	 * Returns the singleton instance of this class
	 *
	 * @return Playsms_Send
	 */
	public static function get_instance() {
		if ( ! static::$instance instanceof self ) {
			static::$instance = new static();
		}

		return static::$instance;
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