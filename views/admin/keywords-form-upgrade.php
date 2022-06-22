<div class="wpzinc-option highlight">
    <div class="right">
        <h4><?php esc_html_e( 'Advanced Keyword Functionality', 'page-generator' ); ?></h4>

        <p>
        	<?php 
        	esc_html_e( 'Define an Airtable, CSV File/URL, Database, RSS Feed or Spreadsheet as a Keyword Source; automatically generate location keywords, extract term colums/subsets.', 'page-generator' );
        	?>
        </p>

        <a href="<?php echo $this->base->dashboard->get_upgrade_url( 'settings_inline_upgrade' ); ?>" class="button" target="_blank"><?php esc_html_e( 'Upgrade', $this->base->plugin->name ); ?></a>
    </div>
</div>