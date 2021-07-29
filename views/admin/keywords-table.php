<div class="wrap">
    <h1 class="wp-heading-inline">
        <?php echo $this->base->plugin->displayName; ?>

        <span>
            <?php _e( 'Keywords', 'page-generator' ); ?>
        </span>
    </h1>

    <?php
    // Button Links
    require_once( 'keywords-links.php' );

    // Search Subtitle
    if ( ! empty( $keywords_table->get_search() ) ) {
        ?>
        <span class="subtitle left"><?php _e( 'Search results for', 'page-generator' ); ?> &#8220;<?php echo $keywords_table->get_search(); ?>&#8221;</span>
        <?php
    }
    ?>

    <form action="admin.php" method="get" id="posts-filter">
        <input type="hidden" name="page" value="page-generator-keywords" />
        <?php
        $keywords_table->search_box( __( 'Search' ), 'page-generator' );
        $keywords_table->display(); 
        ?>
    </form>
</div><!-- /.wrap -->