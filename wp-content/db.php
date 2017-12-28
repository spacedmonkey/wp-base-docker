<?php


$db_dropins = [
	WP_PLUGIN_DIR . "/query-monitor/wp-content/db.php",
	WP_DROPIN_DIR . "/ludicrousdb/ludicrousdb.php",
];

foreach ( $db_dropins as $path ) {
	if ( file_exists( $path ) ) {
		require_once $path;
		break;
	}
}