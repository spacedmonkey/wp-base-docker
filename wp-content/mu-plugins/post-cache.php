<?php

add_filter( 'use_enhanced_post_cache', function ( $return, $wp_query ) {
	if ( ! function_exists( 'ep_elasticpress_enabled' ) ) {
		return $return;
	}

	return ! ep_elasticpress_enabled( $wp_query );
}, 10, 2 );

add_action( 'template_redirect', function () {
	add_action( 'parse_query', function ( &$wp_query ) {
		$wp_query->query_vars['suppress_filters'] = false;
	}, 1 );
} );