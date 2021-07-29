 <div class="wpzinc-option sidebar">
	<div class="left">
		<label for="method"><?php _e( 'Method', 'page-generator-pro' ); ?></label>
	</div>
	<div class="right">
		<select name="<?php echo $this->base->plugin->name; ?>[method]" id="method" size="1" class="widefat">
			<?php
			if ( is_array( $methods ) && count( $methods ) > 0 ) {
				foreach ( $methods as $method => $label ) {
					?>
					<option value="<?php echo $method; ?>"<?php selected( $this->settings['method'], $method ); ?>>
						<?php echo $label; ?>
					</option>
					<?php
				}
			}
			?>
		</select>
	</div>
	<p class="description">
		<?php
		echo sprintf( 
			/* translators: Post Type, Plural (e.g. Posts, Pages) */
			__( '<strong>All:</strong> Generates %s for all possible combinations of terms across all keywords used.', 'page-generator-pro' ),
			$labels['plural']
		);
		?>
	</p>
	<p class="description">
		<?php _e( '<strong>Sequential:</strong> Honors the order of terms in each keyword used. Once all terms have been used in a keyword, the generator stops.', 'page-generator-pro' ); ?>
	</p>
</div>

<div class="wpzinc-option">
	<div class="left">
		<strong><?php _e( 'No. Posts', 'page-generator' ); ?></strong>
	</div>
	<div class="right">
		<input type="number" name="<?php echo $this->base->plugin->name; ?>[numberOfPosts]" value="<?php echo $this->settings['numberOfPosts']; ?>" step="1" min="0" class="widefat" />
	</div>
	<p class="description">
		<?php _e( 'The number of Pages to generate. If zero or blank, all Pages will be generated.', 'page-generator' ); ?>
	</p>
</div>

<?php
// Upgrade Notice
if ( class_exists( 'Page_Generator' ) ) {
    require( $this->base->plugin->folder . 'views/admin/generate-meta-box-generation-upgrade.php' );
}