<?php
/**
 * Outputs a form field when adding or editing a Keyword
 *
 * @package Page_Generator_Pro
 * @author WP Zinc
 */

?>
<div class="wpzinc-option">
	<div class="left">
		<label for="<?php echo esc_attr( $option_name ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
	</div>
	<div class="right">
		<?php
		// Output Form Field.
		switch ( $option['type'] ) {
			case 'text':
				?>
				<input type="text" name="<?php echo esc_attr( $source_name ); ?>[<?php echo esc_attr( $option_name ); ?>]" id="<?php echo esc_attr( $option_name ); ?>" value="<?php echo stripslashes( $value ); // phpcs:ignore ?>" class="widefat" />
				<?php
				break;

			case 'textarea':
				?>
				<textarea name="<?php echo esc_attr( $source_name ); ?>[<?php echo esc_attr( $option_name ); ?>]" id="<?php echo esc_attr( $option_name ); ?>" rows="10" class="widefat no-wrap" style="height:300px"><?php echo stripslashes( $value ); // phpcs:ignore ?></textarea>
				<?php
				break;

			case 'select':
				?>
				<select name="<?php echo esc_attr( $source_name ); ?>[<?php echo esc_attr( $option_name ); ?>]" size="1">
					<?php
					foreach ( $option['values'] as $key => $label ) {
						?>
						<option value="<?php echo esc_attr( $key ); ?>"<?php selected( $key, $value ); ?>><?php echo esc_attr( $label ); ?></option>
						<?php
					}
					?>
				</select>
				<?php
				break;

		}

		// Output Description.
		if ( isset( $option['description'] ) ) {
			?>
			<p class="description">
				<?php
				if ( is_array( $option['description'] ) ) {
					echo implode( '<br />', $option['description'] ); // phpcs:ignore
				} else {
					echo esc_attr( $option['description'] );
				}
				?>
			</p>
			<?php
		}
		?>
	</div>
</div>
