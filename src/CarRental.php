<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

use FrankDeJonge\Example\CarSupply\CarSupplier;

/**
 * The aggregate root for renting a car. All the behavior around the process
 * of renting a car is encapsulated in this class. This class is responsible
 * with enforcing all the business rules. The methods accept services which
 * the aggregate root interacts with.
 */
class CarRental
{
    private ContractIdentifier $identifier;
    private ?Car $rendedCar = null;

    public function __construct(ContractIdentifier $identifier)
    {
        $this->identifier = $identifier;
    }

    public function identifier(): ContractIdentifier
    {
        return $this->identifier;
    }

    public function rentACar(RentACar $command, CarSupplier $carSupplier)
    {
        $suitableCars = $carSupplier->findCarsInClass($command->carClassification());

        if (empty($suitableCars)) {
            throw SorryNoSuitableCarsFound::forClassification($command->carClassification());
        }

        usort($suitableCars, fn(Car $a, Car $b) => $a->priceInCents() <=> $b->priceInCents());

        $this->rendedCar = array_shift($suitableCars);
    }

    public function rentedCar(): ?Car
    {
        return $this->rendedCar;
    }
}
