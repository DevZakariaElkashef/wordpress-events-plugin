<?php

use Events\Events;
use Events\Activator;
use Events\Deactivator;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           events
 *
 * @wordpress-plugin
 * Plugin Name:       Event Management Plugin
 * Plugin URI:        http://example.com/events-uri/
 * Description:       This is a management for custom post type events
 * Version:           1.0.0
 * Author:            Zakaria Elkashef
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       events
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Prevent direct access to this file if WordPress is not loaded.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


// if the Advanced Custom Fields (ACF) plugin is not installed stop the code and return warning
if (!function_exists('acf_add_local_field_group')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error"><p>';
        echo __('The Advanced Custom Fields plugin is required for the Events plugin to work properly. Please install and activate it.', 'events');
        echo '</p></div>';
    });

    return;
}



/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'events_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-events-activator.php
 */
function activate_events() {
	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-events-deactivator.php
 */
function deactivate_events() {
	Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_events' );
register_deactivation_hook( __FILE__, 'deactivate_events' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_events() {

	$plugin = new Events();
	$plugin->run();

}
run_events();
