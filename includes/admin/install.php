<?php
/**
 * Install class
 * 
 * @package  Page_Generator_Pro
 * @author   Tim Carr
 * @version  1.1.8
 */
class Page_Generator_Pro_Install {

    /**
     * Holds the base object.
     *
     * @since   1.3.8
     *
     * @var     object
     */
    public $base;

    /**
     * Constructor.
     *
     * @since   1.9.8
     *
     * @param   object $base    Base Plugin Class
     */
    public function __construct( $base ) {

        // Store base class
        $this->base = $base;

    }

    /**
     * Runs installation routines for first time users
     *
     * @since   1.9.8
     */
    public function install() {

        // Run activation routines on classes
        $this->base->get_class( 'groups' )->activate();
        $this->base->get_class( 'keywords' )->activate();

    }

    /**
     * Runs migrations for Pro to Pro version upgrades
     *
     * @since   1.1.7
     */
    public function upgrade() {

        global $wpdb;

        // Copy the CSS into the WordPress Theme Customizer Additional CSS
        // This will run on every version upgrade
        //$this->copy_frontend_css(); 

        // Get current installed version number
        $installed_version = get_option( $this->base->plugin->name . '-version' ); // false | 1.1.7

        // If the version number matches the plugin version, bail
        if ( $installed_version == $this->base->plugin->version ) {
            return;
        }

        /**
         * 1.5.7: Upgrade Keywords Table
         */
        if ( ! $installed_version || $installed_version < '1.5.7' ) {
            $this->base->get_class( 'keywords' )->upgrade();
        }

        /**
         * 1.7.8: Install 
         */
        if ( ! $installed_version || $installed_version < '1.4.8' ) {
            // Get instance
            $keywords = $this->base->get_class( 'keywords' );

            // Upgrade table
            $keywords->upgrade();
        }

        /**
         * Free to Free 1.3.8+
         * Free to Pro 1.3.8+
         * - If page-generator-pro exists as an option, and there are no groups, migrate settings of the single group
         * to a single group CPT
         */
        if ( ! $installed_version || $installed_version < '1.3.8' ) {
            $number_of_groups = $this->base->get_class( 'groups' )->get_count();
            $free_settings = get_option( 'page-generator' );

            if ( $number_of_groups == 0 && ! empty( $free_settings ) ) {
                // Migrate settings
                $group = array(
                    'name'      => $free_settings['title'],
                    'settings'  => $free_settings,
                );

                // Generate Group Post
                $group_id = wp_insert_post( array(
                    'post_type'     => $this->base->get_class( 'post_type' )->post_type_name,
                    'post_status'   => 'publish',
                    'post_title'    => $group['name'],
                    'post_content'  => $free_settings['content'],
                ) );

                // Bail if an error occured
                if ( is_wp_error( $group_id ) ) {
                    return;
                }

                // Save group settings
                $result = $this->base->get_class( 'groups' )->save( $group, $group_id );
                
                // If this failed, don't clear the existing settings
                if ( is_wp_error( $result ) ) {
                    return;
                }

                // Clear existing settings
                delete_option( 'page-generator' );
            }
        }

        /**
         * Pro to Pro 1.2.x+
         * - If a Groups table exists, migrate Groups to CPTs
         */
        if ( ! $installed_version || $installed_version < '1.2.3' ) {
            // If the table exists, migrate the data from it
            $table_exists = $wpdb->get_var( "SHOW TABLES LIKE '" . $wpdb->prefix . "page_generator_groups'" );
            if ( $table_exists == $wpdb->prefix . 'page_generator_groups' ) {
                // Fetch all groups
                $groups = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "page_generator_groups" );

                // Use a flag to tell us whether any errors occured during the groups to CPT migratio process
                $errors = false;

                // Iterate through each group, migrating to a CPT
                if ( is_array( $groups ) && count( $groups ) > 0 ) {
                    foreach ( $groups as $group ) {
                        // Unserialize the settings
                        $settings = unserialize( $group->settings );
                        
                        // Create new Post
                        $post_id = wp_insert_post( array(
                            'post_type'     => $this->base->get_class( 'post_type' )->post_type_name,
                            'post_status'   => 'publish',
                            'post_title'    => $settings['title'],
                            'post_content'  => $settings['content'],
                        ) );

                        // If an error occured, skip
                        if ( is_wp_error( $post_id ) ) {
                            $errors = true;
                            continue;
                        }

                        // Remove the settings that we no longer need to store in the Post Meta
                        unset( $settings['title'], $settings['content'] );

                        // Store the settings in the Post's meta
                        $this->base->get_class( 'groups' )->save( $settings, $post_id );
                    }
                }

                // If no errors occured, we can safely remove the groups table
                if ( ! $errors ) {
                    $wpdb->query( "DROP TABLE " . $wpdb->prefix . "page_generator_groups" );
                }
            }
        }

        // Update the version number
        update_option( $this->base->plugin->name . '-version', $this->base->plugin->version );  

    }

    /**
     * Runs uninstallation routines
     *
     * @since   1.9.8
     */
    public function uninstall() {

    }

}