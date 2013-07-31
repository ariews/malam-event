<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  arie
 */

abstract class Malam_Model_Event_Date extends ORM
{
	/**
	 * Table name
	 * @var string
	 */
	protected $_table_name      = 'relationship_events';

    /**
     * "Belongs to" relationships
     *
     * @var array
     */
    protected $_belongs_to      = array(
        'event'         => array('model' => 'event', 'foreign_key' => 'event_id'),
    );

    /**
     * Rule definitions for validation
     *
     * @return array
     */
    public function rules()
    {
        return array(
            'event_id' => array(
                array('not_empty'),
                array(array($this, 'Filter_Event_Id'))
            ),
            'start_date' => array(
                array('not_empty'),
            ),
            'location' => array(
                array('not_empty'),
                array('max_length', array(':value', 100))
            ),
        );
    }

    /**
     * Filter definitions for validation
     *
     * @return array
     */
    public function filters()
    {
        return array(
            'event_id' => array(
                array('ORM::Check_Model', array(':value', 'Event')),
            ),
            'start_date' => array(
                array(array($this, 'Filter_Event_Date'))
            ),
            'end_date' => array(
                array(array($this, 'Filter_Event_Date'))
            ),
            'location' => array(
                array('trim')
            ),
        );
    }

    public function Filter_Event_Date($value)
    {
        return date('Y-m-d H:i:s', strtotime($value));
    }

    /**
     * Set values from an array with support for one-one relationships.  This method should be used
     * for loading in post data, etc.
     *
     * @param  array $values   Array of column => val
     * @param  array $expected Array of keys to take from $values
     * @return ORM
     */
    public function values(array $values, array $expected = NULL)
    {
        if (NULL === $expected || empty($expected))
        {
            $expected = array('event_id', 'start_date', 'end_date', 'location');
        }

        return parent::values($values, $expected);
    }
}