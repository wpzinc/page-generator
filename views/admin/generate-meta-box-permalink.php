<!-- Permalink -->
<div class="wpzinc-option">
	<div class="left">
		<label for="permalink"><?php _e( 'Permalink', 'page-generator' ); ?></label>
	</div>
	<div class="right">
		<?php $this->base->get_class( 'keywords' )->output_dropdown( $this->keywords, 'permalink' ); ?>
	</div>
	<div class="full">
		<input type="text" id="permalink" name="<?php echo $this->base->plugin->name; ?>[permalink]" id="permalink" value="<?php echo $this->settings['permalink']; ?>" class="widefat" />
	
    	<p class="description">
    		<?php _e( 'Letters, numbers, underscores and dashes only.', 'page-generator' ); ?>
    	</p>
	</div>
</div>