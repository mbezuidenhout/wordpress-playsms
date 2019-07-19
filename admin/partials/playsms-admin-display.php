<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.facebook.com/marius.bezuidenhout1
 * @since      1.0.0
 *
 * @package    Playsms
 * @subpackage Playsms/admin/partials
 */
?>
<div class="wrap">
    <h2><?php _e( 'Send SMS', 'wp-sms' ); ?></h2>
    <div class="postbox-container" style="padding-top: 20px;">
        <div class="meta-box-sortables">
            <div class="postbox">
                <div class="inside">
                    <form method="post" action="">
						<?php wp_nonce_field( 'playsms-sendsms' ); ?>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    <label for="select_sender"><?php _e( 'Send to', 'playsms' ); ?>:</label>
                                </th>
                                <td>
                                    <span>
                                        <div class="clearfix"></div>
                                        <input type="text" id="to_number" name="to_number"></input>
                                    </span>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    <label for="wp_get_message"><?php _e( 'Message', 'playsms' ); ?>:</label>
                                </th>
                                <td>
                                    <textarea dir="auto" cols="80" rows="5" name="message"
                                              id="message"></textarea><br/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="submit" style="padding: 0;">
                                        <input type="submit" class="button-primary" name="submit"
                                               value="<?php _e( 'Send SMS', 'playsms' ); ?>"/>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>