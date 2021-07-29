<?php
/**
 * Common class
 * 
 * @package Page Generator Pro
 * @author  Tim Carr
 * @version 1.0.0
 */
class Page_Generator_Pro_Common {

    /**
     * Holds the base object.
     *
     * @since   1.9.8
     *
     * @var     object
     */
    public $base;

    /**
     * Constructor
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
     * Helper method to retrieve Generation Systems
     *
     * @since   2.6.1
     *
     * @return  array   Generation Systems
     */
    public function get_generation_systems() {

        // Get systems
        $systems = array(
            'browser'   => __( 'Browser', 'page-generator' ),
        );

        /**
         * Defines available Generation Systems
         *
         * @since   2.6.1
         *
         * @param   array   $systems    Generation Systems
         */
        $systems = apply_filters( 'page_generator_pro_common_get_generation_systems', $systems );

        // Return filtered results
        return $systems;

    }

    /**
     * Helper method to retrieve authors
     *
     * @since   1.1.3
     *
     * @return  array   Authors
     */
    public function get_authors() {

        // Get authors
        $authors = get_users( array(
             'orderby' => 'nicename',
        ) );

        /**
         * Defines available authors for the Author dropdown on the Generate Content screen.
         *
         * @since   1.1.3
         *
         * @param   array   $authors    Authors
         */
        $authors = apply_filters( 'page_generator_pro_common_get_authors', $authors );

        // Return filtered results
        return $authors;
        
    }

    /**
     * Helper method to retrieve post statuses
     *
     * @since   1.1.3
     *
     * @return  array   Post Statuses
     */
    public function get_post_statuses() {

        // Get statuses
        $statuses = array(
            'draft'     => __( 'Draft', 'page-generator' ),
            'private'   => __( 'Private', 'page-generator' ),
            'publish'   => __( 'Publish', 'page-generator' ),
        );

        /**
         * Defines available Post Statuses for generated content.
         *
         * @since   1.1.3
         *
         * @param   array   $statuses   Statuses
         */
        $statuses = apply_filters( 'page_generator_pro_common_get_post_statuses', $statuses );

        // Return filtered results
        return $statuses;
        
    }

    /**
     * Returns configuration for autocomplete instances across tribute.js, TinyMCE and Gutenberg
     * for keyword autocomplete functionality.
     *
     * @since   3.2.2
     *
     * @param   bool    $is_group           If true, autocomplete fields are for a Content or Term Group
     *                                      If false, autocomplete fields are for Related Links shortcode on a Page or Post
     * @return  mixed                       false | Javascript DOM Selectors
     */
    public function get_autocomplete_configuration( $is_group ) {

        // Get values, casting to an autocomplete compatible array as necessary
        $values = $this->base->get_class( 'keywords' )->get_keywords_and_columns( true );

        // If no Keywords exist, don't initialize autocompleters
        if ( ! $values ) {
            return false;
        }

        foreach ( $values as $index => $value ) {
            $values[ $index ] = array(
                'key'   => $value,
                'value' => $value,
            );
        }
        
        // Define autocomplete configuration
        $autocomplete_configuration = array(
            array(
                'fields'   => $this->get_autocomplete_enabled_fields( $is_group ),
                'triggers' => array(
                    array(
                        'name'              => 'keywords',
                        'trigger'           => '{',
                        'values'            => $values,
                        'allowSpaces'       => false,
                        'menuItemLimit'     => 20,

                        // TinyMCE specific
                        'triggerKeyCode'    => 219,
                        'tinyMCEName'       => 'page_generator_pro_autocomplete_keywords',
                    ),
                ),
            ),
        );

        /**
         * Define autocompleters to use across Content Groups, Term Group and TinyMCE
         *
         * @since   3.2.2
         *
         * @param   array   $autocomplete_configuration     Autocomplete Configuration
         * @param   bool    $is_group   If true, autocomplete fields are for a Content or Term Group
         *                              If false, autocomplete fields are for Related Links shortcode on a Page or Post
         */
        $autocomplete_configuration = apply_filters( 'page_generator_pro_common_get_autocomplete_configuration', $autocomplete_configuration, $is_group );

        // Return filtered results
        return $autocomplete_configuration;
    
    }

    /**
     * Returns an array of Javascript DOM selectors to enable the keyword
     * autocomplete functionality on.
     *
     * @since   2.0.2
     *
     * @param   bool    $is_group   If true, autocomplete fields are for a Content or Term Group
     *                              If false, autocomplete fields are for Related Links shortcode on a Page or Post
     * @return  array   Javascript DOM Selectors
     */
    public function get_autocomplete_enabled_fields( $is_group = true ) {

        // Get fields
        if ( $is_group ) {
            // Register autocomplete selectors across Group fields
            $fields = array(
                // Classic Editor
                'input',
                'textarea',
                'div[contenteditable=true]',

                // Gutenberg
                // Is now handled using Dashboard Submodule's WPZincAutocompleterControl in autocomplete-gutenberg.js
                
                // TinyMCE Plugins
                '.wpzinc-autocomplete',
            );
        } else {
            // Register autocomplete selectors for Plugin-specific fields only
            // i.e. Related Links Shortcode
            $fields = array(
                // Gutenberg
                // Is now handled using Dashboard Submodule's WPZincAutocompleterControl in autocomplete-gutenberg.js
                
                // TinyMCE Plugins
                '.wpzinc-autocomplete',
            );
        }

        /**
         * Defines an array of Javascript DOM selectors to enable the keyword
         * autocomplete functionality on.
         *
         * @since   2.0.2
         *
         * @param   array   $fields     Supported Fields
         * @param   bool    $is_group   If true, autocomplete fields are for a Content or Term Group
         *                              If false, autocomplete fields are for Related Links shortcode on a Page or Post
         */
        $fields = apply_filters( 'page_generator_pro_common_get_autocomplete_enabled_fields', $fields, $is_group );

        // Return filtered results
        return $fields;

    }

    /**
     * Returns an array of Javascript DOM selectors to enable the
     * selectize functionality on.
     *
     * @since   2.5.4
     *
     * @return  array   Javascript DOM Selectors
     */
    public function get_selectize_enabled_fields() {

        // Get fields
        $fields = array(
            'freeform' => array(
                'input.wpzinc-selectize-freeform',
                '.wpzinc-selectize-freeform input',
            ),

            'drag_drop' => array(
                'select.wpzinc-selectize-drag-drop',
                '.wpzinc-selectize-drag-drop select',
            ),

            'search' => array(
                'select.wpzinc-selectize-search',
                '.wpzinc-selectize-search select',
            ),

            'api' => array(
                'select.wpzinc-selectize-api',
                '.wpzinc-selectize-api select',
            ),

            'standard' => array(
                'select.wpzinc-selectize',
                '.wpzinc-selectize select',
            ),
        );

        /**
         * Defines an array of Javascript DOM selectors to enable the
         * selectize functionality on.
         *
         * @since   2.5.4
         *
         * @param   array   $fields  Supported Fields
         */
        $fields = apply_filters( 'page_generator_pro_common_get_selectize_enabled_fields', $fields );

        // Return filtered results
        return $fields;

    }

    /**
     * Returns an array of events to reinitialize selectize instances
     * on within Appearance > Customize
     *
     * @since   2.7.7
     *
     * @return  array   Events and Selectors
     */
    public function get_selectize_reinit_events() {

        return array(
            'click' => array(
                'li.accordion-section h3.accordion-section-title', // Top level Panels
            ),
            'change'=> array(
                'input[name="_customize-radio-show_on_front"]', // Homepage Settings > Your homepage displays
            ),  
        );

    }

    /**
     * Helper method to return an array of WordPress Role Capabilities that should be disabled
     * when a Content Group is Generating Content
     *
     * @since   1.9.9
     *
     * @return  array   Capabilities
     */
    public function get_capabilities_to_disable_on_group_content_generation() {

        // Get capabilities
        $capabilities = array(
            'delete_post',
            'edit_post',
        );

        /**
         * Defines Role Capabilities that should be disabled when a Content Group is Generating Content.
         *
         * @since   1.9.9
         *
         * @param   array   $capabilities   Capabilities
         */
        $capabilities = apply_filters( 'page_generator_pro_common_get_capabilities_to_disable_on_group_content_generation', $capabilities );

        // Return filtered results
        return $capabilities;

    }

}