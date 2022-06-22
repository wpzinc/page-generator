<?php
/**
 * Outputs the form at Keywords > Add New
 *
 * @package Page_Generator_Pro
 * @author WP Zinc
 */

?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php echo esc_html( $this->base->plugin->displayName ); ?>

		<span>
			<?php esc_html_e( 'Add New Keyword', 'page-generator' ); ?>
		</span>
	</h1>

	<?php
	// Button Links.
	require_once 'keywords-links.php';
	?>

	<div class="wrap-inner">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-1">
				<!-- Content -->
				<div id="post-body-content">
					<!-- Form Start -->
					<form class="<?php echo esc_attr( $this->base->plugin->name ); ?>" name="post" method="post" action="admin.php?page=page-generator-keywords&amp;cmd=form" enctype="multipart/form-data">		
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">                        
							<div id="keyword-panel" class="postbox">
								<h3 class="hndle"><?php esc_html_e( 'Keyword', 'page-generator' ); ?></h3>

								<div class="wpzinc-option">
									<div class="left">
										<label for="keyword"><?php esc_html_e( 'Keyword', 'page-generator' ); ?></label>
									</div>
									<div class="right">
										<input type="text" name="keyword" id="keyword" value="<?php echo esc_attr( isset( $_POST['keyword'] ) ? $_POST['keyword'] : '' ); // phpcs:ignore ?>" class="widefat" />

										<p class="description">
											<?php esc_html_e( 'A unique template tag name, which can then be used when generating content.', 'page-generator' ); ?>
										</p>
									</div>
								</div>

								<div class="wpzinc-option">
									<div class="left">
										<label for="source"><?php esc_html_e( 'Source', 'page-generator' ); ?></label>
									</div>
									<div class="right">
										<div class="right">
											<select name="source" size="1" class="wpzinc-conditional" data-container="#keyword-panel">
												<?php
												foreach ( $sources as $source_name => $source ) {
													?>
													<option value="<?php echo esc_attr( $source_name ); ?>"<?php echo esc_attr( ( isset( $_POST['source'] ) && $_POST['source'] === $source_name ) ? ' selected' : '' ); // phpcs:ignore ?>>
														<?php echo esc_attr( $source['label'] ); ?>
													</option>
													<?php
												}
												?>
											</select>
											<p class="description">
												<?php esc_html_e( 'The source of this Keyword\'s Terms.', 'page-generator' ); ?>
											</p>
										</div>
									</div>
								</div>

								<?php
								foreach ( $sources as $source_name => $source ) {
									?>
									<div>
										<div class="<?php echo esc_attr( $source_name ); ?>">
											<?php
											foreach ( $source['options'] as $option_name => $option ) {
												// Skip Preview, as we're adding a Keyword which has yet to supply its source data.
												if ( $option['type'] === 'preview' ) {
													continue;
												}

												// Data, Delimiter and Column are stored outside of options, but are submitted as options.
												$value = '';
												if ( isset( $_POST[ $source_name ][ $option_name ] ) ) { // phpcs:ignore
													if ( $option['type'] === 'textarea' ) {
														// Prevents stripping of newlines.
														$value = sanitize_textarea_field( $_POST[ $source_name ][ $option_name ] ); // phpcs:ignore
													} else {
														$value = sanitize_text_field( $_POST[ $source_name ][ $option_name ] ); // phpcs:ignore
													}
												} elseif ( isset( $_POST[ $option_name ] ) ) { // phpcs:ignore
													if ( $option['type'] === 'textarea' ) {
														// Prevents stripping of newlines.
														$value = sanitize_textarea_field( $_POST[ $option_name ] ); // phpcs:ignore
													} else {
														$value = sanitize_text_field( $_POST[ $option_name ] ); // phpcs:ignore
													}
												}

												// Output form field.
												include 'keywords-form-field.php';
											}
											?>
										</div>
									</div>
									<?php
								}

								// Upgrade Notice.
								if ( class_exists( 'Page_Generator' ) ) {
									require $this->base->plugin->folder . 'views/admin/keywords-form-upgrade.php';
								}
								?>

								<div class="wpzinc-option">
									<?php wp_nonce_field( 'save_keyword', 'nonce' ); ?>
									<input type="submit" name="submit" value="<?php esc_attr_e( 'Save', 'page-generator' ); ?>" class="button button-primary" />
								</div>
							</div>
						</div>
						<!-- /normal-sortables -->
					</form>
					<!-- /form end -->
				</div>
				<!-- /post-body-content -->
			</div>
		</div>  
	</div>     
</div>
