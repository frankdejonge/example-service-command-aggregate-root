<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

class InMemoryCarRentalRepository implements CarRentalRepository
{
    private array $carRentals = [];

    public function findOrCreateCarRental(ContractIdentifier $identifier): CarRental
    {
        $carRental = $this->carRentals[$identifier->toString()] ??= new CarRental($identifier);

        return clone $carRental;
    }

    public function persistCarRental(CarRental $carRental): void
    {
        $this->carRentals[$carRental->identifier()->toString()] = $carRental;
    }
}
