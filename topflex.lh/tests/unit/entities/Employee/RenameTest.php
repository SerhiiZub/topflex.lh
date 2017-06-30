<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:23
 */

namespace tests\unit\entities\Employee;

use app\entities\Employee\Events\EmployeeRenamed;
use app\entities\Employee\Name;
use Codeception\Test\Unit;
use PHPUnit_Framework_TestResult;

class RenameTest extends Unit
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

        $employee->rename($name = new Name('New', 'Test', 'Name'));
        $this->assertEquals($name, $employee->getName());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeRenamed::class, end($events));
    }
}