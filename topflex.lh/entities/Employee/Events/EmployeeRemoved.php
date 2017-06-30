<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 10:04
 */

namespace app\entities\Employee\Events;

use app\entities\Employee\EmployeeId;

class EmployeeRemoved
{
    public $employeeId;

    public function __construct(EmployeeId $employeeId)
    {
        $this->employeeId = $employeeId;
    }
}