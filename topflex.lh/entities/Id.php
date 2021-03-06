<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 9:49
 */

namespace app\entities;

use Assert\Assertion;

abstract class Id
{
    protected $id;

    public function __construct($id = null)
    {
        Assertion::notEmpty($id);

        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function isEqualTo(self $other)
    {
        return $this->getId() === $other->getId();
    }
}