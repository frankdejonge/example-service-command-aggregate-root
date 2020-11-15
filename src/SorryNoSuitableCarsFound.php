<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

use DomainException;

class SorryNoSuitableCarsFound extends DomainException
{
    public static function forClassification(CarClassification $carClassification): SorryNoSuitableCarsFound
    {
        return new SorryNoSuitableCarsFound("No cars found for classification {$carClassification->toString()}.");
    }
}
