<?php
/**
 * Keywords class
 * 
 * @package Page_Generator_Pro
 * @author  Tim Carr
 * @version 1.0.0
 */
class Page_Generator_Pro_Keywords {

    /**
     * Holds the base class object.
     *
     * @since   1.9.7
     *
     * @var     object
     */
    public $base;

    /**
     * Primary SQL Table
     *
     * @since   1.0.0
     *
     * @var     string
     */
    public $table = 'page_generator_keywords';
    
    /**
     * Primary SQL Table Primary Key
     *
     * @since   1.0.0
     *
     * @var     string
     */
    public $key = 'keywordID';

    /**
     * Holds query results from calling get_keywords_names(),
     * for performance
     *
     * @since   3.0.9
     *
     * @var     mixed
     */
    private $keywords_names = false;

    /**
     * Holds query results from calling get_keywords_and_columns(),
     * for performance
     *
     * @since   3.0.7
     *
     * @var     mixed
     */
    private $keywords_columns = false;

    /**
     * Holds query results from calling get_keywords_and_columns(),
     * for performance
     *
     * @since   3.1.3
     *
     * @var     mixed
     */
    private $keywords_columns_with_curly_braces = false;

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
     * Activation routines for this Model
     *
     * @since   1.0.7
     *
     * @global  $wpdb   WordPress DB Object
     */
    public function activate() {

        global $wpdb;

        // Enable error output if WP_DEBUG is enabled.
        $wpdb->show_errors = true;

        // Create database tables
        $wpdb->query( " CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "page_generator_keywords (
                            `keywordID` int(10) NOT NULL AUTO_INCREMENT,
                            `keyword` varchar(191) NOT NULL,
                            `source` varchar(191) NOT NULL,
                            `options` text NOT NULL,
                            `columns` text NOT NULL,
                            `delimiter` varchar(191) NOT NULL,
                            `data` longtext NOT NULL,
                            PRIMARY KEY `keywordID` (`keywordID`),
                            UNIQUE KEY `keyword` (`keyword`)
                        ) " . $wpdb->get_charset_collate() . " AUTO_INCREMENT=1" ); 

    }

    /**
     * Upgrades the Model's database table if required columns
     * are missing.
     *
     * @since   1.7.8
     *
     * @global  $wpdb   WordPress DB Object
     */
    public function upgrade() {

        global $wpdb;

        // Fetch columns
        $columns = $wpdb->get_results( "SHOW COLUMNS FROM " . $wpdb->prefix . "page_generator_keywords" );

        // Bail if no columns found
        if ( ! is_array( $columns ) || count( $columns ) == 0 ) {
            return true;
        }

        // Define columns we're searching for
        $required_columns = array(
            'source'    => false,
            'options'   => false,
            'columns'   => false,
            'delimiter' => false,
        );

        // Iterate through columns
        foreach ( $columns as $column ) {
            if ( array_key_exists( $column->Field, $required_columns ) ) {
                $required_columns[ $column->Field ] = true;
            }
        }

        // Iterate through our required columns, adding them to the database table if they don't exist
        foreach ( $required_columns as $column => $exists ) {
            if ( $exists ) {
                continue;
            }

            switch ( $column ) {
                /**
                 * text columns
                 */
                case 'options':
                case 'columns':
                    $wpdb->query( " ALTER TABLE " . $wpdb->prefix . "page_generator_keywords
                            ADD COLUMN `" . $column . "` text NOT NULL AFTER `keyword`" );
                    break;

                
                    $wpdb->query( " ALTER TABLE " . $wpdb->prefix . "page_generator_keywords
                            ADD COLUMN `" . $column . "` text NOT NULL AFTER `keyword`" );
                    break;

                /**
                 * varchar columns
                 */
                case 'source':
                case 'delimiter':
                    $wpdb->query( " ALTER TABLE " . $wpdb->prefix . "page_generator_keywords
                            ADD COLUMN `" . $column . "` varchar(191) NOT NULL AFTER `keyword`" );
                    break;
            }
        }

        return true;

    }

    /**
     * Changes the 'columns' field from varchar to text, so that many column names can be stored
     * against a Keyword
     *
     * @since   2.4.5
     */
    public function upgrade_columns_type_to_text() {

        global $wpdb;

        // Fetch columns
        $columns = $wpdb->get_results( "SHOW COLUMNS FROM " . $wpdb->prefix . "page_generator_keywords" );

        // Find column
        foreach ( $columns as $column ) {
            if ( $column->Field != 'columns' ) {
                continue;
            }

            // If here, we found the column we want
            if ( $column->Type == 'text' ) {
                // Already set to the correct type
                return true;
            }

            // Change column from varchar to text
            $wpdb->query( " ALTER TABLE " . $wpdb->prefix . "page_generator_keywords
                            MODIFY COLUMN `" . $column->Field . "` text NOT NULL" );

            return true;
        }

        return true;

    }

    /**
     * Changes the 'data' field from mediumtext to longtext, so that more Terms can be stored against a Keyword
     *
     * @since   3.1.9
     */
    public function upgrade_data_type_to_longtext() {

        global $wpdb;

        // Fetch columns
        $columns = $wpdb->get_results( "SHOW COLUMNS FROM " . $wpdb->prefix . "page_generator_keywords" );

        // Find column
        foreach ( $columns as $column ) {
            if ( $column->Field != 'data' ) {
                continue;
            }

            // If here, we found the column we want
            if ( $column->Type == 'longtext' ) {
                // Already set to the correct type
                return true;
            }

            // Change column from varchar to text
            $wpdb->query( " ALTER TABLE " . $wpdb->prefix . "page_generator_keywords
                            MODIFY COLUMN `" . $column->Field . "` longtext NOT NULL" );

            return true;
        }

        return true;

    }

    /**
     * Returns an array of Keyword Sources and their attributes.
     *
     * @since   3.0.8
     *
     * @return  mixed   bool | array
     */
    public function get_sources() {

        return apply_filters( 'page_generator_pro_keywords_register_sources', array() );

    }

    /**
     * Updates Terms for the given Keywords, if a Keyword's Source isn't local,
     * by fetching them from the remote sources.
     *
     * @since   3.0.8
     *
     * @param   array   $keywords   Keywords to Update Terms for
     * @return  mixed               WP_Error | true
     */
    public function refresh_terms( $keywords ) {

        global $wpdb;
       
        // Iterate through Keywords, updating each Keyword's Terms
        foreach ( $keywords as $keyword ) {
            // Get Keyword
            $query = $wpdb->prepare("   SELECT keywordID, keyword, source, columns, delimiter, options
                                        FROM " . $wpdb->prefix . $this->table . "
                                        WHERE keyword = '%s'
                                        LIMIT 1",
                                        $keyword ); 
            $keyword = $wpdb->get_row( $query, ARRAY_A );

            // Skip if the Keyword doesn't exist
            if ( is_null( $keyword ) ) {
                continue;
            }
            if ( ! count( $keyword ) ) {
                continue;
            }

            // Skip if the Keyword's source is local or blank (blank is a local source prior to 3.0.8)
            if ( $keyword['source'] == 'local' || empty( $keyword['source'] ) ) {
                continue;
            }

            // Expand options JSON
            if ( ! empty( $keyword['options'] ) ) {
                $keyword['options'] = json_decode( $keyword['options'], true );
            }

            /**
             * Refresh the given Keyword's Terms by fetching them from the database
             * immediately before starting generation.
             *
             * @since   3.0.8
             *
             * @param   string  $terms      Terms
             * @param   array   $keyword    Keyword
             */
            $terms = apply_filters( 'page_generator_pro_keywords_refresh_terms_' . $keyword['source'], '', $keyword );

            // If the Keyword Terms is a WP_Error, bail
            if ( is_wp_error( $terms ) ) {
                return $terms;
            }
            
            // Apply Terms to Keyword
            $keyword['data'] = $terms;

            // Save Keyword (returns WP_Error or Keyword ID)
            $result = $this->save( $keyword, $keyword['keywordID'] );

            // If saving the Keyword failed, bail
            if ( is_wp_error( $result ) ) {
                return $result;
            }

        }

        // All Keyword Terms refreshed
        return true;

    }

    /**
     * Gets a record by its ID
     *
     * @since   1.0.0
     *
     * @param   int    $id  ID
     * @return  mixed       Record | false
     */
    public function get_by_id( $id ) {

        global $wpdb;
       
        // Get record
        $query = $wpdb->prepare("   SELECT *
                                    FROM " . $wpdb->prefix . $this->table . "
                                    WHERE " . $this->key . " = %d
                                    LIMIT 1",
                                    $id ); 
        $results = $wpdb->get_results( $query, ARRAY_A );
        
        // Check a record was found     
        if ( ! $results ) {
            return false;
        }             
        if ( count( $results ) == 0 ) {
            return false;
        }

        // Return single result from results
        return $this->get( $results[0] );

    }
    
    /**
     * Gets a single result by the key/value pair
     *
     * @since   1.0.0
     *
     * @param   string  $field  Field Name
     * @param   string  $value  Field Value
     * @return  array           Records
     */
    public function get_by( $field, $value ) {
        
        global $wpdb;
       
        // Get record
        $query = $wpdb->prepare("   SELECT *
                                    FROM " . $wpdb->prefix . $this->table . "
                                    WHERE " . $field . " = '%s'",
                                    $value ); 
        $results = $wpdb->get_results( $query, ARRAY_A );

        // Check a record was found     
        if ( ! $results ) {
            return false;
        }
        if ( count( $results ) == 0 ) {
            return false;
        }

        // Return single result from results
        return $this->get( $results[0] );

    }
    
    /**
     * Returns an array of records
     *
     * @since   1.0.0
     * 
     * @param   string  $order_by           Order By Column (default: keyword, optional)
     * @param   string  $order              Order Direction (default: ASC, optional)
     * @param   int     $paged              Pagination (default: 1, optional)
     * @param   int     $results_per_page   Results per page (default: 10, optional)
     * @param   string  $search             Search Keywords (optional)
     * @return  array                       Records
     */
    public function get_all( $order_by = 'keyword', $order = 'ASC', $paged = 1, $results_per_page = 10, $search = '' ) {
        
        global $wpdb;
        
        $get_all = ( ( $paged == -1 ) ? true : false );

        // Search? 
        if ( ! empty( $search ) ) {
            $query = $wpdb->prepare( "  SELECT *
                                        FROM " . $wpdb->prefix . $this->table . "
                                        WHERE keyword LIKE '%%%s%%'
                                        ORDER BY " . $order_by . " " . $order,
                                        $search );
        } else {
            $query = "  SELECT *
                        FROM " . $wpdb->prefix . $this->table . "
                        ORDER BY " . $order_by . " " . $order;
        }

        // Add Limit
        if ( ! $get_all ) {
            $query = $query . $wpdb->prepare( " LIMIT %d, %d",
                                                ( ( $paged - 1 ) * $results_per_page ),
                                                $results_per_page );
        }

        // Get results
        $results = $wpdb->get_results( $query );

        // Check a record was found     
        if ( ! $results ) {
            return false;
        }             
        if ( count( $results ) == 0 ) {
            return false;
        }

        return stripslashes_deep( $results );

    }

    /**
     * Returns keywords names in lowercase
     *
     * @since   3.0.9
     * 
     * @param   bool    $include_curly_braces   Include Curly Braces on Keywords in Results
     * @return  array                           Keywords
     */
    public function get_keywords_names( $include_curly_braces = false ) {

        // If the query results are already stored, use those for performance
        if ( $this->keywords_names ) {
            return $this->keywords_names;
        }
        
        global $wpdb;
        
        // Get results
        $results = $wpdb->get_results( "SELECT keyword
                                        FROM " . $wpdb->prefix . $this->table . "
                                        ORDER BY keyword ASC", ARRAY_A );

        // Check a record was found     
        if ( ! $results ) {
            return false;
        }             
        if ( count( $results ) == 0 ) {
            return false;
        }

        // Iterate through results, building keywords
        $keywords = array();
        foreach ( $results as $result ) {
            // Add keywords
            $keywords[] = strtolower( ( $include_curly_braces ? '{' : '' ) . $result['keyword'] . ( $include_curly_braces ? '}' : '' ) );
        }

        // Store results in class for performance, to save running this query again
        $this->keywords_names = stripslashes_deep( $keywords );

        // Return
        return $this->keywords_names;

    }

    /**
     * Returns keywords and keywords with individual column subsets.
     *
     * @since   1.9.7
     * 
     * @param   bool    $include_curly_braces   Include Curly Braces on Keywords in Results
     * @return  array                           Keywords
     */
    public function get_keywords_and_columns( $include_curly_braces = false ) {

        // If the query results are already stored, use those for performance
        if ( $include_curly_braces ) {
            if ( $this->keywords_columns_with_curly_braces ) {
                return $this->keywords_columns_with_curly_braces;
            }
        } else {
            if ( $this->keywords_columns ) {
                return $this->keywords_columns;
            }
        }
        
        global $wpdb;
        
        // Get results
        $results = $wpdb->get_results( "SELECT keyword, columns, delimiter
                                        FROM " . $wpdb->prefix . $this->table . "
                                        ORDER BY keyword ASC", ARRAY_A );

        // Check a record was found     
        if ( ! $results ) {
            return false;
        }             
        if ( count( $results ) == 0 ) {
            return false;
        }

        // Iterate through results, building keywords
        $keywords = array();
        foreach ( $results as $result ) {
            // Add keywords
            $keywords[] = ( $include_curly_braces ? '{' : '' ) . $result['keyword'] . ( $include_curly_braces ? '}' : '' );

            // If the columns are empty, ignore
            if ( empty( $result['columns'] ) ) {
                continue;
            }

            // If the delimiter is missing, ignore
            if ( empty( $result['delimiter'] ) ) {
                continue;
            }

            // Get columns
            $columns = explode( ',', $result['columns'] );
            if ( count( $columns ) == 0 ) {
                continue;
            }
            if ( ! is_array( $columns ) ) {
                continue;
            }

            // Add each column as a keyword
            foreach ( $columns as $column ) {
                $keywords[] = ( $include_curly_braces ? '{' : '' ) . $result['keyword'] . '(' . trim( $column ) . ')' . ( $include_curly_braces ? '}' : '' );
            }
        }

        // Store results in class for performance, to save running this query again
        if ( $include_curly_braces ) {
            $this->keywords_columns_with_curly_braces = stripslashes_deep( $keywords );
            return $this->keywords_columns_with_curly_braces;
        }
        
        $this->keywords_columns = stripslashes_deep( $keywords );
        return $this->keywords_columns;

    }

    /**
     * Confirms whether a keyword already exists.
     *
     * @since   1.0.0
     *
     * @param   string  $keyword        Keyword
     * @param   int     $id             Keyword ID (if defined and matches the ID found for an existing keyword, it's ignored)
     * @return  bool                    Exists
     */
    public function exists( $keyword, $id = '' ) {
        
        global $wpdb;

        // Prepare query
        if ( empty( $id ) ) {
            $query = $wpdb->prepare("   SELECT keywordID
                                        FROM " . $wpdb->prefix . $this->table . "
                                        WHERE keyword = '%s'",
                                        $keyword ); 
        } else {
            $query = $wpdb->prepare("   SELECT keywordID
                                        FROM " . $wpdb->prefix . $this->table . "
                                        WHERE keyword = '%s'
                                        AND keywordID != %d",
                                        $keyword,
                                        $id ); 
        }

        // Run query
        $results = $wpdb->get_results( $query, ARRAY_A );
 
        // Check a record was found     
        if ( ! $results ) {
            return false;
        }             
        if ( count( $results ) == 0 ) {
            return false;
        }

        return true;

    }
    
    /**
     * Get the number of matching records
     *
     * @since   1.0.0
     *
     * @param   string  $search Search Keywords (optional)
     * @return  bool            Exists
     */
    public function total( $search = '' ) {

        global $wpdb;
        
        // Prepare query
        if ( ! empty( $search ) ) {
            $query = $wpdb->prepare( "  SELECT COUNT(" . $this->key . ")
                                        FROM " . $wpdb->prefix . $this->table . "
                                        WHERE keyword LIKE '%%%s%%'",
                                        $search ); 
        } else {
            $query = "  SELECT COUNT( " . $this->key . " )
                        FROM " . $wpdb->prefix . $this->table; 
    
        }
        
        // Return count
        return $wpdb->get_var( $query );

    }

    /**
     * Return Terms for the given Keyword ID, based on the optional
     * offset, limit and search parameters.
     *
     * @since   3.0.9
     *
     * @param   int     $id             Keyword ID
     * @param   int     $offset         Record Offset
     * @param   int     $limit          Number of Terms to return. 0 = all Terms
     * @param   mixed   $search         Search Terms
     * @param   bool    $associative    Return results with column names
     * @return  mixed                   false | array
     */
    public function get_terms( $id, $offset = 0, $limit = 0, $search = false, $associative = false ) {

        // Get Keyword
        $keyword = $this->get_by_id( $id );
        if ( ! $keyword ) {
            return false;
        }

        // Read data
        if ( $keyword['columns'] && $keyword['delimiter'] ) {
            $reader = \League\Csv\Reader::createFromString( $keyword['columns'] . "\n" . $keyword['data'] );
            $reader->setDelimiter( $keyword['delimiter'] );  
            $reader->setHeaderOffset(0);
            $columns = $reader->getHeader(); 
        } else {
            $reader = \League\Csv\Reader::createFromString( $keyword['data'] );
        }

        // If no pagination or search parameters exists, return now
        if ( ! $offset && ! $limit && ! $search ) {
            $terms = array_values( iterator_to_array( $reader->getRecords() ) );
            if ( $associative ) {
                return array(
                    'data'      => $terms,
                    'total'     => count( $terms ),
                    'filtered'  => count( $terms ),
                );
            }

            // Convert to numeric arrays
            foreach ( $terms as $index => $term ) {
                $terms[ $index ] = array_values( $term );
            }
            return array(
                'data'      => $terms,
                'total'     => count( $terms ),
                'filtered'  => count( $terms ),
            );
        }

        // Define total and filtered record counts
        $total = count( $reader );

        // Create query
        $query = \League\Csv\Statement::create();

        // Add search constraints
        if ( $search ) {
            $query = $query->where( function( $record ) use ( $search ) {
                foreach ( $record as $cell ) {
                    if ( stripos( $cell, $search ) !== false ) {
                        return true;
                    }
                }

                return false;
            } );
        }

        // Define filtered record count now, before we apply pagination
        $filtered = count( $query->process( $reader ) );

        // Add pagination constraints
        if ( $offset || $limit ) {
            $query = $query->offset( $offset )->limit( $limit );
        }

        // Run query
        $records = $query->process( $reader );

        // Return associative array
        $terms = array_values( iterator_to_array( $records->getRecords() ) );
        if ( $associative ) {
            return array(
                'data'      => $terms,
                'total'     => $total,
                'filtered'  => $filtered,
            );
        }

        // Convert to numeric arrays
        foreach ( $terms as $index => $term ) {
            $terms[ $index ] = array_values( $term );
        }
        return array(
            'data'      => $terms,
            'total'     => $total,
            'filtered'  => $filtered,
        );

    }

    /**
     * Returns the given record, casting values, stripping slashes
     * and expanding data into arrays
     *
     * @since   3.0.8
     *
     * @param   array   $result     Keyword Row
     * @return  array               Keyword Row
     */
    private function get( $result ) {

        // Cast values
        $result['keywordID'] = absint( $result['keywordID'] );

        // Stripslashes
        $result['data'] = stripslashes( $result['data'] );
        $result['delimiter'] = stripslashes( $result['delimiter'] );
        $result['columns'] = stripslashes( $result['columns'] );

        // Expand data into array
        $result['dataArr'] = explode( "\n", $result['data'] );
        $result['columnsArr'] = explode( ",", $result['columns'] );

        // Expand options JSON
        if ( ! empty( $result['options'] ) ) {
            $result['options'] = json_decode( $result['options'], true );
        }

        // Define the source as local if no source exists
        if ( empty( $result['source'] ) ) {
            $result['source'] = 'local';
        }

        // Return record
        return $result;

    }

    /**
     * Reads an uploaded text file of keyword data into a string.
     *
     * @since   1.0.7
     *
     * @param   string  $file           Full Path and Filename to CSV File
     * @return  string                  Data
     */ 
    public function read_text_file( $file ) {
   
        // Get file contents
        $handle = fopen( $file, 'r' );
        $contents = fread( $handle, filesize( $file ) );
        fclose( $handle );

        // Remove UTF8 BOM sequences
        $contents = $this->remove_utf8_bom( $contents );

        // Return
        return $contents;

    }

    /**
     * Reads an uploaded CSV file of keyword data into an array.
     *
     * Supports multiple CSV structures, as detailed in the $csv_format argument below.
     *
     * @since   1.7.3
     *
     * @param   string  $file           Either URL or Full Path and Filename to CSV File
     * @param   string  $csv_format     CSV Format
     *                                  columns_single_keyword: Import Columns into a single Keyword. Columns = Column Names
     *                                  columns_multiple_keywords: Import Columns as multiple Keywords. Columns = Keyword Names
     *                                  rows_single_keyword: Import Rows into a single Keyword. Rows = Column Names
     *                                  rows_multiple_keywords: Import Rows into multiple Keywords. Rows = Keyword Names
     * @param   string  $delimiter      Delimiter
     * @return  mixed                   WP_Error | int
     */ 
    public function read_csv_file( $file, $csv_format = 'columns_single_keyword', $delimiter = ',', $keyword_name = false ) {

        // Get file contents from local or remote file
        if ( filter_var( $file, FILTER_VALIDATE_URL ) ) {
            // Get content
            $result = wp_remote_get( $file );

            // Bail if an error occured
            if ( is_wp_error( $result ) ) {
                return new WP_Error( 
                    'page_generator_pro_keywords_read_csv_file',
                    sprintf(
                        /* translators: URL */
                        __( 'Could not download %s.  Make sure the URL is publicly available.', 'page-generator' ),
                        $file
                    )
                );
            }

            // Fetch contents
            $contents = wp_remote_retrieve_body( $result );
        } else {
            $contents = file_get_contents( $file );
        }

        // Bail if file contents are empty
        if ( strlen( $contents ) == 0 || empty( $contents ) || $contents === FALSE ) {
            return new WP_Error( 'page_generator_pro_keywords_import_csv_file_data_empty', __( 'The uploaded file contains no data.', 'page-generator' ) );  
        }

        // Fetch rows
        $rows = explode( "\n", $contents );

        // Bail if no rows found
        if ( ! count( $rows ) ) {
            return new WP_Error( 'page_generator_pro_keywords_import_csv_file_data_no_rows', __( 'The uploaded file only contains one row of data.  There must be at least two rows; the first being the keywords.', 'page-generator' ) );
        }

        // Define comma as the default delimiter if not supplied
        if ( ! $delimiter || empty( $delimiter ) ) {
            $delimiter = ',';
        }

        // Build array comprising of keywords and their terms
        $keywords_index = array();
        $keywords_terms = array();
        foreach ( $rows as $index => $row ) {
            $terms = str_getcsv( $row, $delimiter );

            // Depending on where the keywords are, parse the terms
            switch ( $csv_format ) {

                /**
                 * Import Columns into a single Keyword. Columns = Column Names
                 */
                case 'columns_single_keyword':
                    // First row are column names
                    if ( $index == 0 ) {
                        // Remove UTF8-bom and trim column names
                        $columns = array();
                        foreach ( $terms as $term ) {
                            $columns[] = $this->remove_utf8_bom( $term );
                        }
                        $keywords_terms[ $keyword_name ] = array(
                            'data'      => array(),
                            'columns'   => implode( ',', $columns ),
                            'delimiter' => $delimiter,
                        );
                        break;
                    }

                    // Sanitize Terms in this CSV row
                    foreach ( $terms as $i => $term ) {
                        $terms[ $i ] = $this->sanitize_term( $term, $delimiter );
                    }

                    // Add to keyword array
                    $keywords_terms[ $keyword_name ]['data'][] = implode( $delimiter, $terms );
                    break;

                /**
                 * Import Columns into multiple Keywords. Columns = Keyword Names
                 */
                case 'columns_multiple_keywords':
                    // First row are keywords
                    if ( $index == 0 ) {
                        foreach ( $terms as $term ) {
                            // Remove UTF8-bom and trim
                            $term = $this->remove_utf8_bom( $term );

                            // Convert Term to valid Keyword Name
                            $keyword_name = preg_replace( '/[\\s\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', '', $term );

                            // Add Keyword
                            $keywords_index[] = $keyword_name;
                            $keywords_terms[ $keyword_name ] = array(
                                'data' => array(),
                            );
                        }
                        break;
                    }

                    // Sanitize Term, adding to the keywords array
                    foreach ( $terms as $term_index => $term ) {
                        $keywords_terms[ $keywords_index[ $term_index ] ]['data'][] = $this->sanitize_term( $term, $delimiter );
                    }
                    break;

                /**
                 * Import Rows into single Keyword. Rows = Column Names
                 */
                case 'rows_single_keyword':
                    if ( $index == 0 ) {
                        $keywords_terms[ $keyword_name ] = array(
                            'data'      => array(),
                            'columns'   => array(),
                            'delimiter' => $delimiter,
                        );
                    }

                    // First term is a column name; all other terms are the keyword's terms
                    // Add this row's terms to the keywords array
                    foreach ( $terms as $term_index => $term ) {
                        // Remove UTF8-bom and trim
                        $term = $this->remove_utf8_bom( $term );

                        // First term is the keyword
                        if ( $term_index == 0 ) {
                            $keyword = $term;
                            $keywords_terms[ $keyword_name ]['columns'][] = $term;
                            continue;
                        }

                        // Remaining terms are Keyword Terms

                        // Setup Term row if not defined in the array
                        if ( ! isset ( $keywords_terms[ $keyword_name ]['data'][ $term_index - 1 ] ) ) {
                            $keywords_terms[ $keyword_name ]['data'][ $term_index - 1 ] = '';
                        }

                        // If this term contains the delimiter, encapsulate it
                        if ( strpos( $term, $delimiter ) !== false ) {
                            $term = '"' . $term . '"';
                        }

                        // Escape backslashes and truly replace newlines with <br>
                        $keywords_terms[ $keyword_name ]['data'][ $term_index - 1 ] .= $delimiter . $this->escape_and_replace_newlines_with_br( $term );

                        // Remove leading or trailing delimiters
                        $keywords_terms[ $keyword_name ]['data'][ $term_index - 1 ] = trim( $keywords_terms[ $keyword_name ]['data'][ $term_index - 1 ], $delimiter );
                    }
                    break;

                /**
                 * Import Rows into multiple Keywords. Rows = Keyword Names
                 */
                case 'rows_multiple_keywords':
                    // First term is a keyword; all other terms are the keyword's terms
                    // Add this row's terms to the keywords array
                    foreach ( $terms as $term_index => $term ) {
                        // Remove UTF8-bom and trim
                        $term = $this->remove_utf8_bom( $term );

                        // First term is the keyword
                        if ( $term_index == 0 ) {
                            // Convert Term to valid Keyword Name
                            $keyword_name = preg_replace( '/[\\s\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', '', $term );
                            
                            $keywords_terms[ $keyword_name ] = array(
                                'data' => array(),
                            );
                            continue;
                        }

                        // Escape backslashes and truly replace newlines with <br>
                        $keywords_terms[ $keyword_name ]['data'][] = $this->escape_and_replace_newlines_with_br( $term );
                    }
                    break;

                /**
                 * No Format, just sanitize the entire row
                 */
                default:
                    if ( $index == 0 ) {
                        $keywords_terms[ $keyword_name ] = array(
                            'data'      => array(),
                            'columns'   => '',
                            'delimiter' => '',
                        );
                    }

                    // Add to keyword array
                    $keywords_terms[ $keyword_name ]['data'][] = $this->sanitize_term( $row, false );
                    break;
            }
        }

        // Bail if we couldn't get any keyword terms
        if ( empty( $keywords_terms ) || count( $keywords_terms ) == 0 ) {
            return new WP_Error( 'page_generator_pro_keywords_import_csv_file_data_no_keyword_terms', __( 'No keywords and/or terms could be found in the uploaded file.', 'page-generator' ) );
        }

        // Return Keywords and their data from the CSV file
        return $keywords_terms;

    }

    /**
     * Sanitizes the given row, making them compatible with Keywords, by:
     * - removing UTF8 BOM sequences
     * - escaping backslashes and truly replacing newlines with <br>
     *
     * @since   3.0.8
     *
     * @param   string  $term       Term
     * @param   mixed   $delimiter  Delimiter (false | string)
     * @return  string              Term
     */ 
    public function sanitize_term( $term, $delimiter = false ) {

        // Remove UTF8-bom and trim
        $term = $this->remove_utf8_bom( $term );

        // If this term contains the delimiter, encapsulate it
        if ( $delimiter && strpos( $term, $delimiter ) !== false ) {
            $term = '"' . $term . '"';
        }

        // Escape backslashes and truly replace newlines with <br>
        $term = $this->escape_and_replace_newlines_with_br( $term );
    
        // Return
        return $term;

    }

    /**
     * Removes UTF8 BOM sequences from the given string
     *
     * @since   2.2.1
     *
     * @param   string  $text   Possibly UTF8 BOM encoded string
     * @param   string          String with UTF8 BOM sequences removed
     */
    public function remove_utf8_bom( $text ) {

        $text = trim( $text );
        $bom = pack( 'H*','EFBBBF' );
        $text = preg_replace( "/^$bom/", '', $text );
        
        return trim( $text );
    
    }

    /**
     * Escape backslashes and truly replace newlines with <br>
     *
     * @since   3.0.8
     *
     * @param   string  $term   Term
     * @return  string          Term
     */
    private function escape_and_replace_newlines_with_br( $term ) {

        return addcslashes( 
            preg_replace( "/\r|\n/", "", nl2br( $term ) ),
            "\\"
        );

    }

    /**
     * Adds or edits a record, based on the given data array.
     *
     * @since   1.0.0
     * 
     * @param   array   $data           Array of data to save
     * @param   int     $id             ID (if set, edits the existing record)
     * @param   bool    $append_terms   Whether to append terms to the existing Keyword Term data (false = replace)
     * @return  mixed                   ID or WP_Error
     */
    public function save( $data, $id = '', $append_terms = false ) {

        global $wpdb;

        // Fill missing keys with empty values to avoid DB errors
        if ( ! isset( $data['source'] ) ) {
            $data['source'] = '';
        }
        if ( ! isset( $data['options'] ) ) {
            $data['options'] = '';
        }
        if ( ! isset( $data['columns'] ) ) {
            $data['columns'] = '';
        }
        if ( ! isset( $data['delimiter'] ) ) {
            $data['delimiter'] = '';
        }

        // Strip empty newlines from Terms
        $data['data'] = trim( preg_replace( "/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $data['data'] ) );

        // If the data isn't UTF-8, UTF-8 encode it so it can be inserted into the DB
        if ( function_exists( 'mb_detect_encoding' ) && ! mb_detect_encoding( $data['data'], 'UTF-8', true ) ) {
            $data['data'] = utf8_encode( $data['data'] );
        }

        // Remove spaces from column names
        $data['columns'] = str_replace( ' ', '', $data['columns'] );
       
        // Validate Keyword
        $validated = $this->validate( $data, $id );
        if ( is_wp_error( $validated ) ) {
            return $validated;
        }

        // JSON encode options, if it's an array
        $data['options'] = ( is_array( $data['options'] ) ? json_encode( $data['options'] ) : '' );

        // If here, the Keyword can be added/edited in the database
        // Depending on whether an ID has been defined, update or insert the keyword
        if ( ! empty( $id ) ) {
            if ( $append_terms ) {
                // Prepare query
                $query = $wpdb->prepare( "  UPDATE " . $wpdb->prefix . $this->table . "
                                            SET keyword = %s,
                                            source = %s,
                                            options = %s,
                                            delimiter = %s,
                                            columns = %s,
                                            data = concat(data, '" . addslashes( $data['data'] ) . "')
                                            WHERE " . $this->key . " = %s",
                                            $data['keyword'],
                                            $data['source'],
                                            $data['options'],
                                            $data['delimiter'],
                                            $data['columns'],
                                            $id );

                // Run query
                $result = $wpdb->query( $query );
            } else {
                // Editing an existing record
                $result = $wpdb->update( 
                    $wpdb->prefix . $this->table, 
                    $data, 
                    array(
                        $this->key => $id,
                    ),
                    array(
                        '%s',
                        '%s', 
                        '%s', 
                        '%s',
                        '%s',
                        '%s',   
                    )
                );
            }

            // Check query was successful
            if ( $result === FALSE ) {
                return new WP_Error( 'db_query_error', __( 'Keyword could not be updated in the database. Database error: ' . $wpdb->last_error ), $wpdb->last_error ); 
            }

            // Success!
            return $id;
        } else {
            // Create new record
            $result = $wpdb->insert( 
                $wpdb->prefix . $this->table, 
                $data, 
                array(
                    '%s',
                    '%s', 
                    '%s', 
                    '%s',
                    '%s',
                    '%s',   
                )
            );

            // Check query was successful
            if ( $result === FALSE ) {
                return new WP_Error( 'db_query_error', __( 'Keyword could not be added to the database. Database error: ' . $wpdb->last_error ), $wpdb->last_error ); 
            }
            
            // Get and return ID
            return $wpdb->insert_id;
        }    

    }

    /**
     * Performs a number of validation checks on the supplied Keyword, before it is
     * added / updated in the database
     *
     * @since   3.0.8
     *
     * @param   array   $data   Keyword
     * @param   int     $id     ID (if set, editing an existing Keyword)
     * @return  mixed           boolean | WP_Error
     */
    private function validate( $data, $id = '' ) {

        // Check for required data fields
        if ( empty( $data['keyword'] ) ) {
            return new WP_Error( 'page_generator_pro_keywords_save_validation_error', __( 'Please complete the keyword field.', 'page-generator' ) );
        }

        // Check keyword name doesn't already exist as another keyword
        if ( $this->exists( $data['keyword'], $id ) ) {
             return new WP_Error( 
                'page_generator_pro_keywords_save_validation_error',
                sprintf(
                    /* translators: Keyword Name */
                    __( 'The Keyword "%s" already exists. Please choose a different name.', 'page-generator' ),
                    $data['keyword']
                )
            );   
        }

        // Check that the keyword does not contain spaces
        if ( preg_match( '/[\\s\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $data['keyword'] ) ) {
            return new WP_Error( 'page_generator_pro_keywords_save_validation_error', __( 'The Keyword field can only contain letters, numbers and underscores.', 'page-generator' ) );
        }

        // If column names are specified, check a delimiter exists
        if ( ! empty( $data['columns'] ) && empty( $data['delimiter'] ) ) {
            return new WP_Error( 
                'page_generator_pro_keywords_save_validation_error',
                __( 'Delimiter Field: When specifying column names in the Columns Field, a delimiter must also be specified.', 'page-generator' ) );
        }

        // If a delimiter is supplied, perform some further validation checks
        if ( ! empty( $data['delimiter'] ) ) {
            // Check the delimiter isn't a pipe symbol, curly brace or bracket
            foreach ( $this->get_invalid_delimiters() as $invalid_delimiter ) {
                if ( strpos( $data['delimiter'], $invalid_delimiter ) !== false ) {
                    return new WP_Error( 
                        'page_generator_pro_keywords_save_validation_error',
                        sprintf(
                            /* translators: delimiter character */
                            __( 'Delimiter Field: %s cannot be used as a delimiter, as it may conflict with Keyword and Spintax syntax', 'page-generator' ),
                            '<code>' . $data['delimiter'] . '</code>'
                        )
                    );
                }
            }

            // Check that column names are specified
            if ( empty( $data['columns'] ) ) {
                return new WP_Error( 
                    'page_generator_pro_keywords_save_validation_error',
                    __( 'Columns Field: Two or more column names must be specified in the Columns Field When specifying a delimiter.', 'page-generator' )
                );
            }

            // Check that there is a comma in the column names for separating columns
            if ( strpos( $data['columns'], ',' ) === false ) {
                return new WP_Error( 
                    'page_generator_pro_keywords_save_validation_error', 
                    __( 'Columns Field: The values specified in the Columns Field must be separated by a comma.', 'page-generator' )
                );
            }
        }

        // If here, basic validation has passed
        $result = true;

        /**
         * Runs validation tests specific to this source for a Keyword immediately before it's saved to the database.
         *
         * @since   3.0.9
         *
         * @param   bool    $result     Validation Result
         * @param   array   $data       Keyword
         * @param   int     $id         ID (if set, editing an existing Keyword)
         * @return  mixed               WP_Error | bool
         */
        $result = apply_filters( 'page_generator_pro_keywords_validate_' . $data['source'], $result, $data, $id );

        // Return result, which will be WP_Error or true
        return $result;

    }
 
    /**
     * Deletes the record for the given primary key ID
     *
     * @since   1.0.0
     * 
     * @param   mixed   $data   Single ID or array of IDs
     * @return  bool            Success
     */
    public function delete( $data ) {

        global $wpdb;
        
        if ( is_array( $data ) ) {
            foreach ( $data as $keyword_id ) {
                // Delete Keyword
                $result = $wpdb->delete(
                    $wpdb->prefix . $this->table,
                    array(
                        'keywordID' => $keyword_id,
                    )
                );

                // Check query was successful
                if ( $result === FALSE ) {
                    return new WP_Error( 'db_query_error', __( 'Record(s) could not be deleted from the database. DB said: '.$wpdb->last_error ), $wpdb->last_error );
                }
            }
            $query = "  DELETE FROM " . $wpdb->prefix . $this->table . "
                        WHERE " . $this->key . " IN (" . implode( ',', $data ) . ")";
        } else {
            // Delete Keyword
            $result = $wpdb->delete(
                $wpdb->prefix . $this->table,
                array(
                    'keywordID' => $data,
                )
            );

            // Check query was successful
            if ( $result === FALSE ) {
                return new WP_Error( 'db_query_error', __( 'Record(s) could not be deleted from the database. DB said: '.$wpdb->last_error ), $wpdb->last_error );
            }
        }
        
        return true;

    }

    /**
     * Duplicates the given ID to a new row
     *
     * @since   1.7.8
     *
     * @param   int     $id     Keyword ID
     * @return  mixed           WP_Error | Copied Keyword ID
     */
    public function duplicate( $id ) {

        // Fetch keyword
        $keyword = $this->get_by_id( $id );

        // Bail if no keyword was found
        if ( ! $keyword ) {
            return new WP_Error( 'page_generator_pro_keywords_duplicate', __( 'Keyword could not be found for duplication.', 'page-generator' ) );
        }

        // Delete some keys from the data
        unset( $keyword['keywordID'], $keyword['dataArr'], $keyword['columnsArr'] );

        // Rename the keyword
        $keyword['keyword'] .= '_copy';

        // Save the keyword as a new keyword
        $result = $this->save( $keyword );

        // Return the result (WP_Error | int)
        return $result;

    }

    /**
     * Exports the given ID's Terms to a CSV file
     *
     * @since   2.9.0
     *
     * @param   int     $id     Keyword ID
     * @return  mixed           WP_Error | ?
     */
    public function export_csv( $id ) {

        // Fetch keyword
        $keyword = $this->get_by_id( $id );

        // Bail if no keyword was found
        if ( ! $keyword ) {
            return new WP_Error( 'page_generator_pro_keywords_duplicate', __( 'Keyword could not be found for exporting.', 'page-generator' ) );
        }

        // If Keyword has columns and delimiter, create CSV Reader object and get its text output for the file contents
        if ( ! empty( $keyword['delimiter'] ) ) {
            $reader = \League\Csv\Reader::createFromString( $keyword['columns'] . "\n" . $keyword['data'] );
            $reader->setDelimiter( $keyword['delimiter'] );
            $reader->setHeaderOffset(0);

            // Force browser download of CSV file
            $this->base->dashboard->force_csv_file_download( $reader->getContent(), sanitize_title( $keyword['keyword'] ) );
        }

        // Keyword is a simple Term list
        // Force browser download of CSV file
        $this->base->dashboard->force_csv_file_download( $keyword['data'], sanitize_title( $keyword['keyword'] ) );
        die();

    }

    /**
     * Outputs a <select> dropdown comprising of Keywords, including any
     * Keyword with Column combinations.
     *
     * @since   1.9.7
     *
     * @param   array   $keywords   Keywords
     * @param   string  $element    HTML Element ID to insert Keyword into when selected in dropdown
     */ 
    public function output_dropdown( $keywords, $element ) {

        // Load view
        include( $this->base->plugin->folder . 'views/admin/keywords-dropdown.php' );

    }

    /**
     * Returns an array of delimiters that cannot be used with Keywords, as using
     * them would result in errors with processing Keywords
     *
     * @since   unknown
     *
     * @return  array
     */
    private function get_invalid_delimiters() {

        return array(
            '|',
            '{',
            '}',
            '(',
            ')',
            ':',
        );

    }

}