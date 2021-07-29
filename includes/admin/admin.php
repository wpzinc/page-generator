<?php
/**
 * Administration class
 * 
 * @package Page Generator Pro
 * @author  Tim Carr
 * @version 1.0.0
 */
class Page_Generator_Pro_Admin {

    /**
     * Holds the base object.
     *
     * @since   1.2.1
     *
     * @var     object
     */
    public $base;

    /**
     * Constructor
     * 
     * @since   1.0.0
     */
    public function __construct( $base ) {

        // Store base class
        $this->base = $base;

        // Admin Notices
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );

        // Admin CSS, JS and Menu
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_css' ) );

        add_action( 'admin_menu', array( $this, 'admin_menu' ), 8 );
        add_action( 'parent_file', array( $this, 'admin_menu_hierarchy_correction' ), 999 );

        // Keywords: Bulk and Row Actions
        add_filter( 'set-screen-option', array( $this, 'set_screen_options' ), 10, 3 );
        add_action( 'init', array( $this, 'run_keyword_save_actions' ) );
        add_action( 'current_screen', array( $this, 'run_keyword_table_bulk_actions' ) );
        add_action( 'current_screen', array( $this, 'run_keyword_table_row_actions' ) );

        // Localization
        add_action( 'plugins_loaded', array( $this, 'load_language_files' ) );

    }

    /**
     * Checks the transient to see if any admin notices need to be output now.
     *
     * @since   1.2.3
     */
    public function admin_notices() {

        // Determine the screen that we're on
        $screen = $this->base->get_class( 'screen' )->get_current_screen();

        // If we're not on a plugin screen, exit
        if ( ! $screen['screen'] ) {
            return;
        }

        // Output notices
        $this->base->get_class( 'notices' )->set_key_prefix( 'page_generator_pro_' . wp_get_current_user()->ID );
        $this->base->get_class( 'notices' )->output_notices();

    }

    /**
     * Enqueues CSS and JS
     *
     * @since   1.0.0
     */
    public function admin_scripts_css() {

        global $post;

        // CSS - always load, admin / frontend editor wide
        if ( $this->base->is_admin_or_frontend_editor() ) {
            wp_enqueue_style( $this->base->plugin->name . '-admin', $this->base->plugin->url . 'assets/css/admin.css', array(), $this->base->plugin->version );
        }

        // Determine the screen that we're on
        $screen = $this->base->get_class( 'screen' )->get_current_screen();

        // If we're not on a plugin screen, exit
        if ( ! $screen['screen'] ) {
            return;
        }

        // (Re)register dashboard scripts and enqueue CSS for frontend editors, which won't have registered these yet
        $this->base->dashboard->admin_scripts_css();

        // CSS - always load
        // Some WordPress styles are enqueued (again) for Frontend Editors that otherwise wouldn't call them
        wp_enqueue_style( 'buttons-css' );
        wp_enqueue_style( 'forms' );

        // @TODO Do we need this?!
        add_editor_style( $this->base->plugin->url . 'assets/css/admin.css' );

        // Determine whether to load minified versions of JS
        $ext = ( $this->base->dashboard->should_load_minified_js() ? 'min' : '' );

        // JS - register scripts we might use
        wp_register_script( $this->base->plugin->name . '-generate-browser', $this->base->plugin->url . 'assets/js/' . ( $ext ? 'min/' : '' ) . 'generate-browser' . ( $ext ? '-min' : '' ) . '.js', array( 'jquery' ), $this->base->plugin->version, true );
        wp_register_script( $this->base->plugin->name . '-generate-content', $this->base->plugin->url . 'assets/js/' . ( $ext ? 'min/' : '' ) . 'generate-content' . ( $ext ? '-min' : '' ) . '.js', array( 'jquery' ), $this->base->plugin->version, true );
        wp_register_script( $this->base->plugin->name . '-selectize', $this->base->plugin->url . 'assets/js/' . ( $ext ? 'min/' : '' ) . 'selectize' . ( $ext ? '-min' : '' ) . '.js', array( 'jquery' ), $this->base->plugin->version, true );
        
        // If here, we're on a plugin screen
        // Conditionally load scripts and styles depending on which section of the Plugin we're loading        
        switch ( $screen['screen'] ) {
            /**
             * Content: Groups
             */
            case 'content_groups':
                // JS: WP Zinc
                wp_enqueue_script( 'wpzinc-admin-modal' );
                
                // JS: Plugin
                wp_enqueue_script( $this->base->plugin->name . '-generate-content' );

                // Get localization strings
                $localization = $this->base->get_class( 'groups_ui' )->get_titles_and_messages();

                // Add data to localization depending on the screen we're viewing
                switch ( $screen['section'] ) {
                    /**
                     * Content: Groups: Edit
                     */
                    case 'edit':
                        // Prevents errors with meta boxes and Yoast in the WordPress Admin
                        if ( is_admin() ) {
                            wp_enqueue_media();
                        }

                        // CSS: WP Zinc
                        wp_enqueue_style( 'wpzinc-admin-selectize' );

                        // JS: WordPress
                        wp_enqueue_script( 'jquery-ui-sortable' );

                        // JS: WP Zinc
                        wp_enqueue_script( 'wpzinc-admin-conditional' );
                        wp_enqueue_script( 'wpzinc-admin-inline-search' );
                        wp_enqueue_script( 'wpzinc-admin-selectize' );
                        wp_enqueue_script( 'wpzinc-admin-tags' );
                        wp_enqueue_script( 'wpzinc-admin' );

                        // JS: Plugin
                        wp_enqueue_script( $this->base->plugin->name . '-conditional-fields' );
                        wp_enqueue_script( $this->base->plugin->name . '-selectize' );

                        // Enqueue and localize Autocomplete, if a configuration exists
                        $autocomplete = $this->base->get_class( 'common' )->get_autocomplete_configuration( true );
                        if ( $autocomplete ) {
                            wp_enqueue_script( 'wpzinc-admin-autocomplete' );
                            wp_enqueue_script( 'wpzinc-admin-autocomplete-gutenberg' );

                            wp_localize_script( 'wpzinc-admin-autocomplete', 'wpzinc_autocomplete', $autocomplete );
                            wp_localize_script( 'wpzinc-admin-autocomplete-gutenberg', 'wpzinc_autocomplete_gutenberg', $autocomplete );
                        }

                        // Localize Selectize
                        wp_localize_script( $this->base->plugin->name . '-selectize', 'page_generator_pro_selectize', array(
                            'fields'   => $this->base->get_class( 'common' )->get_selectize_enabled_fields(),
                        ) );

                        // Get localization strings
                        $localization['post_id'] = ( isset( $post->ID ) ? $post->ID : false );
                        break;
                }

                // Apply Localization
                wp_localize_script( $this->base->plugin->name . '-generate-content', 'page_generator_pro_generate_content', $localization );
                break;

            /**
             * Generate
             */
            case 'generate':
                wp_enqueue_script( 'jquery-ui-progressbar' );
                wp_enqueue_script( 'wpzinc-admin-synchronous-ajax' );
                wp_enqueue_script( $this->base->plugin->name . '-generate-browser' );
                break;
        }

        // Add footer action to output overlay modal markup
        add_action( 'admin_footer', array( $this, 'output_modal' ) );

        /**
         * Enqueues CSS and JS
         *
         * @since   2.6.2
         *
         * @param   array       $screen     Screen (screen, section)
         * @param   WP_Post     $post       WordPress Post
         */
        do_action( 'page_generator_admin_admin_scripts_css', $screen, $post );

        // CSS
        if ( class_exists( 'Page_Generator' ) ) {
            // Hide 'Add New' if a Group exists
            $number_of_groups = $this->base->get_class( 'groups' )->get_count();
            if ( $number_of_groups > 0 ) {
                ?>
                <style type="text/css">body.post-type-page-generator-pro a.page-title-action { display: none; }</style>
                <?php
            }
        }
        
    }

    /**
     * Add the Plugin to the WordPress Administration Menu
     *
     * @since   1.0.0
     */
    public function admin_menu() {

        global $submenu;

        // Define the minimum capability required to access the Menu and Sub Menus
        $minimum_capability = 'manage_options';

        /**
         * Defines the minimum capability required to access the Media Library Organizer
         * Menu and Sub Menus
         *
         * @since   2.8.9
         *
         * @param   string  $capability     Minimum Required Capability
         * @return  string                  Minimum Required Capability
         */
        $minimum_capability = apply_filters( 'page_generator_pro_admin_admin_menu_minimum_capability', $minimum_capability );

        // Main Menu
        add_menu_page( $this->base->plugin->displayName, $this->base->plugin->displayName, $minimum_capability, $this->base->plugin->name . '-keywords', array( $this, 'keywords_screen' ), 'dashicons-format-aside' );

        // Sub Menu
        $keywords_page = add_submenu_page( $this->base->plugin->name . '-keywords', __( 'Keywords', 'page-generator' ), __( 'Keywords', 'page-generator' ), $minimum_capability, $this->base->plugin->name . '-keywords', array( $this, 'keywords_screen' ) );    
        add_action( "load-$keywords_page", array( $this, 'add_keyword_screen_options' ) );
        
        $groups_page = add_submenu_page( $this->base->plugin->name . '-keywords', __( 'Generate Content', 'page-generator' ), __( 'Generate Content', 'page-generator' ), $minimum_capability, 'edit.php?post_type=' . $this->base->get_class( 'post_type' )->post_type_name );    
        $generate_page = add_submenu_page( $this->base->plugin->name . '-keywords', __( 'Generate', 'page-generator' ), __( 'Generate', 'page-generator' ), $minimum_capability, $this->base->plugin->name . '-generate', array( $this, 'generate_screen' ) );    
        
        // Menus
        $upgrade_page = add_submenu_page( $this->base->plugin->name . '-keywords', __( 'Upgrade', 'page-generator' ), __( 'Upgrade', 'page-generator' ), $minimum_capability, $this->base->plugin->name . '-upgrade', array( $this, 'upgrade_screen' ) );

    }

    /**
     * Ensures this Plugin's top level Admin menu remains open when the user clicks on:
     * - Generate Content
     * - Generate Terms
     *
     * This prevents the 'wrong' admin menu being open (e.g. Posts)
     *
     * @since   1.2.3
     *
     * @param   string  $parent_file    Parent Admin Menu File Name
     * @return  string                  Parent Admin Menu File Name
     */
    public function admin_menu_hierarchy_correction( $parent_file ) {

        global $current_screen;

        // If we're creating or editing a Content Group, set the $parent_file to this Plugin's registered menu name
        if ( $current_screen->base == 'post' && $current_screen->post_type == $this->base->get_class( 'post_type' )->post_type_name ) {
            // The free version uses a different top level filename
            if ( class_exists( 'Page_Generator' ) ) {
                return $this->base->plugin->name . '-keywords';
            }

            return $this->base->plugin->name;
        }

        return $parent_file;

    }

    /**
     * Defines options to display in the Screen Options dropdown on the Keywords
     * WP_List_Table
     *
     * @since   2.6.5
     */
    public function add_keyword_screen_options() {

        add_screen_option( 'per_page', array(
            'label' => __( 'Keywords', 'page-generator' ),
            'default' => 20,
            'option' => 'page_generator_pro_keywords_per_page',
        ) );

    }

    /**
     * Sets values for options displayed in the Screen Options dropdown on the Keywords
     * WP_List_Table
     *
     * @since   2.6.5
     */
    public function set_screen_options( $keep, $option, $value ) {
  
        return $value;

    }

    /**
     * Run any bulk actions on the Log WP_List_Table
     *
     * @since   2.6.5
     */
    public function run_keyword_save_actions() {

        // Setup notices class
        $this->base->get_class( 'notices' )->set_key_prefix( 'page_generator_pro_' . wp_get_current_user()->ID );
        
        // Get command
        $cmd = ( ( isset( $_GET['cmd'] ) ) ? sanitize_text_field( $_GET['cmd'] ) : '' );
        switch ( $cmd ) {
            /**
             * Add / Edit Keyword
             */
            case 'form':
                // Get keyword from POST data or DB
                if ( isset( $_POST['keyword'] ) ) {
                    // Get keyword from POST data
                    $keyword = $_POST;
                } else if ( isset( $_GET['id'] ) ) {
                    // Editing an existing Keyword
                    $keyword = $this->base->get_class( 'keywords' )->get_by_id( absint( $_GET['id'] ) );
                }

                // Save keyword
                $keyword_id = $this->save_keyword();
                
                if ( is_wp_error( $keyword_id ) ) {
                    $this->base->get_class( 'notices' )->add_error_notice( $keyword_id->get_error_message() );
                } else if ( is_numeric( $keyword_id ) ) {
                    // Redirect
                    $this->base->get_class( 'notices' )->enable_store();
                    $this->base->get_class( 'notices' )->add_success_notice( __( 'Keyword saved successfully', 'page-generator' ) );
                    wp_redirect( 'admin.php?page=page-generator-keywords&cmd=form&id=' . $keyword_id );
                    die();
                }
                break;

        }

    }

    /**
     * Run any bulk actions on the Log WP_List_Table
     *
     * @since   2.6.5
     */
    public function run_keyword_table_bulk_actions() {

        // Get screen
        $screen = $this->base->get_class( 'screen' )->get_current_screen();

        // Bail if we're not on the Keywords Screen
        if ( $screen['screen'] != 'keywords' ) {
            return;
        }
        if ( $screen['section'] != 'wp_list_table' ) {
            return;
        }

        // Get bulk action from the fields that might contain it
        $bulk_action = array_values( array_filter( array(
            ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] != -1 ? sanitize_text_field( $_REQUEST['action'] ) : '' ),
            ( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] != -1 ? sanitize_text_field( $_REQUEST['action2'] ) : '' ),
            ( isset( $_REQUEST['action3'] ) && ! empty( $_REQUEST['action3'] ) ? sanitize_text_field( $_REQUEST['action3'] ) : '' ),
        ) ) );

        // Bail if no bulk action
        if ( ! is_array( $bulk_action ) ) {
            return;
        }
        if ( ! count( $bulk_action ) ) {
            return;
        }

        // Perform Bulk Action
        switch ( $bulk_action[0] ) {

            /**
             * Delete Keywords
             */
            case 'delete':
                // Setup notices class, enabling persistent storage
                $this->base->get_class( 'notices' )->enable_store();
                $this->base->get_class( 'notices' )->set_key_prefix( 'page_generator_pro_' . wp_get_current_user()->ID );

                // Get Keyword IDs
                if ( ! isset( $_REQUEST['ids'] ) ) {
                    $this->base->get_class( 'notices' )->add_error_notice(
                        __( 'No Keywords were selected for deletion.', 'page-generator' )
                    );
                    break;
                }

                // Delete Keywords
                $result = $this->base->get_class( 'keywords' )->delete( $_REQUEST['ids'] );

                // Output success or error messages
                if ( is_wp_error( $result ) ) {
                    // Add error message and redirect back to the keyword table
                    $this->base->get_class( 'notices' )->add_error_notice( $result );
                } else {
                    $this->base->get_class( 'notices' )->add_success_notice(
                        sprintf(
                            /* translators: Number of Keywords deleted */
                            __( '%s Keywords deleted.', 'page-generator' ),
                            count( $_REQUEST['ids'] )
                        )
                    );
                }

                // Redirect
                $this->redirect_after_keyword_action();
                break;

        }

    }

    /**
     * Run any row actions on the Keywords WP_List_Table now
     *
     * @since   1.2.3
     */
    public function run_keyword_table_row_actions() {

        // Bail if no page specified
        $page = ( ( isset( $_GET['page'] ) ) ? sanitize_text_field( $_GET['page'] ) : false );
        if ( ! $page ) {
            return;
        }
        if ( $page != $this->base->plugin->name . '-keywords' ) {
            return;
        }
        
        // Bail if no row action specified
        $cmd = ( ( isset( $_GET['cmd'] ) ) ? sanitize_text_field( $_GET['cmd'] ) : false );
        if ( ! $cmd ) {
            return;
        }

        switch ( $cmd ) {

            /**
             * Duplicate Keyword
             */
            case 'duplicate':
                // Setup notices class, enabling persistent storage
                $this->base->get_class( 'notices' )->enable_store();
                $this->base->get_class( 'notices' )->set_key_prefix( 'page_generator_pro_' . wp_get_current_user()->ID );
                
                // Bail if no ID set
                if ( ! isset( $_GET['id'] ) ) {
                    $this->base->get_class( 'notices' )->add_error_notice( __( 'No Keyword was selected for duplication.', 'page-generator' ) );
                    break;
                }

                // Duplicate keyword
                $result = $this->base->get_class( 'keywords' )->duplicate( absint( $_GET['id'] ) );

                // Output success or error messages
                if ( is_wp_error( $result ) ) {
                    // Error
                    $this->base->get_class( 'notices' )->add_error_notice( $result->get_error_message() );
                } elseif ( is_numeric( $result ) ) {
                    // Success
                    $this->base->get_class( 'notices' )->add_success_notice(
                        sprintf( 
                            /* translators: Link to view duplicated Keyword */ 
                            __( 'Keyword duplicated successfully. %s', 'page-generator' ), 
                            '<a href="' . admin_url( 'admin.php?page=' . $this->base->plugin->name . '-keywords&cmd=form&id=' . $result ) . '">' . 
                            __( 'View Keyword', 'page-generator' ) . '</a>'
                        )
                    );
                }

                // Redirect
                $this->redirect_after_keyword_action();
                break;

            /**
             * Delete Keyword
             */
            case 'delete':
                // Setup notices class, enabling persistent storage
                $this->base->get_class( 'notices' )->enable_store();
                $this->base->get_class( 'notices' )->set_key_prefix( 'page_generator_pro_' . wp_get_current_user()->ID );
                
                // Bail if no ID set
                if ( ! isset( $_GET['id'] ) ) {
                    $this->base->get_class( 'notices' )->add_error_notice( __( 'No Group was selected for duplication.', 'page-generator' ) );
                    break;
                }

                // Delete keyword
                $result = $this->base->get_class( 'keywords' )->delete( absint( $_GET['id'] ) );

                // Output success or error messages
                if ( is_string( $result ) ) {
                    // Add error message and redirect back to the keyword table
                    $this->base->get_class( 'notices' )->add_error_notice( $result );
                } elseif ( $result === true ) {
                    // Success
                    $this->base->get_class( 'notices' )->add_success_notice( __( 'Keyword deleted successfully.', 'page-generator' ) );
                }

                // Redirect
                $this->redirect_after_keyword_action();
                break;

        }

    }

    /**
     * Reloads the Keywords WP_List_Table, with search, order and pagination arguments if supplied
     *
     * @since   2.6.5
     */
    private function redirect_after_keyword_action() {

        $url = add_query_arg( array(
            'page'      => $this->base->plugin->name . '-keywords',
            's'         => ( isset( $_REQUEST['s'] ) ? sanitize_text_field( $_REQUEST['s'] ) : '' ),
            'paged'     => ( isset( $_REQUEST['paged'] ) ? sanitize_text_field( $_REQUEST['paged'] ) : 1 ),
            'orderby'   => ( isset( $_REQUEST['orderby'] ) ? sanitize_text_field( $_REQUEST['orderby'] ) : 'keyword' ),
            'order'     => ( isset( $_REQUEST['order'] ) ? sanitize_text_field( $_REQUEST['order'] ) : 'ASC' ),
        ), 'admin.php' );

        wp_redirect( $url );
        die();

    }

    /**
     * Outputs the Keywords Screens
     *
     * @since   1.0.0
     */
    public function keywords_screen() {

        // Get command
        $cmd = ( ( isset($_GET['cmd'] ) ) ? sanitize_text_field( $_GET['cmd'] ) : '' );
        switch ( $cmd ) {
            /**
             * Add / Edit Keyword
             */
            case 'form':
                // Edit
                if ( isset( $_GET['id'] ) ) {
                    // Get Keyword
                    $keyword = $this->base->get_class( 'keywords' )->get_by_id( absint( $_GET['id'] ) );

                    // Get Keyword Sources
                    $sources = $this->base->get_class( 'keywords' )->get_sources();

                    // View
                    $view = 'views/admin/keywords-form-edit.php';
                } else {
                    // Add Keyword
                    // Get Keyword Sources
                    $sources = $this->base->get_class( 'keywords' )->get_sources();

                    // View
                    $view = 'views/admin/keywords-form.php';
                } 
                break;

            /**
             * Duplicate Keyword
             * Delete Keyword
             * Index
             */
            case 'duplicate':
            case 'delete':
            default:
                // Setup Table
                $keywords_table = new Page_Generator_Pro_Keywords_Table( $this->base );
                $keywords_table->prepare_items();

                // View
                $view = 'views/admin/keywords-table.php';
                break;

        }

        // Load View
        include_once( $this->base->plugin->folder . $view ); 

    }

    /**
     * Save Keyword
     *
     * @since   1.0.0
     *
     * @return  mixed   WP_Error | int
     */
    public function save_keyword() {

        // Check if a POST request was made
        if ( ! isset( $_POST['submit'] ) ) {
            return false;
        }

        // Run security checks
        // Missing nonce 
        if ( ! isset( $_POST[ $this->base->plugin->name . '_nonce' ] ) ) { 
            return new WP_Error( 'page_generator_pro_admin_save_keyword', __( 'Nonce field is missing. Settings NOT saved.', 'page-generator' ) );
        }

        // Invalid nonce
        if ( ! wp_verify_nonce( $_POST[ $this->base->plugin->name . '_nonce' ], 'save_keyword' ) ) {
            return new WP_Error( 'page_generator_pro_admin_save_keyword', __( 'Invalid nonce specified. Settings NOT saved.', 'page-generator' ) );
        }

        // Validate Form Inputs
        $id = ( ( isset( $_REQUEST['keywordID'] ) && ! empty( $_REQUEST['keywordID'] ) ) ? absint( $_REQUEST['keywordID'] ) : '' );
        $keyword_name = sanitize_text_field( $_POST['keyword'] );
        $source = sanitize_text_field( $_POST['source'] );

        // Build Keyword
        $keyword = array(
            'keyword'   => $keyword_name,
            'source'    => $source,
            'options'   => $_POST[ $source ],

            // Determined by the Source
            'data'      => '',
            'delimiter' => '',
            'columns'   => '',
        );

        /**
         * Define the Keyword properties (data, delimiter and columns) for the given Source
         * before saving the Keyword to the database
         *
         * @since   3.0.8
         *
         * @param   array   $keyword    Keyword arguments
         */
        $keyword = apply_filters( 'page_generator_pro_keywords_save_' . $source, $keyword );

        // If the Keyword is a WP_Error, bail
        if ( is_wp_error( $keyword ) ) {
            return $keyword;
        }

        // Save Keyword (returns WP_Error or Keyword ID)
        return $this->base->get_class( 'keywords' )->save( $keyword, $id );

    }

    /**
     * Generates content for the given Group and Group Type
     *
     * @since   1.2.3
     */
    public function generate_screen() {

        // Setup notices class, enabling persistent storage
        $this->base->get_class( 'notices' )->set_key_prefix( 'page_generator_pro_' . wp_get_current_user()->ID );

        // Bail if no Group ID was specified
        if ( ! isset( $_REQUEST['id'] ) ) {
            $this->base->get_class( 'notices' )->add_error_notice( __( 'No Group ID was specified.', 'page-generator' ) );
            include_once( $this->base->plugin->folder . 'views/admin/notices.php' );
            return;
        }

        // Get Group ID and Type
        $id     = absint( $_REQUEST['id'] );
        $type   = ( isset( $_REQUEST['type'] ) ? sanitize_text_field( $_REQUEST['type'] ) : 'content' );

        // Get groups class
        $group = $this->base->get_class( 'groups' );

        // Fetch group settings
        $settings = $group->get_settings( $id, false );

        // Validate group
        $validated = $group->validate( $id );
        if ( is_wp_error( $validated ) ) {
            $this->base->get_class( 'notices' )->add_error_notice( $validated->get_error_message() );
            include_once( $this->base->plugin->folder . 'views/admin/generate-run-notice.php' );
            return;
        }

        /**
         * Runs any actions before Generate Content has started.
         *
         * @since   3.0.7
         *
         * @param   int     $group_id   Group ID
         * @param   bool    $test_mode  Test Mode
         * @param   string  $system     System
         */
        do_action( 'page_generator_pro_generate_content_before', $id, false, 'browser' );
    

        // Define return to Group URL
        $return_url = admin_url( 'post.php?post=' . $id . '&amp;action=edit' );
        
        // Calculate how many pages could be generated
        $number_of_pages_to_generate = $this->base->get_class( 'generate' )->get_max_number_of_pages( $settings );
        if ( is_wp_error( $number_of_pages_to_generate ) ) {
            $this->base->get_class( 'notices' )->add_error_notice( $number_of_pages_to_generate->get_error_message() );
            include_once( $this->base->plugin->folder . 'views/admin/generate-run-notice.php' );
            return;
        }
          
        // Check that the number of posts doesn't exceed the maximum that can be generated
        if ( $settings['numberOfPosts'] > $number_of_pages_to_generate ) {
            $settings['numberOfPosts'] = $number_of_pages_to_generate;
        }  

        // If no limit specified, set one now
        if ( $settings['numberOfPosts'] == 0 ) {
            if ( $settings['method'] == 'random' ) {
                $settings['numberOfPosts'] = 10;
            } else {
                $settings['numberOfPosts'] = $number_of_pages_to_generate;
            }
        }

        // Set last generated post date and time based on the Group's settings (i.e. date/time of now,
        // specific date/time or a random date/time)
        $last_generated_post_date_time = $this->base->get_class( 'generate' )->post_date( $settings );

        // Add Plugin Settings
        $settings['stop_on_error'] = (int) $this->base->get_class( 'settings' )->get_setting( $this->base->plugin->name . '-generate', 'stop_on_error', 0 );
        $settings['stop_on_error_pause'] = (int) $this->base->get_class( 'settings' )->get_setting( $this->base->plugin->name . '-generate', 'stop_on_error_pause', 5 );

        // Localize Generate Browser script with the necessary parameters for synchronous AJAX requests
        wp_localize_script( $this->base->plugin->name . '-generate-browser', 'page_generator_pro_generate_browser', array(
            'action'                        => 'page_generator_pro_generate_' . $type,
            'action_on_finished'            => 'page_generator_pro_generate_' . $type . '_after',
            'id'                            => $id,
            'last_generated_post_date_time' => $last_generated_post_date_time,
            'max_number_of_pages'           => $number_of_pages_to_generate,
            'number_of_requests'            => $settings['numberOfPosts'],
            'resume_index'                  => $settings['resumeIndex'],
            'stop_on_error'                 => (int) $this->base->get_class( 'settings' )->get_setting( $this->base->plugin->name . '-generate', 'stop_on_error', 0 ),
            'stop_on_error_pause'           => (int) ( $this->base->get_class( 'settings' )->get_setting( $this->base->plugin->name . '-generate', 'stop_on_error_pause', 5 ) * 1000 ),
        ) );

        // Set a flag to denote that this Group is generating content
        $group->start_generation( $id, 'generating', 'browser' );

        // Load View
        include_once( $this->base->plugin->folder . 'views/admin/generate-run.php' );

    }

    /**
     * Outputs the hidden Javascript Modal and Overlay in the Footer
     *
     * @since   2.4.6
     */
    public function output_modal() {

        // Load view
        require_once( $this->base->plugin->folder . '_modules/dashboard/views/modal.php' );

    }

    /**
     * Loads plugin textdomain
     *
     * @since   1.0.0
     */
    public function load_language_files() {

        load_plugin_textdomain( $this->base->plugin->name, false, $this->base->plugin->name . '/languages/' );

    } 

}