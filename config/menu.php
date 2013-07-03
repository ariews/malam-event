<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  arie
 */

$e  = ORM::factory('event');

return array(
    'admin' => array(
        2 => array(
            'title'     => __('Events'),
            'url'       => $e->admin_index_url_only(),
        ),
    ),

    'guest' => array(
        3 => array(
            'title'         => __('Events'),
            'url'           => $e->index_url_only(),
        ),
    ),
);