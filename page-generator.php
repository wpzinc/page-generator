<?php
/**
* Plugin Name: Page Generator
* Plugin URI: http://www.wpzinc.com/plugins/page-generator-pro
* Version: 1.5.9
* Author: WP Zinc
* Author URI: http://www.wpzinc.com
* Description: Generate multiple Pages using dynamic content.
*/

/**
 * Page Generator Class
 * 
 * @package   Page_Generator
 * @author    Tim Carr
 * @version   2.0.0
 * @copyright WP Zinc
 */
class Page_Generator {

    /**
     * Holds the class object.
     *
     * @since   1.1.3
     *
     * @var     object
     */
    public static $instance;

    /**
     * Holds the plugin information object.
     *
     * @since   1.0.0
     *
     * @var     object
     */
    public $plugin = '';

    /**
     * Holds the dashboard class object.
     *
     * @since   1.1.6
     *
     * @var     object
     */
    public $dashboard = '';

    /**
     * Classes
     *
     * @since   1.9.8
     *
     * @var     array
     */
    public $classes = '';

    /**
     * Constructor. Acts as a bootstrap to load the rest of the plugin
     *
     * @since   1.0.0
     */
    public function __construct() {

        // Bail if the Pro version of the Plugin is active
        if ( class_exists( 'Page_Generator_Pro' ) ) {
            return;
        }

        // Plugin Details
        $this->plugin = new stdClass;
        $this->plugin->name         = 'page-generator';
        $this->plugin->displayName  = 'Page Generator';
        $this->plugin->version      = '1.5.9';
        $this->plugin->buildDate    = '2021-09-17 18:00:00';
        $this->plugin->requires     = 3.6;
        $this->plugin->tested       = '5.8.1';
        $this->plugin->folder       = plugin_dir_path( __FILE__ );
        $this->plugin->url          = plugin_dir_url( __FILE__ );
        $this->plugin->documentation_url= 'https://www.wpzinc.com/documentation/page-generator-pro';
        $this->plugin->support_url      = 'https://www.wpzinc.com/support';
        $this->plugin->upgrade_url      = 'https://www.wpzinc.com/plugins/page-generator-pro';
        $this->plugin->review_name      = 'page-generator';
        $this->plugin->review_notice    = sprintf( __( 'Thanks for using %s to generate content!', 'page-generator' ), $this->plugin->displayName );

        // Upgrade Reasons
        $this->plugin->upgrade_reasons = array(
            array(
                __( 'Generate any Post Type', 'page-generator' ),
                __( 'Pro provides options to generate any Post Type, including Pages, Posts and Custom Post Types.', 'page-generator' ),
            ),
            array(
                __( 'Powerful Content Generation', 'page-generator' ),
                __( 'Combine Keyword combinations sequentially, at random or use all possible combinations. Generate content in-browser, using WP-Cron or WP-CLI.', 'page-generator' ),
            ),
            array(
                __( 'Generate Unlimited, Unique Posts, Pages and Custom Post Types', 'page-generator' ),
                __( 'Create as many Content Groups as you wish, each with different settings.', 'page-generator' ),
            ),
            array(
                __( 'SEO and Schema Compatible', 'page-generator' ),
                __( 'Works with SEO and Schema Plugins including AIOSEO, Genesis, Meta Tag Manager, Platinum SEO, Rank Math, Schema Pro, SEOPress, SEOPressor, WPSSO, Yoast and more.', 'page-generator' ),
            ),
            array(
                __( 'Page Builder Support', 'page-generator' ),
                __( 'Works with Ark, Avada, Avia, Beaver Builder, BeTheme, Bold, Divi, Elementor, Enfold, Flatsome, Fusion Builder, Fresh Builder, Live Composer, Muffin, Pro, SiteOrigin, Thrive Architect, Visual Composer, X and more.', 'page-generator' ),
            ),
            array(
                __( 'Use existing Site Designs / Layouts', 'page-generator' ),
                __( 'One click functionality to import existing layouts from your WordPress Pages/Posts.', 'page-generator' ),
            ),
            array(
                __( 'Build Interlinked Directory Sites', 'page-generator' ),
                __( 'Full support for hierarchical content generation and interlinking, such as Region > County > City > ZIP Code > Service.', 'page-generator' ),
            ),
            array(
                __( 'Multiple Keyword Sources', 'page-generator' ),
                __( 'Import your text file and CSV keyword lists, use a local database table or link to remotely hosted CSV files.', 'page-generator' ),
            ),
            array(
                __( 'City, County, Region/State and ZIP Code Keywords', 'page-generator' ),
                __( 'Enter a city name, country and radius to automatically build a keyword containing all nearby cities, counties, ZIP codes and/or Phone Area Codes.', 'page-generator' ),
            ),
            array(
                __( 'Powerful Keyword Transformations', 'page-generator' ),
                __( 'Change the case of Keyword Terms, extract sub terms, force specific terms to be used and more.', 'page-generator' ),
            ),
            array(
                __( 'Spintax, Nested Spintax and Block Spintax Support', 'page-generator' ),
                __( 'Generate truly unique, non-duplicate content by writing content using spintax, nested spintax and block spinning - or have Page Generator Pro generate spintax from your content for you.', 'page-generator' ),
            ),
            array(
                __( 'Overwrite or Skip Existing Generated Content', 'page-generator' ),
                __( 'Refresh existing content, correct mistakes in previously generated Pages or choose to skip already generated content to avoid duplication.', 'page-generator' ),
            ),
            array(
                __( 'Embed Dynamic Images, Maps, Wikipedia and Yelp Content', 'page-generator' ),
                __( 'Dynamic shortcodes can be inserted into your content to output Google Maps, Media Library Images, OpenStreetMap, Pexels / Pixabay Images, Related Links, Wikipedia Content, Yelp! Business Listings and YouTube Videos.', 'page-generator' ),
            ),
            array(
                __( 'Advanced Scheduling Functionality', 'page-generator' ),
                __( 'Publish content in the past, now or schedule for the future, to drip feed content over time.', 'page-generator' ),
            ),
            array(
                __( 'Page Attribute and Menu Support', 'page-generator' ),
                __( 'Define Page Templates, Page Parent and Menu items for your generated Pages.', 'page-generator' ),
            ),
            array(
                __( 'Full Taxonomy Support', 'page-generator' ),
                __( 'Choose taxonomy terms to assign to your generated content, or have Page Generator Pro create new taxonomy terms.  For more dynamic content, keyword support in taxonomies is provided.', 'page-generator' ),
            ),
            array(
                __( 'Multilingual Support', 'page-generator' ),
                __( 'Page Generator Pro supports Polylang and WPML, to generate content in multiple languages.', 'page-generator' ),
            ),
            array(
                __( 'Generate Comments', 'page-generator' ),
                __( 'Generate comments for each generated Post, with options to specify the number of comments, the date of each comment between a date range, each comment’s author and comment..  For more dynamic content, keyword support in taxonomies is provided.', 'page-generator' ),
            ),
        );

        // Dashboard Submodule
        if ( ! class_exists( 'WPZincDashboardWidget' ) ) {
            require_once( $this->plugin->folder . '_modules/dashboard/dashboard.php' );
        }
        $this->dashboard = new WPZincDashboardWidget( $this->plugin, 'http://www.wpzinc.com/wp-content/plugins/lum-deactivation' );

        // Defer loading of Plugin Classes
        add_action( 'init', array( $this, 'initialize' ), 1 );
        add_action( 'init', array( $this, 'upgrade' ), 2 );

    }

    /**
     * Initializes required and licensed classes
     *
     * @since   1.9.8
     */
    public function initialize() {

        $this->classes = new stdClass;

        $this->initialize_admin_or_frontend_editor();
        $this->initialize_frontend();

    }

    /**
     * Initialize classes for the WordPress Administration interface or a frontend Page Builder
     *
     * @since   2.5.2
     */
    private function initialize_admin_or_frontend_editor() {

        // Bail if this request isn't for the WordPress Administration interface and isn't for a frontend Page Builder
        if ( ! $this->is_admin_or_frontend_editor() ) {
            return;
        }

        $this->classes->admin               = new Page_Generator_Pro_Admin( self::$instance );
        $this->classes->ajax                = new Page_Generator_Pro_AJAX( self::$instance );
        $this->classes->common              = new Page_Generator_Pro_Common( self::$instance );
        $this->classes->editor              = new Page_Generator_Pro_Editor( self::$instance );
        $this->classes->generate            = new Page_Generator_Pro_Generate( self::$instance );
        $this->classes->groups_ui           = new Page_Generator_Pro_Groups_UI( self::$instance );
        $this->classes->groups              = new Page_Generator_Pro_Groups( self::$instance );
        $this->classes->install             = new Page_Generator_Pro_Install( self::$instance );
        $this->classes->keywords            = new Page_Generator_Pro_Keywords( self::$instance );
        $this->classes->keywords_source_local = new Page_Generator_Pro_Keywords_Source_Local( self::$instance );
        $this->classes->notices             = new Page_Generator_Pro_Notices( self::$instance );
        $this->classes->post_type           = new Page_Generator_Pro_PostType( self::$instance );
        $this->classes->settings            = new Page_Generator_Pro_Settings( self::$instance );
        $this->classes->screen              = new Page_Generator_Pro_Screen( self::$instance );
    
    }

    /**
     * Initialize classes for the frontend web site
     *
     * @since   2.5.2
     */
    private function initialize_frontend() {

        // Bail if this request isn't for the frontend web site
        if ( is_admin() ) {
            return;
        }
        
        $this->classes->common                      = new Page_Generator_Pro_Common( self::$instance );
        $this->classes->post_type                   = new Page_Generator_Pro_PostType( self::$instance );
        $this->classes->settings                    = new Page_Generator_Pro_Settings( self::$instance );

    }

    /**
     * Improved version of WordPress' is_admin(), which includes whether we're
     * editing on the frontend using a Page Builder.
     *
     * @since   2.5.2
     *
     * @return  bool    Is Admin or Frontend Editor Request
     */
    public function is_admin_or_frontend_editor() {

        return is_admin();

    }

    /**
     * Runs the upgrade routine once the plugin has loaded
     *
     * @since   1.1.7
     */
    public function upgrade() {

        // Bail if we're not in the WordPress Admin
        if ( ! is_admin() ) {
            return;
        }

        // Run upgrade routine
        $this->get_class( 'install' )->upgrade();

    }

    /**
     * Returns the given class
     *
     * @since   1.9.8
     *
     * @param   string  $name   Class Name
     * @return  object          Class Object
     */
    public function get_class( $name ) {

        // If the class hasn't been loaded, throw a WordPress die screen
        // to avoid a PHP fatal error.
        if ( ! isset( $this->classes->{ $name } ) ) {
            // Define the error
            $error = new WP_Error( 'page_generator_get_class', sprintf( __( '%s: Error: Could not load Plugin class <strong>%s</strong>', $this->plugin->name ), $this->plugin->displayName, $name ) );
             
            // Depending on the request, return or display an error
            // Admin UI
            if ( is_admin() ) {  
                wp_die(
                    $error,
                    sprintf( __( '%s: Error', 'page-generator' ), $this->plugin->displayName ),
                    array(
                        'back_link' => true,
                    )
                );
            }

            // Cron / CLI
            return $error;
        }

        // Return the class object
        return $this->classes->{ $name };

    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since   1.1.6
     *
     * @return  object Class.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
            self::$instance = new self;
        }

        return self::$instance;

    }

}

/**
 * Define the autoloader for this Plugin
 *
 * @since   1.9.8
 *
 * @param   string  $class_name     The class to load
 */
function Page_Generator_Autoloader( $class_name ) {

    // Define the required start of the class name
    $class_start_name = array(
        'Page_Generator_Pro',
    );

    // Get the number of parts the class start name has
    $class_parts_count = count( explode( '_', $class_start_name[0] ) );

    // Break the class name into an array
    $class_path = explode( '_', $class_name );

    // Bail if it's not a minimum length
    if ( count( $class_path ) < $class_parts_count ) {
        return;
    }

    // Build the base class path for this class
    $base_class_path = '';
    for ( $i = 0; $i < $class_parts_count; $i++ ) {
        $base_class_path .= $class_path[ $i ] . '_';
    }
    $base_class_path = trim( $base_class_path, '_' );

    // Bail if the first parts don't match what we expect
    if ( ! in_array( $base_class_path, $class_start_name ) ) {
        return;
    }

    // Define the file name we need to include
    $file_name = strtolower( implode( '-', array_slice( $class_path, $class_parts_count ) ) ) . '.php';

    // Define the paths with file name we need to include
    $include_paths = array(
        dirname( __FILE__ ) . '/includes/admin/' . $file_name,
        dirname( __FILE__ ) . '/includes/global/' . $file_name,
    );

    // Iterate through the include paths to find the file
    foreach ( $include_paths as $path_file ) {
        if ( file_exists( $path_file ) ) {
            require_once( $path_file );
            return;
        }
    }

}
spl_autoload_register( 'Page_Generator_Autoloader' );

// Load Activation and Deactivation functions
include_once( dirname( __FILE__ ) . '/includes/admin/activation.php' );
include_once( dirname( __FILE__ ) . '/includes/admin/deactivation.php' );
register_activation_hook( __FILE__, 'page_generator_activate' );
add_action( 'wpmu_new_blog', 'page_generator_activate_new_site' );
add_action( 'activate_blog', 'page_generator_activate_new_site' );
register_deactivation_hook( __FILE__, 'page_generator_deactivate' );

/**
 * Main function to return Plugin instance.
 *
 * @since   1.9.8
 */
function Page_Generator() {
    
    return Page_Generator::get_instance();

}

// Finally, initialize the Plugin.
Page_Generator();