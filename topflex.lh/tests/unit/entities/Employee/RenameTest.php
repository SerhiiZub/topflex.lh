<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:23
 */

namespace tests\unit\entities\Employee;

use Codeception\Test\Unit;

class RenameTest extends Unit
{
    public function testSuccess()
    {
        $employee = EmployeeBuilder::instance()->build();

        $employee->rename($name = new Name('New', 'Test', 'Name'));
        $this->assertEquals($name, $employee->getName());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeRenamed::class, end($events));
    }
}