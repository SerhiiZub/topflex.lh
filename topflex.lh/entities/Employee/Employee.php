<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 29.06.17
 * Time: 17:45
 */

namespace app\entities\Employee;

use app\entities\Employee\Events;
use app\entities\AggregateRoot;
use app\entities\EventTrait;

class Employee implements AggregateRoot
{
    use EventTrait;
    private $id;
    private $name;
    private $address;
    private $phones;
    private $createDate;
    private $statuses = [];
    private $events = [];

    public function __construct(EmployeeId $id, Name $name, Address $address, array $phones)
    {
        if (!$phones) {
            throw new \DomainException('Employee must contain at least one phone.');
        }
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->phones = new Phones($phones);
        $this->createDate = new \DateTimeImmutable();
        $this->addStatus(Status::ACTIVE, $this->createDate);
        $this->recordEvent(new Events\EmployeeCreated($this->id));
    }

    public function rename(Name $name)
    {
        $this->name = $name;
        $this->recordEvent(new Events\EmployeeRenamed($this->id, $name));
    }

    public function changeAddress(Address $address)
    {
        $this->address = $address;
        $this->recordEvent(new Events\EmployeeAddressChanged($this->id, $address));
    }

    public function addPhone(Phone $phone) {
        $this->phones->add($phone);
        $this->recordEvent(new Events\EmployeePhoneAdded($this->id, $phone));
    }

    public function removePhone($index) {
        $phone = $this->phones->remove($index);
        $this->recordEvent(new Events\EmployeePhoneRemoved($this->id, $phone));
    }

    public function archive(\DateTimeImmutable $date) {
        if ($this->isArchived()) {
            throw new \DomainException('Employee is already archived.');
        }
        $this->addStatus(Status::ARCHIVED, $date);
        $this->recordEvent(new Events\EmployeeArchived($this->id, $date));
    }

    public function reinstate(\DateTimeImmutable $date) {
        if (!$this->isArchived()) {
            throw new \DomainException('Employee is not archived.');
        }
        $this->addStatus(Status::ACTIVE, $date);
        $this->recordEvent(new Events\EmployeeReinstated($this->id, $date));
    }

    public function remove() {
        if (!$this->isArchived()) {
            throw new \DomainException('Cannot remove active employee.');
        }
        $this->recordEvent(new Events\EmployeeRemoved($this->id));
    }

    public function isActive() {
        return $this->getCurrentStatus()->isActive();
    }

    public function isArchived() {
        return $this->getCurrentStatus()->isArchived();
    }

    private function getCurrentStatus()
    {
        return end($this->statuses);
    }

    private function addStatus($value, \DateTimeImmutable $date)
    {
        $this->statuses[] = new Status($value, $date);
    }

    protected function recordEvent($event)
    {
        $this->events[] = $event;
    }

    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhones() {
        return $this->phones->getAll();
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function getStatuses() {
        return $this->statuses;
    }


}