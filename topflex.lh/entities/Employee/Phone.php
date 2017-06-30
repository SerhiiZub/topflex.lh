<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 10:00
 */

namespace app\entities\Employee;

use Assert\Assertion;
use yii\db\ActiveRecord;

class Phone
{
    private $country;
    private $code;
    private $number;

    public function __construct($country, $code, $number)
    {
        Assertion::notEmpty($country);
        Assertion::notEmpty($code);
        Assertion::notEmpty($number);

        $this->country = $country;
        $this->code = $code;
        $this->number = $number;
    }

    public function isEqualTo(self $phone)
    {
        return $this->getFull() === $phone->getFull();
    }

    public function getFull()
    {
        return '+' . $this->country . ' (' . $this->code . ') ' . $this->number;
    }

    public function getCountry() {
        return $this->country;
    }
    public function getCode() {
        return $this->code;
    }
    public function getNumber() {
        return $this->number;
    }
}