<?php


namespace Events\Core;

class PostTypes
{
    public function __construct()
    {
        add_action("init", [$this,"register_post_type"]);
    }

    public function register_post_type()
    {
        $labels = [
            'name'                  => __('Events', 'events'),
            'singular_name'         => __('Event', 'events'),
            'menu_name'             => __('Events', 'events'),
            'name_admin_bar'        => __('Event', 'events'),
            'add_new'               => __('Add New', 'events'),
            'add_new_item'          => __('Add New Event', 'events'),
            'edit_item'             => __('Edit Event', 'events'),
            'new_item'              => __('New Event', 'events'),
            'view_item'             => __('View Event', 'events'),
            'view_items'            => __('View Events', 'events'),
            'search_items'          => __('Search Events', 'events'),
            'not_found'             => __('No events found.', 'events'),
            'not_found_in_trash'    => __('No events found in Trash.', 'events'),
            'parent_item_colon'     => __('Parent Event:', 'events'),
            'all_items'             => __('All Events', 'events'),
            'archives'              => __('Event Archives', 'events'),
            'attributes'            => __('Event Attributes', 'events'),
            'insert_into_item'      => __('Insert into event', 'events'),
            'uploaded_to_this_item' => __('Uploaded to this event', 'events'),
            'featured_image'        => __('Featured Image', 'events'),
            'set_featured_image'    => __('Set featured image', 'events'),
            'remove_featured_image' => __('Remove featured image', 'events'),
            'use_featured_image'    => __('Use as featured image', 'events'),
            'filter_items_list'     => __('Filter events list', 'events'),
            'items_list_navigation' => __('Events list navigation', 'events'),
            'items_list'            => __('Events list', 'events'),
        ];
        
        $args = [
            'label'               => __('Events', 'events'),
            'labels'              => $labels,
            'public'              => true,
            'has_archive'         => true,
            'rewrite'             => ['slug' => 'events'],
            'supports'            => ['title'], 
            'taxonomies'          => ['event_category', 'event_tag'],
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true
        ];
        register_post_type('event', $args);
        
    }
}