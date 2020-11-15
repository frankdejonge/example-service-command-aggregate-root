<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

use FrankDeJonge\Example\CarSupply\CarSupplier;

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
