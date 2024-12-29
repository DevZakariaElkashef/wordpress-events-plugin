<?php

namespace Events\Public;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    events
 * @subpackage events/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    events
 * @subpackage events/includes/Public
 * @author     Your Name <email@example.com>
 */
class EventPublic
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $events    The ID of this plugin.
	 */
	private $events;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $events       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($events, $version)
	{

		$this->events = $events;
		$this->version = $version;

		// Register a new menu location
		add_action('after_setup_theme', [$this, 'register_main_menu']);
		add_action('after_switch_theme', [$this, 'create_main_menu']);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->events, plugin_dir_url(__FILE__) . 'css/events-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in events_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The events_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_enqueue_script($this->events, plugin_dir_url(__FILE__) . 'js/events-public.js', array('jquery'), $this->version, false);

		 wp_localize_script($this->events, 'eventsApi', [
			 'nonce' => wp_create_nonce('wp_rest'), // Generate a nonce for REST API
			 'rest_url' => esc_url(rest_url('events/v1/search')), // REST API endpoint URL
		 ]);
	}

	function register_main_menu()
	{
		register_nav_menu('main_menu', __('Main Menu'));
	}

	function create_main_menu()
	{
		// Check if the menu exists
		$menu_name = 'Main Menu';
		$existing_menu = wp_get_nav_menu_object($menu_name);

		// Create the menu if it doesn't exist
		if (!$existing_menu) {
			// Create the menu and get its ID
			$menu_id = wp_create_nav_menu($menu_name);

			// Add the "Home" menu item
			$home_page = array(
				'menu-item-title' => 'Home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			);
			wp_update_nav_menu_item($menu_id, 0, $home_page);
			
		} else {
			// If menu already exists, get its ID
			$menu_id = $existing_menu->term_id;
		}

		// Assign the created or existing menu to the 'main_menu' theme location
		$locations = get_theme_mod('nav_menu_locations', array()); // Get current menu locations
		$locations['main_menu'] = $menu_id; // Set the 'main_menu' location to our menu's ID
		set_theme_mod('nav_menu_locations', $locations);
	}
}
