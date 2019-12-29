<?php

add_filter( 'mercator.sso.enabled', '__return_false' );
add_filter( 'mercator.sso.multinetwork.enabled', '__return_false' );


require WP_DROPIN_DIR . '/mercator/mercator.php';
require WP_DROPIN_DIR . '/mercator-redirect/redirect.php';

if ( defined( 'COOKIE_DOMAIN' ) ) {
	wp_die( 'The constant "COOKIE_DOMAIN" is defined (probably in wp-config.php). Please remove or comment out that define() line.' );
}

$dm_domain = $_SERVER['HTTP_HOST'];
define( 'COOKIE_DOMAIN', $dm_domain );

add_filter( 'mercator.redirect.enabled', '__return_true' );
add_filter( 'mercator.redirect.admin.enabled', '__return_true' );
add_filter( 'mercator.redirect.status.code', function () {
	return 302;
} );
add_filter( 'pre_site_option_ms_files_rewriting', '__return_zero' );

add_action( 'wpmu_new_blog', function ( $blog_id, $user_id, $domain ) {
	Mercator\Mapping::create( $blog_id, $domain, true );
}, 10, 3 );

function wpmu_no_site( $domain ) {
	$message = sprintf( 'Service unavailable for %s', $domain );
	$title   = 'Service unavailable';
	$args    = array( 'response' => 503 );
	wp_die( $message, $title, $args );
}


add_action( 'ms_site_not_found', function ( $current_site, $domain ) {
	wpmu_no_site( $domain );
}, 10, 2 );

add_action( 'ms_network_not_found', function ( $domain ) {
	wpmu_no_site( $domain );
}, 10, 1 );
