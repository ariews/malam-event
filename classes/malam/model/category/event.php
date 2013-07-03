<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  arie
 */

abstract class Malam_Model_Category_Event extends Model_Hierarchy
{
    /**
     * "Has many" relationships
     * @var array
     */
    protected $_has_many        = array(
        'events'          => array('model' => 'event', 'foreign_key' => 'hierarchy_id')
    );

    /**
     * Hierachy Model Name
     *
     * @var string
     */
    protected $_hieracy_name    = 'event';
}