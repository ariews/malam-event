<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * @author  arie
 */

abstract class Mymusic_Controller_Admin_Event extends Controller_Abstract_Bigcontent
{
    /**
     * Event
     *
     * @var Model_Event
     */
    protected $model            = 'event';

    public function action_index()
    {
        $this->title('Events index');
    }

    public function action_create()
    {
        $this->title('Create event');
    }

    public function action_update()
    {
        $this->title('Update Event');
    }

    public function action_delete()
    {
        $this->title('Delete Event');
    }
}