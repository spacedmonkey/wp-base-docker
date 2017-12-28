<?php
wp_die( __( 'Database Error, please try again.' ) );

if ( define( 'ADMIN_EMAIL' ) && function_exists( 'wp_mail' ) ) {
	wp_mail( ADMIN_EMAIL, __( 'Database error' ), __( 'Database error at ' ) . date( "d-m-Y" ) );
}