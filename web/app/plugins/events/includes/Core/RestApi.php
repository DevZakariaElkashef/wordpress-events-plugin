<?php

namespace Events\Core;

use Events\Traits\ApiResponse;

class RestApi
{
    use ApiResponse;

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'register_event_search_route']);
    }

    /**
     * Register a custom REST API route for searching events
     */
    public function register_event_search_route()
    {
        register_rest_route('events/v1', '/search/', [
            'methods' => 'GET',
            'callback' => [$this, 'search_events'],
            'permission_callback' => '',
        ]);
    }

    /**
     * Callback for searching events
     */
    public function search_events($data)
    {
        $query = $this->get_query($data);


        $events = [];

        // Loop through events and add necessary data to the response
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $events[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'description' => get_the_content(),
                    'event_date' => get_post_meta(get_the_ID(), 'event_date', true), // Replace with your custom field
                    'start_time' => get_post_meta(get_the_ID(), 'event_start_time', true), // Replace with your custom field
                    'end_time' => get_post_meta(get_the_ID(), 'event_end_time', true), // Replace with your custom field
                    'image' => wp_get_attachment_url(get_post_meta(get_the_ID(), 'event_image', true)), // Get featured image
                ];
            }
        }

        wp_reset_postdata();

        // Return the event data
        return $this->sendResponse('Evnets', $events);
    }


    /**
     * Check if the user is logged in
     */
    public function check_user_permission()
    {
        // Ensure the user is logged in
        if (!is_user_logged_in()) {
            return new \WP_Error('rest_forbidden', __('You must be logged in to access this resource', 'events'), ['status' => 403]);
        }
        return true; // Allow access if the user is logged in
    }

    private function get_query($data)
    {
        // Set default arguments for the query
        $args = [
            'post_type'      => 'event',
            'posts_per_page' => get_option('items_per_page'), // Retrieve all matching events
            'post_status'    => 'publish',
        ];

        // Add taxonomy queries based on the search term
        if (isset($data['search']) && !empty($data['search'])) {
            $search_term = sanitize_text_field($data['search']);
            $tax_query = [];

            // Check if the search term partially matches any category in event_category
            $categories = get_terms([
                'taxonomy'   => 'event_category',
                'search'     => $search_term, // Perform partial matching
                'fields'     => 'slugs',      // Only return slugs
                'hide_empty' => false,        // Include terms even if no posts are assigned
            ]);

            if (!empty($categories)) {
                $tax_query[] = [
                    'taxonomy' => 'event_category',
                    'field'    => 'slug',
                    'terms'    => $categories,
                    'operator' => 'IN',
                ];
            }

            // Check if the search term partially matches any tag in event_tag
            $tags = get_terms([
                'taxonomy'   => 'event_tag',
                'search'     => $search_term, // Perform partial matching
                'fields'     => 'slugs',      // Only return slugs
                'hide_empty' => false,        // Include terms even if no posts are assigned
            ]);

            if (!empty($tags)) {
                $tax_query[] = [
                    'taxonomy' => 'event_tag',
                    'field'    => 'slug',
                    'terms'    => $tags,
                    'operator' => 'IN',
                ];
            }

            // If we have any taxonomy filters, add them to the query
            if (!empty($tax_query)) {
                $args['tax_query'] = $tax_query;
            } else {
                // If no taxonomy matches, fallback to default search
                $args['s'] = $search_term;
            }
        }

        // Check if 'show_past_events' option is enabled
        $show_past_events = get_option('show_past_events', false); // Default to false if option is not set

        if (!$show_past_events) {
            // If past events are not shown, filter out events with event_date in the past
            $args['meta_query'][] = [
                'key'     => 'event_date',
                'value'   => date('Ymd'),  // Compare with today's date in Ymd format
                'compare' => '>=',  // Only show future or upcoming events
                'type'    => 'NUMERIC',  // Specify the field type as numeric since it's Ymd format
            ];
        }

        // Execute the query
        return new \WP_Query($args);
    }
}
