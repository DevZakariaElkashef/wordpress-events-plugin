<?php

namespace Events\Core;

class CustomColumns
{
    public function __construct()
    {
        // Add custom columns to event post list
        add_filter('manage_edit-event_columns', array($this, 'add_event_columns'));
        // Populate custom columns with field data
        add_action('manage_event_posts_custom_column', array($this, 'populate_event_columns'), 10, 2);
        // Make columns sortable
        add_filter('manage_edit-event_sortable_columns', array($this, 'make_event_date_sortable'));

        // Add event filter dropdown
        add_action('restrict_manage_posts', array($this, 'add_event_filters'));
        
        // Modify query to filter by selected date
        add_action('pre_get_posts', array($this, 'filter_events_by_date'));
    }

    // Add custom columns to event post list
    public function add_event_columns($columns)
    {
        // Add custom columns for event post type
        $columns['event_image'] = __('Event Image', 'events');
        $columns['event_date'] = __('Event Date', 'events');
        $columns['start_time'] = __('Start Time', 'events');
        $columns['end_time'] = __('End Time', 'events');

        // Remove the default 'date' column and 'tags' column
        if (isset($columns['date'])) {
            unset($columns['date']);
        }

        if (isset($columns['tags'])) {
            unset($columns['tags']);
        }

        return $columns;
    }

    // Populate custom columns with field data
    public function populate_event_columns($column, $post_id)
    {
        switch ($column) {
            case 'event_date':
                $event_date = get_field('event_date', $post_id);
                echo $event_date ? $event_date : __('N/A', 'events');
                break;

            case 'start_time':
                $start_time = get_field('event_start_time', $post_id);
                echo $start_time ? $start_time : __('N/A', 'events');
                break;

            case 'end_time':
                $end_time = get_field('event_end_time', $post_id);
                echo $end_time ? $end_time : __('N/A', 'events');
                break;

            case 'event_image':
                $event_image = get_field('event_image', $post_id);
                if ($event_image) {
                    echo '<img src="' . esc_url($event_image) . '" alt="Event Image" style="width:50px;height:auto;" />';
                } else {
                    echo __('No image', 'events');
                }
                break;
        }
    }

    // Make 'event_date', 'start_time', and 'end_time' columns sortable
    public function make_event_date_sortable($columns)
    {
        $columns['event_date'] = 'event_date';
        $columns['start_time'] = 'start_time';
        $columns['end_time'] = 'end_time';
        return $columns;
    }

    // Add a filter dropdown to the events admin page
    public function add_event_filters()
    {
        global $typenow;

        // Only add the filter for the 'event' post type
        if ($typenow === 'event') {
            $selected = isset($_GET['event_filter']) ? $_GET['event_filter'] : 'all';

            ?>
            <select name="event_filter" id="event_filter">
                <option value="all" <?php selected($selected, 'all'); ?>><?php _e('All Events', 'events'); ?></option>
                <option value="past" <?php selected($selected, 'past'); ?>><?php _e('Past Events', 'events'); ?></option>
                <option value="upcoming" <?php selected($selected, 'upcoming'); ?>><?php _e('Upcoming Events', 'events'); ?></option>
            </select>
            <?php
        }
    }

    // Modify the query based on the selected filter value
    public function filter_events_by_date($query)
    {
        if (!is_admin() || !$query->is_main_query()) {
            return;
        }

        // Only apply the filter if we are viewing the 'event' post type
        if ($query->get('post_type') === 'event' && isset($_GET['event_filter'])) {
            $filter = $_GET['event_filter'];

            $meta_query = $query->get('meta_query') ?: [];

            switch ($filter) {
                case 'past':
                    $meta_query[] = [
                        'key' => 'event_date',
                        'value' => current_time('Ymd'),
                        'compare' => '<',
                        'type' => 'DATE',
                    ];
                    break;

                case 'upcoming':
                    $meta_query[] = [
                        'key' => 'event_date',
                        'value' => current_time('Ymd'),
                        'compare' => '>=',
                        'type' => 'DATE',
                    ];
                    break;
                case 'all':
                default:
                    // No filter applied
                    break;
            }

            $query->set('meta_query', $meta_query);
        }
    }
}
