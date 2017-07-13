<?php

use \src\TripSorter\Transportation\Bus;

class BusTest extends PHPUnit_Framework_TestCase
{

    protected $bus;

    protected $trip = array(
        'Departure' => 'C',
        'Arrival' => 'D',
        'Transportation' => 'Bus',
    );

    public function setUp(){
        $this->bus = new Bus($this->trip);
    }

    public function testGetMessage()
    {
        $message = $this->bus->getMessage();
        $this->assertTrue(strlen($message) > 0);
    }
}
