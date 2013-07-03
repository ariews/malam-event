<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  arie
 */

abstract class Malam_Model_Event extends Model_Bigcontent
{
    /**
     * Admin route name
     * @var string
     */
    protected $_admin_route_name = 'admin-event';

    /**
     * Route name
     * @var string
     */
    protected $_route_name      = 'event';

    /**
     * "Belongs to" relationships
     * @var array
     */
    protected $_belongs_to      = array(
        'user'          => array('model' => 'user', 'foreign_key' => 'user_id'),
        'category'      => array('model' => 'category_event', 'foreign_key' => 'hierarchy_id'),
    );

    /**
     * "Has one" relationships
     * @var array
     */
    protected $_has_one         = array(
        'dates'         => array(
            'model'         => 'event_date',
            'foreign_key'   => 'event_id',
            'far_key'       => 'id'
        ),
    );

    protected $_is_direct_call  = FALSE;

    protected $_tag_enable      = FALSE;

    public function to_paginate()
    {
        return Paginate::factory($this)
            ->sort('created_at', Paginate::SORT_DESC)
            ->columns(array($this->primary_key(), 'name', 'when', 'location', 'description'))
            ->search_columns(array('title', 'content'));
    }

    public function get_field($field)
    {
        switch (strtolower($field)):
            case 'name':
            case 'title':
                return $this->admin_update_url($this->name());
                break;

            case 'description':
                return $this->content_as_featured_text();
                break;

            case 'location':
                return $this->dates->location;
                break;

            case 'when':
            case 'get_date':
                $dates = $this->dates;

                if (! $dates->loaded())
                {
                    return date('D, d M Y H:i');
                }

                return $this->dates->date('D, d M Y H:i', 'start_date');
                break;

            default :
                return parent::get_field($field);
                break;
        endswitch;
    }

    public function create_or_update(array $data)
    {
        $result = parent::create_or_update($data);
        /* @var $result self */

        $dates = Arr::get($data, 'dates') + array(
            'event_id'  => $result->pk()
        );

        $this->dates->create_or_update($dates);

        return $result;
    }
}