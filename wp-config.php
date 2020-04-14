<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/** Add in local settings **/
$local_config = __DIR__ . '/local-config.php';
if ( is_readable( $local_config ) ) {
	require_once $local_config;
}

define( 'WP_ENV', $_ENV['WP_ENV'] ?: 'dev' );

/** The name of the database for WordPress */
define( 'DB_NAME', $_ENV["WP_DB_NAME"] );

/** MySQL database username */
define( 'DB_USER', $_ENV["WP_DB_USER"] );

/** MySQL database password */
define( 'DB_PASSWORD', $_ENV["WP_DB_PASSWORD"] );

/** MySQL hostname */
define( 'DB_HOST', $_ENV["WP_DB_HOST"] );

// Setup DB Slave
if ( isset( $_ENV["DB_SLAVE_HOST"] ) ) {
	define( 'DB_SLAVE_HOST', $_ENV["DB_SLAVE_HOST"] );
}

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', 'utf8mb4_unicode_520_ci' );

$table_prefix = $_ENV['DB_PREFIX'] ?: 'wp_';

/**
 * Object caching
 */

if ( isset( $_ENV["REDIS_HOST"] ) ) {
	$redis_server = array(
		'host' => $_ENV["REDIS_HOST"],
		'port' => 6379,
	);
}

define( 'WP_CACHE_KEY_SALT', WP_ENV . $_ENV['WP_CACHE_KEY_SALT'] );
define( 'WP_REDIS_DISABLE_FAILBACK_FLUSH', true );

/**
 * Authentication Unique Keys and Salts
 */
define( 'AUTH_KEY', $_ENV['AUTH_KEY'] );
define( 'SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY'] );
define( 'LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY'] );
define( 'NONCE_KEY', $_ENV['NONCE_KEY'] );
define( 'AUTH_SALT', $_ENV['AUTH_SALT'] );
define( 'SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] );
define( 'LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT'] );
define( 'NONCE_SALT', $_ENV['NONCE_SALT'] );

/** Batcache config **/
require_once __DIR__ . '/bc-config.php';

/** Location of the DB config file for DB dropin **/
define( 'DB_CONFIG_FILE', __DIR__ . '/db-config.php' );

/** Auto load path */
define( 'AUTOLOAD_PATH', __DIR__ . '/vendor/autoload.php' );


if ( extension_loaded( 'newrelic' ) ) {
	/** Set WP CRON as background jobs in new relic */
	if ( defined( 'DOING_CRON' ) && DOING_CRON ) {
		newrelic_background_job( true );
	}
}
/**
 * Disable updates
 */
define( 'AUTOMATIC_UPDATER_DISABLED', true );
define( 'WP_AUTO_UPDATE_CORE', false );
/**
 * Crons
 */
define( 'DISABLE_WP_CRON', true );
define( 'ALTERNATE_WP_CRON', true );
/**
 * Disable file editor
 */
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );

define( 'WPMS_ON', !empty( $_ENV['WPMS_ON'] ) );
if ( WPMS_ON ) {
	define( 'WPMS_MAIL_FROM', $_ENV['WPMS_MAIL_FROM'] );
	define( 'WPMS_MAIL_FROM_NAME', $_ENV['WPMS_MAIL_FROM_NAME'] );
	define( 'WPMS_MAILER', $_ENV['WPMS_MAILER'] ); // Possible values 'smtp', 'mail', or 'sendmail'
	define( 'WPMS_SMTP_HOST', $_ENV['WPMS_SMTP_HOST'] ); // The SMTP mail host
	define( 'WPMS_SMTP_PORT', $_ENV['WPMS_SMTP_PORT'] ); // The SMTP server port number
	define( 'WPMS_SSL', $_ENV['WPMS_SSL'] ); // Possible values '', 'ssl', 'tls' - note TLS is not STARTTLS
	define( 'WPMS_SMTP_AUTH', empty( $_ENV['WPMS_SMTP_AUTH'] ) ); // True turns on SMTP authentication, false turns it off
	define( 'WPMS_SET_RETURN_PATH', 'false' );
	if ( WPMS_SMTP_AUTH ) {
		define( 'WPMS_SMTP_USER', $_ENV['WPMS_SMTP_USER'] ); // SMTP authentication username, only used if WPMS_SMTP_AUTH is true
		define( 'WPMS_SMTP_PASS', $_ENV['WPMS_SMTP_PASS'] ); // SMTP authentication password, only used if WPMS_SMTP_AUTH is true
	}
}

if ( isset( $_ENV["EP_HOST"] ) ) {
	define( 'EP_HOST', $_ENV["EP_HOST"] );
}

$s3_vars = [
	'S3_UPLOADS_BUCKET',
	'S3_UPLOADS_REGION',
	'S3_UPLOADS_KEY',
	'S3_UPLOADS_SECRET',
	'S3_UPLOADS_BUCKET_URL',
	'S3_UPLOADS_ENDPOINT'
];

foreach ( $s3_vars as $s3_var ) {
	if ( isset( $_ENV[ $s3_var ] ) ) {
		define( $s3_var, $_ENV[ $s3_var ] );
	}
}

// Local development mode
define( 'S3_UPLOADS_USE_LOCAL', ( isset( $_ENV["S3_UPLOADS_USE_LOCAL"] ) ) ? (bool) $_ENV["S3_UPLOADS_USE_LOCAL"] : false );
// Auto enable
define( 'S3_UPLOADS_AUTOENABLE', ( isset( $_ENV["S3_UPLOADS_AUTOENABLE"] ) ) ? (bool) $_ENV["S3_UPLOADS_AUTOENABLE"] : false );
// will expire in 30 days time
define( 'S3_UPLOADS_CACHE_CONTROL', 30 * 24 * 60 * 60 );
// will expire in 10 years time
define( 'S3_UPLOADS_HTTP_EXPIRES', date( 'D, d M Y H:i:s O', time() + 315360000 ) );

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define( 'WP_DEBUG', ( !empty( $_ENV["WP_DEBUG"] ) ) );
$http_host = $_SERVER['HTTP_HOST'];

if ( isset( $_SERVER['HTTPS'] ) ) {
	if ( 'on' == strtolower( $_SERVER['HTTPS'] ) || '1' == $_SERVER['HTTPS'] ) {
		$http_host = "https://{$http_host}";
	} else {
		$http_host = "http://{$http_host}";
	}
} else if ( isset( $_SERVER['SERVER_PORT'] ) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
	$http_host = "https://{$http_host}";
} else {
	$http_host = "http://{$http_host}";
}
define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
define( 'WP_CONTENT_URL', "{$http_host}/wp-content" );
define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
define( 'WP_PLUGIN_URL', WP_CONTENT_URL . "/plugins" );
define( 'WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );
define( 'WPMU_PLUGIN_URL', WP_CONTENT_URL . "/mu-plugins" );
define( 'WP_DROPIN_DIR', WP_CONTENT_DIR . '/dropins' );
define( 'WP_DROPIN_URL', WP_CONTENT_URL . "/dropins" );

define( 'WP_HOME', $http_host );
define( 'WP_SITEURL', $http_host );

if ( isset( $_ENV["MULTISITE"] ) ) {
	define( 'SUNRISE', ( isset( $_ENV["SUNRISE"] ) ) ? (bool) $_ENV["SUNRISE"] : true );
	define( 'MULTISITE', ( isset( $_ENV["MULTISITE"] ) ) ? (bool) $_ENV["MULTISITE"] : true );
	define( 'SUBDOMAIN_INSTALL', true );
	define( 'PATH_CURRENT_SITE', '/' );
	if ( isset( $_ENV["DOMAIN_CURRENT_SITE"] ) ) {
		define( 'DOMAIN_CURRENT_SITE', $_ENV["DOMAIN_CURRENT_SITE"] );
	}
	define( 'SITE_ID_CURRENT_SITE', ( isset( $_ENV["SITE_ID_CURRENT_SITE"] ) ) ? $_ENV["SITE_ID_CURRENT_SITE"] : 1 );
	define( 'BLOG_ID_CURRENT_SITE', ( isset( $_ENV["BLOG_ID_CURRENT_SITE"] ) ) ? $_ENV["BLOG_ID_CURRENT_SITE"] : 1 );

	define( 'MERCATOR_SKIP_CHECKS', true );
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
