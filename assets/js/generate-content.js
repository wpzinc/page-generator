jQuery( document ).ready(function( $ ) {

	/**
	 * Content Groups: Row Actions
	 * Content Groups: Actions Meta Box
	 */
	$( 'body.page-generator-pro td.has-row-actions span a, body.page-generator-pro td.generated_count span a, body.page-generator-pro td.status span a, #page-generator-pro-actions span a, #page-generator-pro-actions-bottom span a, #page-generator-pro-actions-gutenberg-bottom span a' ).click( function( e ) {

		var action = $( this ).parent( 'span' ).attr( 'class' ),
			result = true,
			group_id = page_generator_pro_get_url_param( $( this ).attr( 'href' ), 'id' ),
			type = page_generator_pro_get_url_param( $( this ).attr( 'href' ), 'type' );

		// Check if a confirmation message exists for display
		var confirmation_message = page_generator_pro_generate_content.messages[ action + '_confirm' ];

		// Let the request through if we're not asking for a confirmation
		if ( typeof confirmation_message === 'undefined' ) {
			return true;
		}

		// Show confirmation dialog
		result = confirm( confirmation_message );

		// If the user cancels, bail
		if ( ! result ) {
			e.preventDefault();
			return false;
		}

		// Depending on the action, either use AJAX or let the request go through
		switch ( action ) {

			/**
			 * Test
			 */
			case 'test':
				// AJAX
				e.preventDefault();
				page_generator_pro_generate_content_test( group_id, type );
				break;

			/**
			 * Generate
			 */
			case 'generate':
				// Allow the request to go through
				break;

			/**
			 * Trash
			 */
			case 'trash_generated_content':
				// AJAX
				e.preventDefault();
				page_generator_pro_generate_content_trash_generated_content( group_id, type, 0, $( this ).data( 'limit' ), $( this ).data( 'total' ) );
				break;

			/**
			 * Delete
			 */
			case 'delete_generated_content':
				// AJAX
				e.preventDefault();
				page_generator_pro_generate_content_delete_generated_content( group_id, type, 0, $( this ).data( 'limit' ), $( this ).data( 'total' ) );
				break;

		}

	} );

	/**
	 * Content Groups: Row Actions: Close
	 * Content Groups: Actions Meta Box: Gutenberg: Close
	 */
	$( 'body' ).on( 'click', '#page-generator-pro-progress button.close', function( e ) {

		e.preventDefault();

		page_generator_pro_hide_overlay_and_progress();

		return false;

	} );

	/**
	 * Generate via Browser: Submit
	 * Generate via Server: Submit
	 */
	$( 'body.post-type-page-generator-pro form input[type=submit], body.taxonomy-page-generator-tax form input[type=submit]' ).click( function( e ) {

		// Prevent WordPress from throwing a dialog warning that changes will be lost
		$( window ).off( 'beforeunload.edit-post' );

		var action = $( this ).attr( 'name' ),
			result = true;

		// Check if a confirmation message exists for display
		var confirmation_message = page_generator_pro_generate_content.messages[ action + '_confirm' ];

		// Let the request through if we're not asking for a confirmation
		if ( typeof confirmation_message === 'undefined' ) {
			return true;
		}

		// Show confirmation dialog
		result = confirm( confirmation_message );

		if ( ! result ) {
			e.preventDefault();
			return false;
		}

	} );

} );

/**
 * Returns the value of the given URL parameter
 *
 * @since 	1.8.7
 *
 * @param 	string 	url 	URL
 * @param 	string 	name 	Parameter Name
 * @return 	string 			Parameter Value
 */
function page_generator_pro_get_url_param( url, name ) {

    name = name.replace( /[\[]/, '\\[' ).replace (/[\]]/, '\\]' );
    var regex = new RegExp( '[\\?&]' + name + '=([^&#]*)' );
    var results = regex.exec( url );
    return results === null ? '' : decodeURIComponent( results[1].replace( /\+/g, ' ' ) );

}

/**
 * Performs an asynchronous request to generate a Test Page
 * when the user clicks and confirms the Test Button when editing
 * a Content Group.
 *
 * @since 	1.8.4
 *
 * @param 	int 	group_id 	Group ID
 * @param 	string 	type 		Type (content|term)
 */
function page_generator_pro_generate_content_test( group_id, type ) {

	// Show overlay and progress
	wpzinc_modal_open(
		page_generator_pro_generate_content.titles.test,
		page_generator_pro_generate_content.messages.test
	);

	// Perform AJAX query
	jQuery.ajax( {
        url: 		ajaxurl,
        type: 		'POST',
        async:    	true,
        data: 		{
        	id: 		group_id,
            action: 	'page_generator_pro_generate_' + type, 
            test_mode: 	true,
        },
        error: function( request, error_type, error_message ) {

        	// Show error message and exit
        	return wpzinc_modal_show_error_message( error_message + '<br />' + request.responseText );

        },
        success: function( result ) {

        	if ( ! result.success ) {
        		// Show error message and exit
        		return wpzinc_modal_show_error_message( result.data );
        	}

        	// Build success message
        	message = 'Test Page Generated at: <a href="' + result.data.url + '" rel="noopener" target="_blank">' + result.data.url + '</a>';
        	for ( i = 0; i < result.data.keywords_terms.length; i++ ) {
        		message += '<br />{' + result.data.keywords_terms[ i ] + '}: ' + result.data.keywords_terms[ i ];
        	}
            
    		// Show success message and exit
    		return wpzinc_modal_show_success_message( message );
    	
        }
    } );

}

/**
 * Performs an asynchronous request to Trash Generated Content
 * when the user clicks and confirms the Trash Generated Content Button 
 * when editing a Content Group.
 *
 * @since 	1.8.4
 *
 * @param 	int 	group_id 		Group ID
 * @param 	string 	type 			Type (content|term)
 * @param 	string 	request_count 	Request Count
 * @param 	int 	limit 			Number of Items to Trash in this request
 * @param 	int 	total 			Total Items to Trash
 */
function page_generator_pro_generate_content_trash_generated_content( group_id, type, request_count, limit, total ) {

	// Define item start and end that will be trashed in this request
	// These are used in the UI only, and not sent in the AJAX request
	var start = ( Number( request_count ) * Number( limit ) ) + 1,
		end = ( Number( request_count ) * Number( limit ) ) + Number( limit );

	// If the final item index exceeds the total number of items, set it to the total 
	if ( end > total ) {
		end = total;
	}

	// Show overlay and progress
	wpzinc_modal_open( 
		page_generator_pro_generate_content.titles.trash_generated_content,
		page_generator_pro_generate_content.messages.trash_generated_content + ' ' + start + ' to ' + end + ' of ' + total
	);

	// Perform AJAX query
	jQuery.ajax( {
        url: 		ajaxurl,
        type: 		'POST',
        async:    	true,
        data: 		{
	    	id: 			group_id,
	        action: 		'page_generator_pro_generate_' + type + '_trash_generated_' + type
	    },
        error: function( a, b, c ) {

        	// Show error message and exit
        	return wpzinc_modal_show_error_message( page_generator_pro_generate_content.messages.trash_generated_content_error );

        },
        success: function( result ) {

        	if ( ! result.success ) {
        		// Show error message and exit
        		return wpzinc_modal_show_error_message( result.data );
        	}

        	// If there is a has_more flag, continue the requests
        	if ( result.data.has_more ) {
        		// Run the next request
        		page_generator_pro_generate_content_trash_generated_content( group_id, type, ( request_count + 1 ), limit, total );
        	} else {
        		// No more requests to be made

        		// Determine if Trash and Delete are within a div.wpzinc-option
        		// If so, we're editing a Content Group and will need to delete div.wpzinc-option as it will be blank after
        		// the buttons are removed
        		if ( jQuery( 'div.wpzinc-option div.full span.trash_generated_content' ).length > 0 ) {
        			jQuery( 'span.trash_generated_content' ).closest( 'div.wpzinc-option' ).remove();
        		} else {
        			// Hide View, Trash and Delete Links in WP_List_Table
	        		jQuery( 'span.generated_count span.count[data-group-id="' + group_id + '"]' ).text( '0' );
	        		jQuery( 'span.view a[data-group-id="' + group_id + '"]' ).remove();
	        		jQuery( 'span.trash_generated_content a[data-group-id="' + group_id + '"]' ).remove();
					jQuery( 'span.delete_generated_content a[data-group-id="' + group_id + '"]' ).remove();

					// Reset Generated Items Count
					jQuery( 'span.view a[data-group-id="' + group_id + '"]' ).remove();
				}

        		// Show success message and exit
        		return wpzinc_modal_show_success_message_and_exit( 
        			page_generator_pro_generate_content.messages.trash_generated_content_success
        		);
        	}

        }
    } );

}


/**
 * Performs an asynchronous request to Delete Generated Content
 * when the user clicks and confirms the Delete Generated Content Button 
 * when editing a Content Group.
 *
 * @since 	1.8.4
 *
 * @param 	int 	group_id 		Group ID
 * @param 	string 	type 			Type (content|term)
 * @param 	string 	request_count 	Request Count
 * @param 	int 	limit 			Number of Items to Delete in this request
 * @param 	int 	total 			Total Items to Delete
 */
function page_generator_pro_generate_content_delete_generated_content( group_id, type, request_count, limit, total ) {

	// Define item start and end that will be deleted in this request
	// These are used in the UI only, and not sent in the AJAX request
	var start = ( Number( request_count ) * Number( limit ) ) + 1,
		end = Number( start ) + Number( limit );

	// If the final item index exceeds the total number of items, set it to the total 
	if ( end > total ) {
		end = total;
	}

	// Show overlay and progress
	wpzinc_modal_open( 
		page_generator_pro_generate_content.titles.delete_generated_content,
		page_generator_pro_generate_content.messages.delete_generated_content + ' ' + start + ' to ' + end + ' of ' + total
	);

	// Perform AJAX query
	jQuery.ajax( {
        url: 		ajaxurl,
        type: 		'POST',
        async:    	true,
        data: 		{
	    	id: 			group_id,
	        action: 		'page_generator_pro_generate_' + type + '_delete_generated_' + type
	    },
        error: function( a, b, c ) {

        	// Show error message and exit
        	return wpzinc_modal_show_error_message( page_generator_pro_generate_content.messages.delete_generated_content_error );

        },
        success: function( result ) {

        	if ( ! result.success ) {
        		// Show error message and exit
        		return wpzinc_modal_show_error_message( result.data );
        	}

        	// If there is a has_more flag, continue the requests
        	if ( result.data.has_more ) {
        		// Run the next request
        		page_generator_pro_generate_content_delete_generated_content( group_id, type, ( request_count + 1 ), limit, total );
        	} else {
        		// No more requests to be made

        		// Determine if Trash and Delete are within a div.wpzinc-option
        		// If so, we're editing a Content Group and will need to delete div.wpzinc-option as it will be blank after
        		// the buttons are removed
        		if ( jQuery( 'div.wpzinc-option div.full span.delete_generated_content' ).length > 0 ) {
        			jQuery( 'span.delete_generated_content' ).closest( 'div.wpzinc-option' ).remove();
        		} else {
        			// Hide View, Trash and Delete Links in WP_List_Table
	        		jQuery( 'span.generated_count span.count[data-group-id="' + group_id + '"]' ).text( '0' );
	        		jQuery( 'span.last_index_generated span.count[data-group-id="' + group_id + '"]' ).text( '0' );
	        		jQuery( 'span.view a[data-group-id="' + group_id + '"]' ).remove();
	        		jQuery( 'span.trash_generated_content a[data-group-id="' + group_id + '"]' ).remove();
					jQuery( 'span.delete_generated_content a[data-group-id="' + group_id + '"]' ).remove();

					// Reset Generated Items Count
					jQuery( 'span.view a[data-group-id="' + group_id + '"]' ).remove();
				}

        		// Show success message and exit
        		return wpzinc_modal_show_success_message_and_exit( 
        			page_generator_pro_generate_content.messages.delete_generated_content_success
        		);
        	}

        }
    } );

}