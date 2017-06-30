<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:26
 */

namespace tests\unit\entities\Employee;


use Codeception\Test\Unit;

class ArchiveTest extends Unit
{
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