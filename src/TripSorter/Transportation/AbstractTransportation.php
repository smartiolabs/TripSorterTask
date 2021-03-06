<?php

namespace src\TripSorter\Transportation;

/**
 * Class AbstractTransportation
 *
 * @package src\TripSorter\Transportation
 */
abstract class AbstractTransportation implements TransportationInterface
{

    /**
     * @var string
     */
    protected $departure;

    /**
     * @var string
     */
    protected $arrival;

    const MESSAGE_FINAL_DESTINATION = 'You have arrived at your final destination.';

    /**
     * @param array $trip
     */
    public function __construct(array $trip)
    {
        foreach ($trip as $key => $value) {
            // Replace underscore(_) by CamelCase to match the attribute
            $property = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

}
