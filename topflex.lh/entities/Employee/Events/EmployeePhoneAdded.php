<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 10:05
 */

namespace app\entities\Employee\Events;

use app\entities\Employee\EmployeeId;
use app\entities\Employee\Phone;

class EmployeePhoneAdded
{
    public $employeeId;
    public $phone;

    public function __construct(EmployeeId $employeeId, Phone $phone)
    {
        $this->employeeId = $employeeId;
        $this->phone = $phone;
    }
}