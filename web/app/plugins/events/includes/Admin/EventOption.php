<?php

namespace Events\Admin;

class EventOption
{
    public function __construct()
    {
        // Hook to add the options page
        add_action('admin_menu', [$this, 'addOptionsPage']);

        // Hook to register settings
        add_action('admin_init', [$this, 'registerSettings']);
    }

    /**
     * Add options page for Event Options.
     */
    public function addOptionsPage()
    {
        add_options_page(
            __('Event Options', 'events'),  // Page title
            __('Event Options', 'events'),  // Menu title
            'manage_options',               // Capability required
            'event-options',                // Menu slug
            [$this, 'renderOptionsPage']    // Callback function
        );
    }

    /**
     * Register settings for Event Options.
     */
    public function registerSettings()
    {
        register_setting('event_options', 'show_past_events');
        register_setting('event_options', 'items_per_page');

        add_settings_section(
            'event_options_section',
            __('Event Settings', 'events'),
            null,
            'event-options'
        );

        add_settings_field(
            'show_past_events',
            __('Show Past Events', 'events'),
            [$this, 'renderCheckboxField'],
            'event-options',
            'event_options_section',
            ['label_for' => 'show_past_events']
        );

        add_settings_field(
            'items_per_page',
            __('Number of Items Per Page', 'events'),
            [$this, 'renderNumberField'],
            'event-options',
            'event_options_section',
            ['label_for' => 'items_per_page']
        );
    }

    /**
     * Render the options page.
     */
    public function renderOptionsPage()
    {
        include plugin_dir_path(__FILE__) . 'partials/event-options-page.php';
    }

    /**
     * Render checkbox field for showing past events.
     */
    public function renderCheckboxField($args)
    {
        include plugin_dir_path(__FILE__) . 'partials/event-checboc-fields.php';
    }

    /**
     * Render number field for items per page.
     */
    public function renderNumberField($args)
    {
        include plugin_dir_path(__FILE__) . 'partials/event-show-fields.php';

    }
}
