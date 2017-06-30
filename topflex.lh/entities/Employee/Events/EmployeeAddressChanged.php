<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 16:07
 */

namespace app\entities\Employee\Events;

use app\entities\Employee\EmployeeId;

class EmployeeAddressChanged
{
    public $employeeId;
    public $address;

    public function __construct(EmployeeId $employeeId, $address)
    {
        $this->employeeId = $employeeId;
        $this->name = $address;
    }
}