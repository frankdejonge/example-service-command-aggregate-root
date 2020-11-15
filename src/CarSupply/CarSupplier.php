<?php

declare(strict_types=1);

namespace FrankDeJonge\Example\CarSupply;

use FrankDeJonge\Example\CarClassification;

interface CarSupplier
{
    public function findCarsInClass(CarClassification $classification): array;
}
