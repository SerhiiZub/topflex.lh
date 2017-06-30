<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 16:11
 */

namespace app\entities\Employee\Events;

use app\entities\Employee\EmployeeId;

class EmployeeReinstated
{
    public $employeeId;
    public $date;

    public function __construct(EmployeeId $employeeId, $date)
    {
        $this->employeeId = $employeeId;
        $this->date = $date;
    }
}