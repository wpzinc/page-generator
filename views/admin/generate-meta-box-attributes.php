<!-- Template -->
<?php
$template = ( isset( $this->settings['pageTemplate']['page'] ) ? $this->settings['pageTemplate']['page'] : '' );
?>
<div class="wpzinc-option">
    <div class="full">
        <strong><?php _e( 'Template', 'page-generator' ); ?></strong>
    </div>
    <div class="full">
        <select name="<?php echo $this->base->plugin->name; ?>[pageTemplate][page]" size="1">
            <option value="default"<?php selected( $template, 'default' ); ?>>
                <?php _e( 'Default Template', 'page-generator' ); ?>
            </option>
            <?php page_template_dropdown( $template, 'page' ); ?>
        </select>
    </div>
</div>