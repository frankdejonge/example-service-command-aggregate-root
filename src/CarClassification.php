<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

class CarClassification
{
    private string $classificiation;

    private function __construct(string $classificiation)
    {
        $this->classificiation = $classificiation;
    }

    public function toString(): string
    {
        return $this->classificiation;
    }

    public static function economy(): CarClassification
    {
        return new CarClassification('economy');
    }

    public static function business(): CarClassification
    {
        return new CarClassification('business');
    }

    public function equals(CarClassification $classification): bool
    {
        return $classification->classificiation === $this->classificiation;
    }
}
