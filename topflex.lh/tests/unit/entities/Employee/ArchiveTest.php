<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:26
 */

namespace tests\unit\entities\Employee;


use Codeception\Test\Unit;
use PHPUnit_Framework_TestResult;

class ArchiveTest extends Unit
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
        $employee = EmployeeBuilder::instance()->build();

        $this->assertTrue($employee->isActive());
        $this->assertFalse($employee->isArchived());

        $employee->archive($date = new \DateTimeImmutable('2011-06-15'));

        $this->assertFalse($employee->isActive());
        $this->assertTrue($employee->isArchived());

        $this->assertNotEmpty($statuses = $employee->getStatuses());
        $this->assertTrue(end($statuses)->isArchived());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeArchived::class, end($events));
    }

    public function testAlreadyArchived()
    {
        $employee = EmployeeBuilder::instance()->archived()->build();

        $this->expectExceptionMessage('Employee is already archived.');
        $employee->archive(new \DateTimeImmutable('2011-06-15'));
    }
}