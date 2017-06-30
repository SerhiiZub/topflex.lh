<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:58
 */

namespace app\entities;


trait EventTrait
{
    private $events = [];

    protected function recordEvent($event)
    {
        $this->events[] = $event;
    }

    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}