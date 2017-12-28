<?php
/**
 * Use MU plugins to load the autoloader
 *
 * @package   Composer autoloader
 * @author    Jonathan Harris <jon@spacedmonkey.co.uk>
 * @license   GPL-2.0+
 * @link      http://www.spacedmonkey.com/
 * @copyright 2017 Spacedmonkey
 *
 * @wordpress-muplugin
 * Plugin Name:        Composer autoloader
 * Plugin URI:         https://beta.rehab
 * Description:        Use MU plugins to load the autoloader
 * Version:            1.0.0
 * Author:             Jonathan Harris
 * Author URI:         http://www.spacedmonkey.com/
 * Text Domain:        developer-hooks
 * License:            GPL-2.0+
 * License URI:        http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:        /languages
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( defined( 'AUTOLOAD_PATH' ) && is_readable( AUTOLOAD_PATH ) ) {
	require_once AUTOLOAD_PATH;
}