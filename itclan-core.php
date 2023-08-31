<?php
/**
 * Plugin Name: ITClan Core
 * Plugin URI:  https://www.itclanbd.com
 * Description: Plugin that adds additional features needed by our theme
 * Version:     1.0.0
 * Author:      ITclanbd
 * Author URI:  https://www.itclanbd.com
 * Text Domain: ic-core
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 * @package itclan-core
 * @author  ITclanbd
 * @license GPL-2.0+
 * @copyright  2020, ITclanbd
 */

defined( 'ABSPATH' ) || exit;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'IC_CORE_VERSION', '1.0.0' );

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/* define plugin file */
if ( ! defined( 'IC_CORE_URL' ) ) {
	define( 'IC_CORE_PLUGIN_FILE', __FILE__ );
}

/* define plugin path */
if ( ! defined( 'IC_CORE_PATH' ) ) {
	define( 'IC_CORE_PATH', plugin_dir_path( __FILE__ ) );
}

/* define plugin URL */
if ( ! defined( 'IC_CORE_URL' ) ) {
	define( 'IC_CORE_URL', plugins_url() . '/itclan-core' );
}

/* define inc URL */
if ( ! defined( 'IC_INC_URL' ) ) {
	define( 'IC_INC_URL', IC_CORE_URL . '/inc' );
}

/* define inc path */
if ( ! defined( 'IC_INC_DIR' ) ) {
	define( 'IC_INC_DIR', IC_CORE_PATH . 'inc' );
}

// pdf link
require IC_CORE_PATH . '/dompdf/autoload.inc.php';
require IC_INC_DIR . '/Dompdf.php';

function ic_core_construct() {

	/*
	** Require file
	*/
	require_once( IC_INC_DIR . '/init.php' );

	/*
	** Load text domain
	*/
	load_plugin_textdomain( 'ic-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );


}

add_action( 'plugins_loaded', 'ic_core_construct', 20 );

/**
 * The code that runs during plugin inc.
 * This action is documented in /inc/class-activator.php
 */
function ic_plugin_activate() {
	require_once( IC_INC_DIR . '/class-activator.php' );
	Ic_Plugin_Activator::activate();
}

register_activation_hook( __FILE__, 'ic_plugin_activate' );


/**
 * The code that runs during plugin deactivation.
 * This action is documented in /inc/class-deactivator.php
 */
function ic_plugin_deactivate() {
	require_once( IC_INC_DIR . '/class-deactivator.php' );
	Ic_Plugin_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'ic_plugin_deactivate' );