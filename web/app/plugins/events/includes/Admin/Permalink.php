<?php


namespace Events\Admin;

class Permalink
{
    public function __construct()
    {
        update_option('permalink_structure', '/%postname%/');
    }
}
