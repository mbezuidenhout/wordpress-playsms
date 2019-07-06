<p class="two-factor-extensions-mobile form-row">
	<label for="mobile">
		<?php _e( 'Your mobile number', 'playsms' ) ?>
		<span class="required">*</span>
	</label>
		<input type="text" name="mobile" id="mobile" class="input-mobile"
		       value="<?php echo esc_attr( stripslashes( $mobile ) ); ?>" size="25"/></label>
</p>