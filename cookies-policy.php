<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://rits.dev
 * @since             1.0.0
 * @package           Cookies_Policy
 *
 * @wordpress-plugin
 * Plugin Name:       Cookies Policy
 * Plugin URI:        http://rits.dev
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.0
 * Author:            Rits Tecnologia
 * Author URI:        http://rits.dev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cookies-policy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COOKIES_POLICY_VERSION', '1.1.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cookies-policy-activator.php
 */
function activate_cookies_policy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookies-policy-activator.php';
	Cookies_Policy_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cookies-policy-deactivator.php
 */
function deactivate_cookies_policy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookies-policy-deactivator.php';
	Cookies_Policy_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cookies_policy' );
register_deactivation_hook( __FILE__, 'deactivate_cookies_policy' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cookies-policy.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cookies_policy() {

	$plugin = new Cookies_Policy();
	$plugin->run();
    if ( ! function_exists( 'allow_cookies' ) ) {
        function allow_cookies() {
            return isset($_COOKIE['permission_use_cookies']) ;
        }
    }

}
run_cookies_policy();
