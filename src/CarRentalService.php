<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

use FrankDeJonge\Example\CarSupply\CarSupplier;

/**
 * The car rental service is responsible for routing commands to
 * individual aggregate roots. It allows the external of the service
 * to be unaware of what the aggregate needs to function.
 */
class CarRentalService
{
    private CarRentalRepository $repository;
    private CarSupplier $carSupplier;

    public function __construct(
        CarRentalRepository $repository,
        CarSupplier $carSupplier
    ) {
        $this->repository = $repository;
        $this->carSupplier = $carSupplier;
    }

    public function rentACar(RentACar $command): void
    {
        $carRental = $this->repository->findOrCreateCarRental($command->contractIdentifier());
        $carRental->rentACar($command, $this->carSupplier);
        $this->repository->persistCarRental($carRental);
    }
}
