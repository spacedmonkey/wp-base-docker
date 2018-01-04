<?php

// do not include the opening php tag

// turn Photon off so we can get the correct image
$photon_removed = '';
if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) { // check that we are, in fact, using Photon in the first place
	$photon_removed = remove_filter( 'image_downsize', array( Jetpack_Photon::instance(), 'filter_image_downsize' ) );
}

// do things with image functions

// turn Photon back on
if ( $photon_removed ) {
	add_filter( 'image_downsize', array( Jetpack_Photon::instance(), 'filter_image_downsize' ), 10, 3 );
}