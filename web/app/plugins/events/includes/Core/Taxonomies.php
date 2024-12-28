<?php

namespace Events\Core;

class Taxonomies
{
    public function __construct()
    {
        add_action('init', [$this, 'register_categories_taxonomies']);
        add_action('init', [$this, 'register_tags_taxonomies']);
    }


    public function register_categories_taxonomies()
    {
        // Event Category
        $labels = [
            'name'              => __('Event Categories', 'events'),
            'singular_name'     => __('Event Category', 'events'),
            'search_items'      => __('Search Event Categories', 'events'),
            'all_items'         => __('All Event Categories', 'events'),
            'edit_item'         => __('Edit Event Category', 'events'),
            'update_item'       => __('Update Event Category', 'events'),
            'add_new_item'      => __('Add New Event Category', 'events'),
            'new_item_name'     => __('New Event Category Name', 'events'),
            'menu_name'         => __('Event Categories', 'events'),
        ];

        register_taxonomy('event_category', 'event', [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'event-category'],
        ]);
    }

    public function register_tags_taxonomies()
    {
        // Event Tags
        $labels = [
            'name'              => __('Event Tags', 'events'),
            'singular_name'     => __('Event Tag', 'events'),
            'search_items'      => __('Search Event Tags', 'events'),
            'popular_items'     => __('Popular Event Tags', 'events'),
            'all_items'         => __('All Event Tags', 'events'),
            'edit_item'         => __('Edit Event Tag', 'events'),
            'update_item'       => __('Update Event Tag', 'events'),
            'add_new_item'      => __('Add New Event Tag', 'events'),
            'new_item_name'     => __('New Event Tag Name', 'events'),
            'separate_items_with_commas' => __('Separate event tags with commas', 'events'),
            'add_or_remove_items' => __('Add or remove event tags', 'events'),
            'choose_from_most_used' => __('Choose from the most used event tags', 'events'),
            'menu_name'         => __('Event Tags', 'events'),
        ];

        register_taxonomy('event_tag', 'event', [
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => false,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'event-tag'],
        ]);
    }
}
