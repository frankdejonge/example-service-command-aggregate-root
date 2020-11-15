<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

interface CarRentalRepository
{
    public function findOrCreateCarRental(ContractIdentifier $identifier): CarRental;

    public function persistCarRental(CarRental $carRental): void;
}
