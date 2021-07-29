<div class="wpzinc-option">
	<div class="left">
		<strong><?php _e( 'Status', 'page-generator' ); ?></strong>
	</div>
	<div class="right">
		<select name="<?php echo $this->base->plugin->name; ?>[status]" size="1">
			<?php
			if ( is_array( $statuses ) && count( $statuses ) > 0 ) {
				foreach ( $statuses as $status => $label ) {
					?>
					<option value="<?php echo $status; ?>"<?php selected( $this->settings['status'], $status ); ?>>
						<?php echo $label; ?>
					</option>
					<?php
				}
			}
			?>
		</select>
	</div>
</div>

<?php
// Upgrade Notice
if ( class_exists( 'Page_Generator' ) ) {
    require( $this->base->plugin->folder . 'views/admin/generate-meta-box-publish-upgrade.php' );
}