<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  arie
 */

/* Dashboard Prefix */
$DPRX = Kohana::$config->load('site.dashboard_prefix');

return array(
    'event'                 => array(
        'uri_callback'      => 'events/<action>(/<id>/<slug>)',
        'regex'             => array(
            'id'            => '\d+',
            'slug'          => '[a-zA-Z0-9-_]+',
            'action'        => 'read|index'
        ),
        'defaults'          => array(
            'controller'    => 'event',
            'action'        => 'index',
            'id'            => NULL,
            'slug'          => NULL,
        )
    ),

    'admin-event'            => array(
        'uri_callback'      => $DPRX.'events/<action>(/<id>)',
        'regex'             => array(
            'action'        => 'index|create|delete|update|read',
            'id'            => '\d+',
        ),
        'defaults'          => array(
            'controller'    => 'event',
            'directory'     => 'admin',
            'action'        => 'index',
            'id'            => NULL,
        )
    ),
);