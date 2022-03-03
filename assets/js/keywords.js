jQuery( document ).ready(function( $ ) {

	// Initialize CodeMirror
	if ( $( 'textarea#data' ).length > 0 ) {
		wp.codeEditor.initialize( $( 'textarea#data' ), page_generator_pro_keywords );
	}

} );