<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:57
 */

namespace app\entities;


interface AggregateRoot
{
    public function getId();

    public function releaseEvents();
}