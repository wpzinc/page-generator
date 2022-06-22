<?php
/**
 * Outputs the Publish metabox when adding/editing a Content Groups
 *
 * @package Page_Generator_Pro
 * @author WP Zinc
 */

?>
<div class="wpzinc-option sidebar">
	<div class="left">
		<label for="status"><?php esc_html_e( 'Status', 'page-generator' ); ?></label>
	</div>
	<div class="right">
		<select name="<?php echo esc_attr( $this->base->plugin->name ); ?>[status]" id="status" size="1" class="widefat">
			<?php
			if ( is_array( $statuses ) && count( $statuses ) > 0 ) {
				foreach ( $statuses as $status => $label ) { // phpcs:ignore
					?>
					<option value="<?php echo esc_attr( $status ); ?>"<?php selected( $this->settings['status'], $status ); ?>>
						<?php echo esc_attr( $label ); ?>
					</option>
					<?php
				}
			}
			?>
		</select>
	</div>
</div>

<?php
// Upgrade Notice.
if ( class_exists( 'Page_Generator' ) ) {
	require $this->base->plugin->folder . 'views/admin/generate-meta-box-publish-upgrade.php';
}
