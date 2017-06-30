<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 16:09
 */

namespace app\entities\Employee\Events;

use app\entities\Employee\EmployeeId;

class EmployeePhoneRemoved
{
    public $employeeId;
    public $phone;

    public function __construct(EmployeeId $employeeId, $phone)
    {
        $this->employeeId = $employeeId;
        $this->phone = $phone;
    }
}