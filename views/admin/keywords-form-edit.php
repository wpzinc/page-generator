<?php
/**
 * Outputs the form at Keywords > Edit
 *
 * @package Page_Generator_Pro
 * @author WP Zinc
 */

?>
<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php echo esc_html( $this->base->plugin->displayName ); ?>

		<span>
			<?php esc_html_e( 'Edit Keyword', 'page-generator' ); ?>
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
					<form class="<?php echo esc_attr( $this->base->plugin->name ); ?>" name="post" method="post" action="admin.php?page=page-generator-keywords&amp;cmd=form&id=<?php echo absint( $_GET['id'] ); // phpcs:ignore ?>" enctype="multipart/form-data">		
						<div id="normal-sortables" class="meta-box-sortables ui-sortable">                        
							<div id="keyword-panel" class="postbox">
								<!-- Keyword ID we're editing -->
								<input type="hidden" name="keywordID" value="<?php echo esc_attr( $keyword['keywordID'] ); ?>" />

								<h3 class="hndle"><?php esc_html_e( 'Keyword', 'page-generator' ); ?></h3>

								<div class="wpzinc-option">
									<div class="left">
										<label for="keyword"><?php esc_html_e( 'Keyword', 'page-generator' ); ?></label>
									</div>
									<div class="right">
										<input type="text" name="keyword" id="keyword" value="<?php echo esc_attr( stripslashes( isset( $_POST['keyword'] ) ? $_POST['keyword'] : $keyword['keyword'] ) ); // phpcs:ignore ?>" class="widefat" />

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
											<?php echo esc_html( $sources[ $keyword['source'] ]['label'] ); ?>
											<input type="hidden" name="source" value="<?php echo esc_attr( $keyword['source'] ); ?>" />
											<p class="description">
												<?php esc_html_e( 'Once a Keyword is created, the source cannot be changed. To change the source, delete this Keyword and create a new Keyword with the same name.', 'page-generator' ); ?>
											</p>
										</div>
									</div>
								</div>

								<?php
								// Define source name variable for keywords-form-field.php.
								$source_name = $keyword['source'];

								foreach ( $sources[ $keyword['source'] ]['options'] as $option_name => $option ) {
									// Data, Delimiter and Column are stored outside of options, but are submitted as options.
									$value = '';
									if ( isset( $_POST[ $keyword['source'] ][ $option_name ] ) ) { // phpcs:ignore
										// Sanitize value depending on whether it's for a textarea or not.
										if ( $option['type'] === 'textarea' ) {
											// Prevents stripping of newlines.
											$value = sanitize_textarea_field( $_POST[ $keyword['source'] ][ $option_name ] ); // phpcs:ignore
										} else {
											$value = sanitize_text_field( $_POST[ $keyword['source'] ][ $option_name ] ); // phpcs:ignore
										}
									} elseif ( isset( $_POST[ $option_name ] ) ) { // phpcs:ignore
										// Sanitize value depending on whether it's for a textarea or not.
										if ( $option['type'] === 'textarea' ) {
											// Prevents stripping of newlines.
											$value = sanitize_textarea_field( $_POST[ $option_name ] ); // phpcs:ignore
										} else {
											$value = sanitize_text_field( $_POST[ $option_name ] ); // phpcs:ignore
										}
									} elseif ( isset( $keyword['options'][ $option_name ] ) ) {
										$value = $keyword['options'][ $option_name ];
									} elseif ( isset( $keyword[ $option_name ] ) ) {
										$value = $keyword[ $option_name ];
									}

									// Output form field.
									include 'keywords-form-field.php';
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
