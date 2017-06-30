<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:28
 */

namespace tests\unit\entities\Employee;


use Codeception\Test\Unit;
use PHPUnit_Framework_TestResult;

class RemoveTest extends Unit
{
    public function count()
    {
        // TODO: Implement count() method.
    }

    public function run(PHPUnit_Framework_TestResult $result = null)
    {
        // TODO: Implement run() method.
    }

    public function testSuccess()
    {
        $employee = EmployeeBuilder::instance()->archived()->build();

        $employee->remove();

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeRemoved::class, end($events));
    }

    public function testNotArchived()
    {
        $employee = EmployeeBuilder::instance()->build();

        $this->expectExceptionMessage('Cannot remove active employee.');

        $employee->remove();
    }
}