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
	 * Last error code received.
	 *
	 * @var int
	 */
	protected $last_error_code;

	/**
	 * The last queue id received.
	 *
	 * @var string
	 */
	protected $last_queue_id;

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
	 * Get the error assiciated with the error code.
	 *
	 * @param int $code Error code number.
	 *
	 * @return string Error message.
	 */
	public function get_error( $code ) {
		$error_msg = '';
		switch ( $code ) {
			case 97:
				$error_msg = __( 'unexpected json format', 'playsms' );
				break;
			case 98:
				$error_msg = __( 'failed connecting to url endpoint', 'playsms' );
				break;
			case 99:
				$error_msg = __( 'invalid json received', 'playsms' );
				break;
			case 100:
				$error_msg = __( 'authentication failed', 'playsms' );
				break;
			case 101:
				$error_msg = __( 'type of action is invalid or unknown', 'playsms' );
				break;
			case 102:
				$error_msg = __( 'one or more field empty', 'playsms' );
				break;
			case 103:
				$error_msg = __( 'not enough credit for this operation', 'playsms' );
				break;
			case 104:
				$error_msg = __( 'webservice token is not available', 'playsms' );
				break;
			case 105:
				$error_msg = __( 'webservice token not enable for this user', 'playsms' );
				break;
			case 106:
				$error_msg = __( 'webservice token not allowed from this IP address', 'playsms' );
				break;
			case 200:
				$error_msg = __( 'send message failed', 'playsms' );
				break;
			case 201:
				$error_msg = __( 'destination number or message is empty', 'playsms' );
				break;
			case 400:
				$error_msg = __( 'no delivery status available', 'playsms' );
				break;
			case 401:
				$error_msg = __( 'no delivery status retrieved and SMS still in queue', 'playsms' );
				break;
			case 402:
				$error_msg = __( 'no delivery status retrieved and SMS has been processed from queue', 'playsms' );
				break;
			case 501:
				$error_msg = __( 'no data returned or result is empty', 'playsms' );
				break;
			case 600:
				$error_msg = __( 'admin level authentication failed', 'playsms' );
				break;
			case 601:
				$error_msg = __( 'inject message failed', 'playsms' );
				break;
			case 602:
				$error_msg = __( 'sender id or message is empty', 'playsms' );
				break;
			case 603:
				$error_msg = __( 'account addition failed due to missing data', 'playsms' );
				break;
			case 604:
				$error_msg = __( 'fail to add account', 'playsms' );
				break;
			case 605:
				$error_msg = __( 'account removal failed due to unknown username', 'playsms' );
				break;
			case 606:
				$error_msg = __( 'fail to remove account', 'playsms' );
				break;
			case 607:
				$error_msg = __( 'set parent failed due to unknown username', 'playsms' );
				break;
			case 608:
				$error_msg = __( 'fail to set parent', 'playsms' );
				break;
			case 609:
				$error_msg = __( 'get parent failed due to unknown username', 'playsms' );
				break;
			case 610:
				$error_msg = __( 'fail to get parent', 'playsms' );
				break;
			case 611:
				$error_msg = __( 'account ban failed due to unknown username', 'playsms' );
				break;
			case 612:
				$error_msg = __( 'fail to ban account', 'playsms' );
				break;
			case 613:
				$error_msg = __( 'account unban failed due to unknown username', 'playsms' );
				break;
			case 614:
				$error_msg = __( 'fail to unban account', 'playsms' );
				break;
			case 615:
				$error_msg = __( 'editing account preferences failed due to missing data', 'playsms' );
				break;
			case 616:
				$error_msg = __( 'fail to edit account preferences', 'playsms' );
				break;
			case 617:
				$error_msg = __( 'editing account configuration failed due to missing data', 'playsms' );
				break;
			case 618:
				$error_msg = __( 'fail to edit account configuration', 'playsms' );
				break;
			case 619:
				$error_msg = __( 'viewing credit failed due to missing data', 'playsms' );
				break;
			case 620:
				$error_msg = __( 'fail to view credit', 'playsms' );
				break;
			case 621:
				$error_msg = __( 'adding credit failed due to missing data', 'playsms' );
				break;
			case 622:
				$error_msg = __( 'fail to add credit', 'playsms' );
				break;
			case 623:
				$error_msg = __( 'deducting credit failed due to missing data', 'playsms' );
				break;
			case 624:
				$error_msg = __( 'fail to deduct credit', 'playsms' );
				break;
			case 625:
				$error_msg = __( 'setting login key failed due to missing data', 'playsms' );
				break;
			case 626:
				$error_msg = __( 'fail to set login key', 'playsms' );
				break;
		}

		return $error_msg;
	}

	/**
	 * Get the last error code.
	 *
	 * @return int
	 */
	public function get_last_error_code() {
		return $this->last_error_code;
	}

	/**
	 * Get the last error message.
	 *
	 * @return string
	 */
	public function get_last_error_message() {
		return $this->get_error( $this->last_error_code );
	}

	/**
	 * Sends a text message to phone number
	 *
	 * @param string $to The phone number to send the message to.
	 * @param string $message The message to send.
	 *
	 * @return bool|WP_Error
	 */
	public function send( $to, $message ) {
		$this->last_error_code = 0;
		$this->last_queue_id   = '';

		$settings = PlaySMS_Settings::get_instance();

		$get_params = array(
			'app' => 'ws',
			'h'   => $settings->get_setting( 'token' ),
			'u'   => $settings->get_setting( 'username' ),
			'op'  => 'pv',
			'to'  => $to,
			'msg' => $message,
		);

		$url = $settings->get_setting( 'endpoint' ) . '?' . http_build_query( $get_params, null, null, PHP_QUERY_RFC1738 );

		$response = wp_remote_get( $url, array( 'sslverify' => false ) );

		if ( is_wp_error( $response ) ) {
			$this->last_error_code = 98;

			return $response;
		} elseif ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return new WP_Error( wp_remote_retrieve_response_code( $response ), wp_remote_retrieve_response_message( $response ) );
		} elseif ( is_array( $response ) ) {
			try {
				$result = json_decode( $response['body'] );
			} catch ( Exception $e ) {
				$this->last_error_code = 99;

				return new WP_Error( $this->last_error_code, $this->get_error( $this->last_error_code ) );
			}
		}

		if ( is_object( $result )
			&& property_exists( $result, 'data' )
			&& ! empty( $result->data )
			&& property_exists( $result->data[0], 'error' )
			&& property_exists( $result->data[0], 'queue' )
			&& property_exists( $result->data[0], 'status' )
			) {
			$this->last_error_code = intval( $result->data[0]->error );
			$this->last_queue_id   = $result->data[0]->queue;
			if ( 'OK' === $result->data[0]->status ) {
				return true;
			} else {
				// TODO: Log result to log file.
				return new WP_Error( $this->last_error_code, $this->get_error( $this->last_error_code ) );
			}
		} else {
			return new WP_Error( 97, $this->get_error( 97 ) . '"' . $response['body'] . '"' );
		}
	}
}