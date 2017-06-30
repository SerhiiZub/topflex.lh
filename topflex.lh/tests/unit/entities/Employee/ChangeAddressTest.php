<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:24
 */

namespace tests\unit\entities\Employee;


use Codeception\Test\Unit;
use PHPUnit_Framework_TestResult;

class ChangeAddressTest extends Unit
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

        $employee->changeAddress($address = new Address('New', 'Test', 'Address', 'Street', '25a'));
        $this->assertEquals($address, $employee->getAddress());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeAddressChanged::class, end($events));
    }
}