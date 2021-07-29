<?php 
if ( ! $bottom ) {
	// Nonce field
	wp_nonce_field( 'save_generate', $this->base->plugin->name . '_nonce' );
}
?>

<!-- 
#submitpost is required, so WordPress can unload the beforeunload.edit-post JS event.
If we didn't do this, the user would always get a JS alert asking them if they want to navigate
away from the page as they may lose their changes
-->
<div class="submitbox" id="submitpost">
	<div id="publishing-action">
		<div class="wpzinc-option">
			<div class="full">
			<?php
			// Save
			if ( isset( $post ) && ( ! in_array( $post->post_status, array( 'publish', 'future', 'private' ) ) || 0 == $post->ID ) ) {
				// Publish
				?>
				<input name="original_publish" type="hidden" id="original_publish<?php echo $bottom; ?>" value="<?php esc_attr_e( 'Publish' ) ?>" />
				<?php submit_button( __( 'Save' ), 'primary button-large', 'publish', false, array(
					'id' => 'publish' . $bottom,
				) ); ?>
				<?php
			} else {
				// Update
				?>
				<input name="original_publish" type="hidden" id="original_publish<?php echo $bottom; ?>" value="<?php esc_attr_e( 'Update' ) ?>" />
				<?php submit_button( __( 'Save' ), 'primary button-large', 'publish', false, array(
					'id' => 'publish' . $bottom,
				) ); ?>
				<?php
			}

			// Test
			?>

			<?php submit_button( __( 'Test', 'page-generator' ), 'primary button-large', 'test', false, array(
				'id' => 'test' . $bottom,
			) ); ?>
			</div>
		</div>

		<div class="wpzinc-option">
			<?php submit_button( __( 'Generate via Browser', 'page-generator' ), 'primary button-large margin-bottom', 'generate', false, array(
				'id' => 'generate' . $bottom,
			) ); ?>
		</div>
	</div>
</div>

<?php
// Delete Generated Content, if any exist
if ( $this->settings['generated_pages_count'] > 0 ) {
	?>
	<div class="wpzinc-option">
		<div class="full">
			<?php
			if ( $this->settings['group_type'] == 'content' ) {
				?>
				<span class="trash_generated_content">
					<a href="<?php echo admin_url( 'edit.php?post_type=' . $this->base->get_class( 'post_type' )->post_type_name . '&' . $this->base->plugin->name . '-action=trash-generated-content&id=' . $group_id . '&type=' . $this->settings['group_type'] ); ?>" class="button wpzinc-button-red trash-generated-content" data-group-id="<?php echo $group_id; ?>" data-limit="<?php echo $limit; ?>" data-total="<?php echo $this->settings['generated_pages_count']; ?>">
						<?php _e( 'Trash Generated Content', 'page-generator' ); ?>
					</a>
				</span>
				<br />
				<?php
			}
			?>
			<span class="delete_generated_content">
				<a href="<?php echo admin_url( 'edit.php?post_type=' . $this->base->get_class( 'post_type' )->post_type_name . '&' . $this->base->plugin->name . '-action=delete-generated-content&id=' . $group_id . '&type=' . $this->settings['group_type'] ); ?>" class="button wpzinc-button-red delete-generated-content" data-group-id="<?php echo $group_id; ?>" data-limit="<?php echo $limit; ?>" data-total="<?php echo $this->settings['generated_pages_count']; ?>">
					<?php _e( 'Delete Generated Content', 'page-generator' ); ?>
				</a>
			</span>
		</div>
	</div>
	<?php	
}