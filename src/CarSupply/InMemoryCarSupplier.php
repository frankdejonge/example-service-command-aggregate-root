<?php

declare(strict_types=1);

namespace FrankDeJonge\Example\CarSupply;

use FrankDeJonge\Example\Car;
use FrankDeJonge\Example\CarClassification;

class InMemoryCarSupplier implements CarSupplier
{
    private array $cars;

    public function __construct(array $cars = [])
    {
        $this->cars = $cars;
    }

    public function updateCarSupply(array $cars): void
    {
        $this->cars = $cars;
    }

    public function findCarsInClass(CarClassification $classification): array
    {
        return array_filter($this->cars, fn(Car $car) => $car->hasClassification($classification));
    }
}
