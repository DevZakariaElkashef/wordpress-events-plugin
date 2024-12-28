<?php

namespace Events\Core;


class CustomFields
{
    public function __construct()
    {
        add_action("acf/init", [$this, "add_custom_fields"]);
    }

    public function add_custom_fields()
    {
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group([
                'key' => 'group_event_details',
                'title' => __('Event Details', 'events'),
                'fields' => [
                    [
                        'key' => 'field_event_description',
                        'label' => __('Description', 'events'),
                        'name' => 'event_description',
                        'type' => 'wysiwyg',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_event_date',
                        'label' => __('Event Date', 'events'),
                        'name' => 'event_date',
                        'type' => 'date_picker',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_event_start_time',
                        'label' => __('Start Time', 'events'),
                        'name' => 'event_start_time',
                        'type' => 'time_picker',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_event_end_time',
                        'label' => __('End Time', 'events'),
                        'name' => 'event_end_time',
                        'type' => 'time_picker',
                    ],
                    [
                        'key' => 'field_event_image',
                        'label' => __('Event Image', 'events'),
                        'name' => 'event_image',
                        'type' => 'image',
                        'return_format' => 'url',
                        'required' => 0,
                    ],
                    
                ],
                'location' => [
                    [
                        [
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'event',
                        ],
                    ],
                ],
            ]);
        }
    }
}
