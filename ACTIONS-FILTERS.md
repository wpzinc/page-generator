<h1>Filters</h1><table>
				<thead>
					<tr>
						<th>File</th>
						<th>Filter Name</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody><tr>
						<td colspan="3">../includes/admin/keywords.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_keywords_register_sources"><code>page_generator_pro_keywords_register_sources</code></a></td>
						<td></td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_keywords_refresh_terms_  keywordsource"><code>page_generator_pro_keywords_refresh_terms_  keywordsource</code></a></td>
						<td>Refresh the given Keyword's Columns and Terms by fetching them from the database immediately before starting generation.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_keywords_validate_  datasource"><code>page_generator_pro_keywords_validate_  datasource</code></a></td>
						<td>Runs validation tests specific to this source for a Keyword immediately before it's saved to the database.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/generate.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_settings"><code>page_generator_pro_generate_content_settings</code></a></td>
						<td>Modify the Group's settings prior to parsing shortcodes and building the Post Arguments to use for generating a single Page, Post or Custom Post Type. Changes made only affect this item in the generation set, and are not persistent or saved. For Gutenberg and Page Builders with Blocks / Elements registered by this Plugin, this is a good time to convert them to a Shortcode Block / Element / Text</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_post_args"><code>page_generator_pro_generate_post_args</code></a></td>
						<td>Filters arguments used for creating or updating a Post when running content generation.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_get_keywords_terms"><code>page_generator_pro_generate_get_keywords_terms</code></a></td>
						<td>Returns an array of keyword and term key / value pairs, before any search or replacement arrays are built.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_replace_keywords_in_array"><code>page_generator_pro_generate_replace_keywords_in_array</code></a></td>
						<td>Perform any other keyword replacements or string processing.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_set_post_meta_ignored_keys"><code>page_generator_pro_generate_set_post_meta_ignored_keys</code></a></td>
						<td>Defines Post Meta Keys in a Content Group to ignore and not copy to generated Posts / Groups.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_set_post_meta_  meta_key"><code>page_generator_pro_generate_set_post_meta_  meta_key</code></a></td>
						<td>Filters the Group Metadata for the given Key and Value, immediately before it's saved to the Generated Page.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/ajax.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_ajax_delete_generated_count_number_of_items"><code>page_generator_pro_ajax_delete_generated_count_number_of_items</code></a></td>
						<td></td>
					</tr><tr>
						<td colspan="3">../includes/admin/notices.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_notices_get_success_notices"><code>page_generator_pro_notices_get_success_notices</code></a></td>
						<td>Filters the success notices to return.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_notices_get_warning_notices"><code>page_generator_pro_notices_get_warning_notices</code></a></td>
						<td>Filters the error notices to return.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_notices_get_error_notices"><code>page_generator_pro_notices_get_error_notices</code></a></td>
						<td>Filters the error notices to return.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_notices_get_notices"><code>page_generator_pro_notices_get_notices</code></a></td>
						<td>Filters the success and error notices to return.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_notices_save"><code>page_generator_pro_notices_save</code></a></td>
						<td>Filters the success and error notices to save.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/editor.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_editor_register_tinymce_plugins"><code>page_generator_pro_editor_register_tinymce_plugins</code></a></td>
						<td>Defines the TinyMCE Plugins to register</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_editor_get_tinymce_plugins"><code>page_generator_pro_editor_get_tinymce_plugins</code></a></td>
						<td>Returns an array of TinyMCE Plugins that aren't shortcodes/blocks, such as Autocomplete</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_editor_should_register_tinymce_plugins"><code>page_generator_pro_editor_should_register_tinymce_plugins</code></a></td>
						<td>Set a flag to denote whether we should register TinyMCE Plugins</td>
					</tr><tr>
						<td colspan="3">../includes/admin/groups.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_get_defaults"><code>page_generator_pro_groups_get_defaults</code></a></td>
						<td>Defines the default settings structure when a new Content Group is created.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_get_settings_remove_orphaned_settings"><code>page_generator_pro_groups_get_settings_remove_orphaned_settings</code></a></td>
						<td>Remove any orphaned data, such as Page Builder, SEO or Schema metadata, from the Group before generation is run, that might remain due to changing Page Builder, SEO or Schema Plugin.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_get_post_meta_ignored_keys"><code>page_generator_pro_groups_get_post_meta_ignored_keys</code></a></td>
						<td>Defines Post Meta Keys in a Content Group to ignore and not copy to generated Posts / Groups.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_get_post_meta_  meta_key"><code>page_generator_pro_groups_get_post_meta_  meta_key</code></a></td>
						<td>Filters the Group Metadata for the given Key and Value</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_get_post_meta"><code>page_generator_pro_groups_get_post_meta</code></a></td>
						<td>Filters the Group Metadata to return.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_run_row_actions"><code>page_generator_pro_groups_run_row_actions</code></a></td>
						<td></td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_run_row_actions_success_message"><code>page_generator_pro_groups_run_row_actions_success_message</code></a></td>
						<td>Define an optional success message based on the result of a custom row action on a Group.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_validate"><code>page_generator_pro_groups_validate</code></a></td>
						<td>Performs several validations on the given Group Settings, to ensure that content generation will function successfully.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_get_group_statuses"><code>page_generator_pro_groups_get_group_statuses</code></a></td>
						<td>Defines available Post Statuses for generated content.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_generates_content"><code>page_generator_pro_groups_generates_content</code></a></td>
						<td>Determine if the given Content Group is eligible to generate content</td>
					</tr><tr>
						<td colspan="3">../includes/admin/admin.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_admin_admin_menu_minimum_capability"><code>page_generator_pro_admin_admin_menu_minimum_capability</code></a></td>
						<td>Defines the minimum capability required to access the Media Library Organizer Menu and Sub Menus</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_keywords_save_  source"><code>page_generator_pro_keywords_save_  source</code></a></td>
						<td>Define the Keyword properties (data, delimiter and columns) for the given Source before saving the Keyword to the database.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/groups-ui.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_ui_remove_meta_boxes"><code>page_generator_pro_groups_ui_remove_meta_boxes</code></a></td>
						<td>Filters the metaboxes to remove from the Content Groups Screen.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_ui_get_titles_and_messages"><code>page_generator_pro_groups_ui_get_titles_and_messages</code></a></td>
						<td>Filters the localization title and message strings used for Generation.</td>
					</tr><tr>
						<td colspan="3">../includes/global/posttype.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_posttype_register_post_types"><code>page_generator_pro_posttype_register_post_types</code></a></td>
						<td>Filter the arguments for registering the Content Groups Post Type</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_posttype_supports"><code>page_generator_pro_posttype_supports</code></a></td>
						<td>Define the supported features for Content Groups</td>
					</tr><tr>
						<td colspan="3">../includes/global/settings.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_get_settings"><code>page_generator_pro_get_settings</code></a></td>
						<td>Filter the Settings before returning.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_update_setting"><code>page_generator_pro_update_setting</code></a></td>
						<td>Filter a specific setting before updating.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_update_settings"><code>page_generator_pro_update_settings</code></a></td>
						<td>Filter the Settings before updating.</td>
					</tr><tr>
						<td colspan="3">../includes/global/screen.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_screen_get_current_screen_before"><code>page_generator_pro_screen_get_current_screen_before</code></a></td>
						<td>Returns an array comprising of a simplified screen and section that we are viewing within the WordPress Administration interface, before we've performed any checks. This is useful for frontend Page Builders and AJAX requests where get_current_screen() below won't return anything.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_screen_get_current_screen"><code>page_generator_pro_screen_get_current_screen</code></a></td>
						<td>Returns an array comprising of a simplified screen and section that we are viewing within the WordPress Administration interface.</td>
					</tr><tr>
						<td colspan="3">../includes/global/common.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_generation_systems"><code>page_generator_pro_common_get_generation_systems</code></a></td>
						<td>Defines available Generation Systems</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_authors"><code>page_generator_pro_common_get_authors</code></a></td>
						<td>Defines available authors for the Author dropdown on the Generate Content screen.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_post_types"><code>page_generator_pro_common_get_post_types</code></a></td>
						<td>Defines the available public Post Type Objects that content can be generated for.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_excluded_post_types"><code>page_generator_pro_common_get_excluded_post_types</code></a></td>
						<td>Defines the Post Type Objects that content cannot be generated for.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_post_type_templates"><code>page_generator_pro_common_get_post_type_templates</code></a></td>
						<td>Defines available Theme Templates for each Post Type that can have content generated for it.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_post_statuses"><code>page_generator_pro_common_get_post_statuses</code></a></td>
						<td>Defines available Post Statuses for generated content.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_autocomplete_configuration"><code>page_generator_pro_common_get_autocomplete_configuration</code></a></td>
						<td>Define autocompleters to use across Content Groups, Term Group and TinyMCE                              If false, autocomplete fields are for Related Links shortcode on a Page or Post.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_autocomplete_enabled_fields"><code>page_generator_pro_common_get_autocomplete_enabled_fields</code></a></td>
						<td>Defines an array of Javascript DOM selectors to enable the keyword autocomplete functionality on.                              If false, autocomplete fields are for Related Links shortcode on a Page or Post.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_selectize_enabled_fields"><code>page_generator_pro_common_get_selectize_enabled_fields</code></a></td>
						<td>Defines an array of Javascript DOM selectors to enable the selectize functionality on.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_common_get_capabilities_to_disable_on_group_content_generation"><code>page_generator_pro_common_get_capabilities_to_disable_on_group_content_generation</code></a></td>
						<td>Defines Role Capabilities that should be disabled when a Content Group is Generating Content.</td>
					</tr>
					</tbody>
				</table><h3 id="page_generator_pro_keywords_register_sources">
						page_generator_pro_keywords_register_sources
						<code>includes/admin/keywords.php::269</code>
					</h3><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>array(</td>
							<td>Unknown</td>
							<td>N/A</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_keywords_register_sources', function( array( ) {
	// ... your code here
	// Return value
	return array(;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_keywords_refresh_terms_  keywordsource">
						page_generator_pro_keywords_refresh_terms_  keywordsource
						<code>includes/admin/keywords.php::322</code>
					</h3><h4>Overview</h4>
						<p>Refresh the given Keyword's Columns and Terms by fetching them from the database immediately before starting generation.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$terms</td>
							<td>string</td>
							<td>Terms.</td>
						</tr><tr>
							<td>$keyword</td>
							<td>array</td>
							<td>Keyword.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_keywords_refresh_terms_  keywordsource', function( '', $keyword ) {
	// ... your code here
	// Return value
	return '';
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_keywords_validate_  datasource">
						page_generator_pro_keywords_validate_  datasource
						<code>includes/admin/keywords.php::1048</code>
					</h3><h4>Overview</h4>
						<p>Runs validation tests specific to this source for a Keyword immediately before it's saved to the database.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$result</td>
							<td>bool</td>
							<td>Validation Result.</td>
						</tr><tr>
							<td>$data</td>
							<td>array</td>
							<td>Keyword.</td>
						</tr><tr>
							<td>$id</td>
							<td>int</td>
							<td>ID (if set, editing an existing Keyword).</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_keywords_validate_  datasource', function( $result, $data, $id ) {
	// ... your code here
	// Return value
	return $result;
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_generate_content_settings">
						page_generator_pro_generate_content_settings
						<code>includes/admin/generate.php::364</code>
					</h3><h4>Overview</h4>
						<p>Modify the Group's settings prior to parsing shortcodes and building the Post Arguments to use for generating a single Page, Post or Custom Post Type. Changes made only affect this item in the generation set, and are not persistent or saved. For Gutenberg and Page Builders with Blocks / Elements registered by this Plugin, this is a good time to convert them to a Shortcode Block / Element / Text</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$index</td>
							<td>int</td>
							<td>Keyword Index.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_generate_content_settings', function( $settings, $group_id, $index, $test_mode ) {
	// ... your code here
	// Return value
	return $settings;
}, 10, 4 );
</pre>
<h3 id="page_generator_pro_generate_post_args">
						page_generator_pro_generate_post_args
						<code>includes/admin/generate.php::393</code>
					</h3><h4>Overview</h4>
						<p>Filters arguments used for creating or updating a Post when running content generation.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$post_args</td>
							<td>array</td>
							<td>wp_insert_post() / wp_update_post() compatible arguments.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Content Group Settings.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_generate_post_args', function( $post_args, $settings ) {
	// ... your code here
	// Return value
	return $post_args;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_generate_get_keywords_terms">
						page_generator_pro_generate_get_keywords_terms
						<code>includes/admin/generate.php::838</code>
					</h3><h4>Overview</h4>
						<p>Returns an array of keyword and term key / value pairs, before any search or replacement arrays are built.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$keywords_terms</td>
							<td>array</td>
							<td>Keywords and Terms for this Page Generation.</td>
						</tr><tr>
							<td>$method</td>
							<td>string</td>
							<td>Generation Method.</td>
						</tr><tr>
							<td>$index</td>
							<td>int</td>
							<td>Generation Index.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_generate_get_keywords_terms', function( $keywords_terms, $method, $index ) {
	// ... your code here
	// Return value
	return $keywords_terms;
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_generate_replace_keywords_in_array">
						page_generator_pro_generate_replace_keywords_in_array
						<code>includes/admin/generate.php::1015</code>
					</h3><h4>Overview</h4>
						<p>Perform any other keyword replacements or string processing.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$item</td>
							<td>string</td>
							<td>Group Setting String (this can be Post Meta, Custom Fields, Permalink, Title, Content etc).</td>
						</tr><tr>
							<td>$key</td>
							<td>string</td>
							<td>Group Setting Key.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_generate_replace_keywords_in_array', function( $item, $key ) {
	// ... your code here
	// Return value
	return $item;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_generate_set_post_meta_ignored_keys">
						page_generator_pro_generate_set_post_meta_ignored_keys
						<code>includes/admin/generate.php::1176</code>
					</h3><h4>Overview</h4>
						<p>Defines Post Meta Keys in a Content Group to ignore and not copy to generated Posts / Groups.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$ignored_keys</td>
							<td>array</td>
							<td>Ignored Keys (preg_match() compatible regex expressions are supported).</td>
						</tr><tr>
							<td>$post_id</td>
							<td>int</td>
							<td>Generated Post ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$post_args</td>
							<td>array</td>
							<td>wp_insert_post() / wp_update_post() arguments.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_generate_set_post_meta_ignored_keys', function( $ignored_keys, $post_id, $settings, $post_args ) {
	// ... your code here
	// Return value
	return $ignored_keys;
}, 10, 4 );
</pre>
<h3 id="page_generator_pro_generate_set_post_meta_  meta_key">
						page_generator_pro_generate_set_post_meta_  meta_key
						<code>includes/admin/generate.php::1212</code>
					</h3><h4>Overview</h4>
						<p>Filters the Group Metadata for the given Key and Value, immediately before it's saved to the Generated Page.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$meta_value</td>
							<td>mixed</td>
							<td>Meta</td>
						</tr><tr>
							<td>$post_id</td>
							<td>int</td>
							<td>Generated Post ID.</td>
						</tr><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$post_args</td>
							<td>array</td>
							<td>wp_insert_post() / wp_update_post() arguments.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_generate_set_post_meta_  meta_key', function( $meta_value, $post_id, $group_id, $settings, $post_args ) {
	// ... your code here
	// Return value
	return $meta_value;
}, 10, 5 );
</pre>
<h3 id="page_generator_pro_ajax_delete_generated_count_number_of_items">
						page_generator_pro_ajax_delete_generated_count_number_of_items
						<code>includes/admin/ajax.php::70</code>
					</h3><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$limit</td>
							<td>Unknown</td>
							<td>N/A</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_ajax_delete_generated_count_number_of_items', function( $limit ) {
	// ... your code here
	// Return value
	return $limit;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_notices_get_success_notices">
						page_generator_pro_notices_get_success_notices
						<code>includes/admin/notices.php::134</code>
					</h3><h4>Overview</h4>
						<p>Filters the success notices to return.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$success_notices</td>
							<td>array</td>
							<td>Success Notices.</td>
						</tr><tr>
							<td>$notices</td>
							<td>object</td>
							<td>Success and Error Notices.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_notices_get_success_notices', function( $success_notices, $notices ) {
	// ... your code here
	// Return value
	return $success_notices;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_notices_get_warning_notices">
						page_generator_pro_notices_get_warning_notices
						<code>includes/admin/notices.php::205</code>
					</h3><h4>Overview</h4>
						<p>Filters the error notices to return.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$warning_notices</td>
							<td>array</td>
							<td>Warning Notices.</td>
						</tr><tr>
							<td>$notices</td>
							<td>object</td>
							<td>Success, Warning and Error Notices.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_notices_get_warning_notices', function( $warning_notices, $notices ) {
	// ... your code here
	// Return value
	return $warning_notices;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_notices_get_error_notices">
						page_generator_pro_notices_get_error_notices
						<code>includes/admin/notices.php::268</code>
					</h3><h4>Overview</h4>
						<p>Filters the error notices to return.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$error_notices</td>
							<td>array</td>
							<td>Error Notices.</td>
						</tr><tr>
							<td>$notices</td>
							<td>object</td>
							<td>Success and Error Notices.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_notices_get_error_notices', function( $error_notices, $notices ) {
	// ... your code here
	// Return value
	return $error_notices;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_notices_get_notices">
						page_generator_pro_notices_get_notices
						<code>includes/admin/notices.php::325</code>
					</h3><h4>Overview</h4>
						<p>Filters the success and error notices to return.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$notices</td>
							<td>array</td>
							<td>Success and Error Notices.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_notices_get_notices', function( $notices ) {
	// ... your code here
	// Return value
	return $notices;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_notices_save">
						page_generator_pro_notices_save
						<code>includes/admin/notices.php::369</code>
					</h3><h4>Overview</h4>
						<p>Filters the success and error notices to save.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$notices</td>
							<td>array</td>
							<td>Success and Error Notices.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_notices_save', function( $notices ) {
	// ... your code here
	// Return value
	return $notices;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_editor_register_tinymce_plugins">
						page_generator_pro_editor_register_tinymce_plugins
						<code>includes/admin/editor.php::110</code>
					</h3><h4>Overview</h4>
						<p>Defines the TinyMCE Plugins to register</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$plugins</td>
							<td>array</td>
							<td>TinyMCE Plugins.</td>
						</tr><tr>
							<td>$screen</td>
							<td>array</td>
							<td>Screen and Section.</td>
						</tr><tr>
							<td>$shortcodes</td>
							<td>array</td>
							<td>Shortcodes.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_editor_register_tinymce_plugins', function( $plugins, $screen, $shortcodes ) {
	// ... your code here
	// Return value
	return $plugins;
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_editor_get_tinymce_plugins">
						page_generator_pro_editor_get_tinymce_plugins
						<code>includes/admin/editor.php::146</code>
					</h3><h4>Overview</h4>
						<p>Returns an array of TinyMCE Plugins that aren't shortcodes/blocks, such as Autocomplete</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$plugins</td>
							<td>array</td>
							<td>TinyMCE Plugins</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_editor_get_tinymce_plugins', function( $plugins ) {
	// ... your code here
	// Return value
	return $plugins;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_editor_should_register_tinymce_plugins">
						page_generator_pro_editor_should_register_tinymce_plugins
						<code>includes/admin/editor.php::180</code>
					</h3><h4>Overview</h4>
						<p>Set a flag to denote whether we should register TinyMCE Plugins</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$should_register_tinymce_plugins</td>
							<td>bool</td>
							<td>Should Register TinyMCE Plugins.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_editor_should_register_tinymce_plugins', function( $should_register_tinymce_plugins ) {
	// ... your code here
	// Return value
	return $should_register_tinymce_plugins;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_get_defaults">
						page_generator_pro_groups_get_defaults
						<code>includes/admin/groups.php::222</code>
					</h3><h4>Overview</h4>
						<p>Defines the default settings structure when a new Content Group is created.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$defaults</td>
							<td>array</td>
							<td>Default Settings.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_get_defaults', function( $defaults ) {
	// ... your code here
	// Return value
	return $defaults;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_get_settings_remove_orphaned_settings">
						page_generator_pro_groups_get_settings_remove_orphaned_settings
						<code>includes/admin/groups.php::294</code>
					</h3><h4>Overview</h4>
						<p>Remove any orphaned data, such as Page Builder, SEO or Schema metadata, from the Group before generation is run, that might remain due to changing Page Builder, SEO or Schema Plugin.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_get_settings_remove_orphaned_settings', function( $settings ) {
	// ... your code here
	// Return value
	return $settings;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_get_post_meta_ignored_keys">
						page_generator_pro_groups_get_post_meta_ignored_keys
						<code>includes/admin/groups.php::342</code>
					</h3><h4>Overview</h4>
						<p>Defines Post Meta Keys in a Content Group to ignore and not copy to generated Posts / Groups.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$ignored_keys</td>
							<td>array</td>
							<td>Ignored Keys.</td>
						</tr><tr>
							<td>$id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_get_post_meta_ignored_keys', function( $ignored_keys, $id ) {
	// ... your code here
	// Return value
	return $ignored_keys;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_groups_get_post_meta_  meta_key">
						page_generator_pro_groups_get_post_meta_  meta_key
						<code>includes/admin/groups.php::363</code>
					</h3><h4>Overview</h4>
						<p>Filters the Group Metadata for the given Key and Value</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$value</td>
							<td>mixed</td>
							<td>Meta Value.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_get_post_meta_  meta_key', function( $value ) {
	// ... your code here
	// Return value
	return $value;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_get_post_meta">
						page_generator_pro_groups_get_post_meta
						<code>includes/admin/groups.php::377</code>
					</h3><h4>Overview</h4>
						<p>Filters the Group Metadata to return.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$meta</td>
							<td>array</td>
							<td>Metadata.</td>
						</tr><tr>
							<td>$id</td>
							<td>int</td>
							<td>Group ID</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_get_post_meta', function( $meta, $id ) {
	// ... your code here
	// Return value
	return $meta;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_groups_run_row_actions">
						page_generator_pro_groups_run_row_actions
						<code>includes/admin/groups.php::525</code>
					</h3><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$result</td>
							<td>Unknown</td>
							<td>N/A</td>
						</tr><tr>
							<td>$action</td>
							<td>Unknown</td>
							<td>N/A</td>
						</tr><tr>
							<td>$id</td>
							<td>Unknown</td>
							<td>N/A</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_run_row_actions', function( $result, $action, $id ) {
	// ... your code here
	// Return value
	return $result;
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_groups_run_row_actions_success_message">
						page_generator_pro_groups_run_row_actions_success_message
						<code>includes/admin/groups.php::589</code>
					</h3><h4>Overview</h4>
						<p>Define an optional success message based on the result of a custom row action on a Group.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$message</td>
							<td>mixed</td>
							<td>Success Message (false | string).</td>
						</tr><tr>
							<td>$result</td>
							<td>mixed</td>
							<td>Result (WP_Error | bool | string).</td>
						</tr><tr>
							<td>$action</td>
							<td>string</td>
							<td>Action.</td>
						</tr><tr>
							<td>$id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_run_row_actions_success_message', function( $message, $result, $action, $id ) {
	// ... your code here
	// Return value
	return $message;
}, 10, 4 );
</pre>
<h3 id="page_generator_pro_groups_validate">
						page_generator_pro_groups_validate
						<code>includes/admin/groups.php::768</code>
					</h3><h4>Overview</h4>
						<p>Performs several validations on the given Group Settings, to ensure that content generation will function successfully.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$rest</td>
							<td>mixed</td>
							<td>Validation Result (WP_Error | bool).</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_validate', function( $result, $settings, $id ) {
	// ... your code here
	// Return value
	return $result;
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_groups_get_group_statuses">
						page_generator_pro_groups_get_group_statuses
						<code>includes/admin/groups.php::800</code>
					</h3><h4>Overview</h4>
						<p>Defines available Post Statuses for generated content.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$statuses</td>
							<td>array</td>
							<td>Statuses.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_get_group_statuses', function( $statuses ) {
	// ... your code here
	// Return value
	return $statuses;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_generates_content">
						page_generator_pro_groups_generates_content
						<code>includes/admin/groups.php::962</code>
					</h3><h4>Overview</h4>
						<p>Determine if the given Content Group is eligible to generate content</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$can_generate_content</td>
							<td>bool</td>
							<td>Can Generate Content.</td>
						</tr><tr>
							<td>$id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_generates_content', function( $can_generate_content, $id ) {
	// ... your code here
	// Return value
	return $can_generate_content;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_admin_admin_menu_minimum_capability">
						page_generator_pro_admin_admin_menu_minimum_capability
						<code>includes/admin/admin.php::303</code>
					</h3><h4>Overview</h4>
						<p>Defines the minimum capability required to access the Media Library Organizer Menu and Sub Menus</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$capability</td>
							<td>string</td>
							<td>Minimum Required Capability</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_admin_admin_menu_minimum_capability', function( $minimum_capability ) {
	// ... your code here
	// Return value
	return $minimum_capability;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_keywords_save_  source">
						page_generator_pro_keywords_save_  source
						<code>includes/admin/admin.php::824</code>
					</h3><h4>Overview</h4>
						<p>Define the Keyword properties (data, delimiter and columns) for the given Source before saving the Keyword to the database.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$keyword</td>
							<td>array</td>
							<td>Keyword arguments.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_keywords_save_  source', function( $keyword ) {
	// ... your code here
	// Return value
	return $keyword;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_ui_remove_meta_boxes">
						page_generator_pro_groups_ui_remove_meta_boxes
						<code>includes/admin/groups-ui.php::301</code>
					</h3><h4>Overview</h4>
						<p>Filters the metaboxes to remove from the Content Groups Screen.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$remove_meta_boxes</td>
							<td>array</td>
							<td>Meta Boxes to Remove.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_ui_remove_meta_boxes', function( $remove_meta_boxes ) {
	// ... your code here
	// Return value
	return $remove_meta_boxes;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_groups_ui_get_titles_and_messages">
						page_generator_pro_groups_ui_get_titles_and_messages
						<code>includes/admin/groups-ui.php::728</code>
					</h3><h4>Overview</h4>
						<p>Filters the localization title and message strings used for Generation.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$localization</td>
							<td>array</td>
							<td>Titles and Messages.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_groups_ui_get_titles_and_messages', function( $localization ) {
	// ... your code here
	// Return value
	return $localization;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_posttype_register_post_types">
						page_generator_pro_posttype_register_post_types
						<code>includes/global/posttype.php::116</code>
					</h3><h4>Overview</h4>
						<p>Filter the arguments for registering the Content Groups Post Type</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>register_post_type()</td>
							<td>array $args</td>
							<td>compatible</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_posttype_register_post_types', function( $args ) {
	// ... your code here
	// Return value
	return $args;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_posttype_supports">
						page_generator_pro_posttype_supports
						<code>includes/global/posttype.php::199</code>
					</h3><h4>Overview</h4>
						<p>Define the supported features for Content Groups</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$supports</td>
							<td>array</td>
							<td>Supported Featured.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_posttype_supports', function( $supports ) {
	// ... your code here
	// Return value
	return $supports;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_get_settings">
						page_generator_pro_get_settings
						<code>includes/global/settings.php::102</code>
					</h3><h4>Overview</h4>
						<p>Filter the Settings before returning.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Settings.</td>
						</tr><tr>
							<td>$type</td>
							<td>string</td>
							<td>Setting Type.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_get_settings', function( $settings, $type ) {
	// ... your code here
	// Return value
	return $settings;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_update_setting">
						page_generator_pro_update_setting
						<code>includes/global/settings.php::137</code>
					</h3><h4>Overview</h4>
						<p>Filter a specific setting before updating.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Settings.</td>
						</tr><tr>
							<td>$type</td>
							<td>string</td>
							<td>Setting Type.</td>
						</tr><tr>
							<td>$key</td>
							<td>string</td>
							<td>Setting key.</td>
						</tr><tr>
							<td>$value</td>
							<td>string</td>
							<td>Setting Value.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_update_setting', function( $settings, $type, $key, $value ) {
	// ... your code here
	// Return value
	return $settings;
}, 10, 4 );
</pre>
<h3 id="page_generator_pro_update_settings">
						page_generator_pro_update_settings
						<code>includes/global/settings.php::168</code>
					</h3><h4>Overview</h4>
						<p>Filter the Settings before updating.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Settings.</td>
						</tr><tr>
							<td>$type</td>
							<td>string</td>
							<td>Setting Type.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_update_settings', function( $settings, $type ) {
	// ... your code here
	// Return value
	return $settings;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_screen_get_current_screen_before">
						page_generator_pro_screen_get_current_screen_before
						<code>includes/global/screen.php::80</code>
					</h3><h4>Overview</h4>
						<p>Returns an array comprising of a simplified screen and section that we are viewing within the WordPress Administration interface, before we've performed any checks. This is useful for frontend Page Builders and AJAX requests where get_current_screen() below won't return anything.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$result</td>
							<td>array</td>
							<td>Screen and Section.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_screen_get_current_screen_before', function( $result ) {
	// ... your code here
	// Return value
	return $result;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_screen_get_current_screen">
						page_generator_pro_screen_get_current_screen
						<code>includes/global/screen.php::324</code>
					</h3><h4>Overview</h4>
						<p>Returns an array comprising of a simplified screen and section that we are viewing within the WordPress Administration interface.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$result</td>
							<td>array</td>
							<td>Screen and Section.</td>
						</tr><tr>
							<td>$screen_id</td>
							<td>string</td>
							<td>Screen.</td>
						</tr><tr>
							<td>$screen</td>
							<td>WP_Screen</td>
							<td>WordPress Screen object.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_screen_get_current_screen', function( $result, $screen_id, $screen ) {
	// ... your code here
	// Return value
	return $result;
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_common_get_generation_systems">
						page_generator_pro_common_get_generation_systems
						<code>includes/global/common.php::63</code>
					</h3><h4>Overview</h4>
						<p>Defines available Generation Systems</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$systems</td>
							<td>array</td>
							<td>Generation Systems.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_generation_systems', function( $systems ) {
	// ... your code here
	// Return value
	return $systems;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_authors">
						page_generator_pro_common_get_authors
						<code>includes/global/common.php::93</code>
					</h3><h4>Overview</h4>
						<p>Defines available authors for the Author dropdown on the Generate Content screen.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$authors</td>
							<td>array</td>
							<td>Authors.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_authors', function( $authors ) {
	// ... your code here
	// Return value
	return $authors;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_post_types">
						page_generator_pro_common_get_post_types
						<code>includes/global/common.php::132</code>
					</h3><h4>Overview</h4>
						<p>Defines the available public Post Type Objects that content can be generated for.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$types</td>
							<td>array</td>
							<td>Post Types.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_post_types', function( $types ) {
	// ... your code here
	// Return value
	return $types;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_excluded_post_types">
						page_generator_pro_common_get_excluded_post_types
						<code>includes/global/common.php::253</code>
					</h3><h4>Overview</h4>
						<p>Defines the Post Type Objects that content cannot be generated for.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$types</td>
							<td>array</td>
							<td>Post Types.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_excluded_post_types', function( $types ) {
	// ... your code here
	// Return value
	return $types;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_post_type_templates">
						page_generator_pro_common_get_post_type_templates
						<code>includes/global/common.php::307</code>
					</h3><h4>Overview</h4>
						<p>Defines available Theme Templates for each Post Type that can have content generated for it.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$templates</td>
							<td>array</td>
							<td>Templates by Post Type.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_post_type_templates', function( $templates ) {
	// ... your code here
	// Return value
	return $templates;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_post_statuses">
						page_generator_pro_common_get_post_statuses
						<code>includes/global/common.php::337</code>
					</h3><h4>Overview</h4>
						<p>Defines available Post Statuses for generated content.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$statuses</td>
							<td>array</td>
							<td>Statuses.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_post_statuses', function( $statuses ) {
	// ... your code here
	// Return value
	return $statuses;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_autocomplete_configuration">
						page_generator_pro_common_get_autocomplete_configuration
						<code>includes/global/common.php::401</code>
					</h3><h4>Overview</h4>
						<p>Define autocompleters to use across Content Groups, Term Group and TinyMCE                              If false, autocomplete fields are for Related Links shortcode on a Page or Post.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$autocomplete_configuration</td>
							<td>array</td>
							<td>Autocomplete Configuration.</td>
						</tr><tr>
							<td>$is_group</td>
							<td>bool</td>
							<td>If true, autocomplete fields are for a Content or Term Group.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_autocomplete_configuration', function( $autocomplete_configuration, $is_group ) {
	// ... your code here
	// Return value
	return $autocomplete_configuration;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_common_get_autocomplete_enabled_fields">
						page_generator_pro_common_get_autocomplete_enabled_fields
						<code>includes/global/common.php::457</code>
					</h3><h4>Overview</h4>
						<p>Defines an array of Javascript DOM selectors to enable the keyword autocomplete functionality on.                              If false, autocomplete fields are for Related Links shortcode on a Page or Post.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$fields</td>
							<td>array</td>
							<td>Supported Fields.</td>
						</tr><tr>
							<td>$is_group</td>
							<td>bool</td>
							<td>If true, autocomplete fields are for a Content or Term Group.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_autocomplete_enabled_fields', function( $fields, $is_group ) {
	// ... your code here
	// Return value
	return $fields;
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_common_get_selectize_enabled_fields">
						page_generator_pro_common_get_selectize_enabled_fields
						<code>includes/global/common.php::510</code>
					</h3><h4>Overview</h4>
						<p>Defines an array of Javascript DOM selectors to enable the selectize functionality on.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$fields</td>
							<td>array</td>
							<td>Supported Fields</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_selectize_enabled_fields', function( $fields ) {
	// ... your code here
	// Return value
	return $fields;
}, 10, 1 );
</pre>
<h3 id="page_generator_pro_common_get_capabilities_to_disable_on_group_content_generation">
						page_generator_pro_common_get_capabilities_to_disable_on_group_content_generation
						<code>includes/global/common.php::561</code>
					</h3><h4>Overview</h4>
						<p>Defines Role Capabilities that should be disabled when a Content Group is Generating Content.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$capabilities</td>
							<td>array</td>
							<td>Capabilities.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
add_filter( 'page_generator_pro_common_get_capabilities_to_disable_on_group_content_generation', function( $capabilities ) {
	// ... your code here
	// Return value
	return $capabilities;
}, 10, 1 );
</pre>
<h1>Actions</h1><table>
				<thead>
					<tr>
						<th>File</th>
						<th>Filter Name</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody><tr>
						<td colspan="3">../includes/admin/generate.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_started"><code>page_generator_pro_generate_content_started</code></a></td>
						<td>Run any actions before an individual Page, Post or Custom Post Type is generated</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_before_insert_update_post"><code>page_generator_pro_generate_content_before_insert_update_post</code></a></td>
						<td>Run any actions immediately before an individual Page, Post or Custom Post Type is generated.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_after_insert_update_post"><code>page_generator_pro_generate_content_after_insert_update_post</code></a></td>
						<td>Run any actions immediately after an individual Page, Post or Custom Post Type is generated, but before its Page Template, Featured Image, Custom Fields, Post Meta, Geodata or Taxonomy Terms have been assigned.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_finished"><code>page_generator_pro_generate_content_finished</code></a></td>
						<td>Run any actions after an individual Page, Post or Custom Post Type is generated successfully.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_set_page_template"><code>page_generator_pro_generate_set_page_template</code></a></td>
						<td>Action to perform any further steps with the Content Group's Page Template after the Page Template has been copied from the Content Group to the Generated Content.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_set_post_meta"><code>page_generator_pro_generate_set_post_meta</code></a></td>
						<td>Action to perform any further steps with the Content Group's Post Meta, after all Post Meta has been copied  from the Content Group to the Generated Content.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_trash_content_finished"><code>page_generator_pro_generate_trash_content_finished</code></a></td>
						<td>Run any actions after all generated content for a given Content Group has been trashd.</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_delete_content_finished"><code>page_generator_pro_generate_delete_content_finished</code></a></td>
						<td>Run any actions after all generated content for a given Content Group has been deleted.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/ajax.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_after"><code>page_generator_pro_generate_content_after</code></a></td>
						<td>Runs any actions after Generate Content has finished.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/notices.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_notices_delete_notices"><code>page_generator_pro_notices_delete_notices</code></a></td>
						<td></td>
					</tr><tr>
						<td colspan="3">../includes/admin/groups.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_save"><code>page_generator_pro_groups_save</code></a></td>
						<td>Save data to Group Post's Meta</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_after"><code>page_generator_pro_generate_content_after</code></a></td>
						<td>Runs any actions once Generate Content has finished.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/admin.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_admin_admin_scripts_css"><code>page_generator_pro_admin_admin_scripts_css</code></a></td>
						<td>Enqueues CSS and JS</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_generate_content_before"><code>page_generator_pro_generate_content_before</code></a></td>
						<td>Runs any actions before Generate Content has started.</td>
					</tr><tr>
						<td colspan="3">../includes/admin/groups-ui.php</td>
					</tr><tr>
						<td>&nbsp;</td>
						<td><a href="#page_generator_pro_groups_ui_add_meta_boxes"><code>page_generator_pro_groups_ui_add_meta_boxes</code></a></td>
						<td>Action hook after all meta boxes are added for the Content Group UI</td>
					</tr>
					</tbody>
				</table><h3 id="page_generator_pro_generate_content_started">
						page_generator_pro_generate_content_started
						<code>includes/admin/generate.php::280</code>
					</h3><h4>Overview</h4>
						<p>Run any actions before an individual Page, Post or Custom Post Type is generated</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$index</td>
							<td>int</td>
							<td>Keyword Index.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_started', function( $group_id, $settings, $index, $test_mode ) {
	// ... your code here
}, 10, 4 );
</pre>
<h3 id="page_generator_pro_generate_content_before_insert_update_post">
						page_generator_pro_generate_content_before_insert_update_post
						<code>includes/admin/generate.php::405</code>
					</h3><h4>Overview</h4>
						<p>Run any actions immediately before an individual Page, Post or Custom Post Type is generated.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$index</td>
							<td>int</td>
							<td>Keyword Index.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_before_insert_update_post', function( $group_id, $settings, $index, $test_mode ) {
	// ... your code here
}, 10, 4 );
</pre>
<h3 id="page_generator_pro_generate_content_after_insert_update_post">
						page_generator_pro_generate_content_after_insert_update_post
						<code>includes/admin/generate.php::471</code>
					</h3><h4>Overview</h4>
						<p>Run any actions immediately after an individual Page, Post or Custom Post Type is generated, but before its Page Template, Featured Image, Custom Fields, Post Meta, Geodata or Taxonomy Terms have been assigned.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$post_id</td>
							<td>int</td>
							<td>Post ID.</td>
						</tr><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$index</td>
							<td>int</td>
							<td>Keyword Index.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_after_insert_update_post', function( $post_id, $group_id, $settings, $index, $test_mode ) {
	// ... your code here
}, 10, 5 );
</pre>
<h3 id="page_generator_pro_generate_content_finished">
						page_generator_pro_generate_content_finished
						<code>includes/admin/generate.php::506</code>
					</h3><h4>Overview</h4>
						<p>Run any actions after an individual Page, Post or Custom Post Type is generated successfully.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$post_id</td>
							<td>int</td>
							<td>Generated Post ID.</td>
						</tr><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$index</td>
							<td>int</td>
							<td>Keyword Index.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_finished', function( $post_id, $group_id, $settings, $index, $test_mode ) {
	// ... your code here
}, 10, 5 );
</pre>
<h3 id="page_generator_pro_generate_set_page_template">
						page_generator_pro_generate_set_page_template
						<code>includes/admin/generate.php::1136</code>
					</h3><h4>Overview</h4>
						<p>Action to perform any further steps with the Content Group's Page Template after the Page Template has been copied from the Content Group to the Generated Content.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$post_id</td>
							<td>int</td>
							<td>Generated Page ID.</td>
						</tr><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$post_args</td>
							<td>array</td>
							<td>wp_insert_post() / wp_update_post() arguments.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_set_page_template', function( $post_id, $settings, $post_args ) {
	// ... your code here
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_generate_set_post_meta">
						page_generator_pro_generate_set_post_meta
						<code>includes/admin/generate.php::1231</code>
					</h3><h4>Overview</h4>
						<p>Action to perform any further steps with the Content Group's Post Meta, after all Post Meta has been copied  from the Content Group to the Generated Content.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$post_id</td>
							<td>int</td>
							<td>Generated Page ID.</td>
						</tr><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$post_meta</td>
							<td>array</td>
							<td>Group Post Meta.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$post_args</td>
							<td>array</td>
							<td>wp_insert_post() / wp_update_post() arguments.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_set_post_meta', function( $post_id, $group_id, $settings['post_meta'], $settings, $post_args ) {
	// ... your code here
}, 10, 5 );
</pre>
<h3 id="page_generator_pro_generate_trash_content_finished">
						page_generator_pro_generate_trash_content_finished
						<code>includes/admin/generate.php::1281</code>
					</h3><h4>Overview</h4>
						<p>Run any actions after all generated content for a given Content Group has been trashd.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$post_ids</td>
							<td>int</td>
							<td>Generated Post IDs that were deleted.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_trash_content_finished', function( $group_id, $post_ids ) {
	// ... your code here
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_generate_delete_content_finished">
						page_generator_pro_generate_delete_content_finished
						<code>includes/admin/generate.php::1332</code>
					</h3><h4>Overview</h4>
						<p>Run any actions after all generated content for a given Content Group has been deleted.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$post_ids</td>
							<td>int</td>
							<td>Generated Post IDs that were deleted.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_delete_content_finished', function( $group_id, $post_ids ) {
	// ... your code here
}, 10, 2 );
</pre>
<h3 id="page_generator_pro_generate_content_after">
						page_generator_pro_generate_content_after
						<code>includes/admin/ajax.php::235</code>
					</h3><h4>Overview</h4>
						<p>Runs any actions after Generate Content has finished.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr><tr>
							<td>$system</td>
							<td>string</td>
							<td>System.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_after', function( $group['group_id'], false, 'browser' ) {
	// ... your code here
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_notices_delete_notices">
						page_generator_pro_notices_delete_notices
						<code>includes/admin/notices.php::394</code>
					</h3><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_notices_delete_notices', function(  ) {
	// ... your code here
}, 10, 0 );
</pre>
<h3 id="page_generator_pro_groups_save">
						page_generator_pro_groups_save
						<code>includes/admin/groups.php::675</code>
					</h3><h4>Overview</h4>
						<p>Save data to Group Post's Meta</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$settings</td>
							<td>array</td>
							<td>Group Settings.</td>
						</tr><tr>
							<td>$_REQUEST</td>
							<td>array</td>
							<td>Request data.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_groups_save', function( $group_id, $settings, $_REQUEST ) {
	// ... your code here
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_generate_content_after">
						page_generator_pro_generate_content_after
						<code>includes/admin/groups.php::884</code>
					</h3><h4>Overview</h4>
						<p>Runs any actions once Generate Content has finished.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr><tr>
							<td>$system</td>
							<td>string</td>
							<td>System.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_after', function( $id, true, 'browser' ) {
	// ... your code here
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_admin_admin_scripts_css">
						page_generator_pro_admin_admin_scripts_css
						<code>includes/admin/admin.php::267</code>
					</h3><h4>Overview</h4>
						<p>Enqueues CSS and JS</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$screen</td>
							<td>array</td>
							<td>Screen (screen, section).</td>
						</tr><tr>
							<td>$post</td>
							<td>WP_Post</td>
							<td>WordPress Post.</td>
						</tr><tr>
							<td>$minified</td>
							<td>bool</td>
							<td>Whether to load minified JS.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_admin_admin_scripts_css', function( $screen, $post, $minified ) {
	// ... your code here
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_generate_content_before">
						page_generator_pro_generate_content_before
						<code>includes/admin/admin.php::891</code>
					</h3><h4>Overview</h4>
						<p>Runs any actions before Generate Content has started.</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$group_id</td>
							<td>int</td>
							<td>Group ID.</td>
						</tr><tr>
							<td>$test_mode</td>
							<td>bool</td>
							<td>Test Mode.</td>
						</tr><tr>
							<td>$system</td>
							<td>string</td>
							<td>System.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_generate_content_before', function( $id, false, 'browser' ) {
	// ... your code here
}, 10, 3 );
</pre>
<h3 id="page_generator_pro_groups_ui_add_meta_boxes">
						page_generator_pro_groups_ui_add_meta_boxes
						<code>includes/admin/groups-ui.php::260</code>
					</h3><h4>Overview</h4>
						<p>Action hook after all meta boxes are added for the Content Group UI</p><h4>Parameters</h4>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Type</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody><tr>
							<td>$post_type_instance</td>
							<td>Page_Generator_Pro_PostType</td>
							<td>Post Type Instance.</td>
						</tr><tr>
							<td>$is_gutenberg_page</td>
							<td>bool</td>
							<td>If Gutenberg Editor is used on this Content Group.</td>
						</tr>
						</tbody>
					</table><h4>Usage</h4>
<pre>
do_action( 'page_generator_pro_groups_ui_add_meta_boxes', function( $base->get_class( 'post_type' ) {
	// ... your code here
}, 10, 1 );
</pre>
