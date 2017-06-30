<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:24
 */

namespace tests\unit\entities\Employee;


use Codeception\Test\Unit;

class ChangeAddressTest extends Unit
{
    public function testSuccess()
    {
        $employee = EmployeeBuilder::instance()->build();

        $employee->changeAddress($address = new Address('New', 'Test', 'Address', 'Street', '25a'));
        $this->assertEquals($address, $employee->getAddress());

        $this->assertNotEmpty($events = $employee->releaseEvents());
        $this->assertInstanceOf(EmployeeAddressChanged::class, end($events));
    }
}