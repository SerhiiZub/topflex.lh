<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 16:04
 */

namespace app\entities\Employee\Events;

use app\entities\Employee\EmployeeId;

class EmployeeRenamed
{
    public $employeeId;
    public $name;

    public function __construct(EmployeeId $employeeId, $name)
    {
        $this->employeeId = $employeeId;
        $this->name = $name;
    }
}