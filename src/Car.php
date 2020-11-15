<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

class Car
{
    private string $numberPlate;

    private string $name;

    /**
     * @var CarClassification
     */
    private CarClassification $classification;

    private int $priceInCents;

    public function __construct(string $numberPlate, string $name, int $priceInCents, CarClassification $classification)
    {
        $this->numberPlate = $numberPlate;
        $this->name = $name;
        $this->classification = $classification;
        $this->priceInCents = $priceInCents;
    }

    public function priceInCents(): int
    {
        return $this->priceInCents;
    }

    public function numberPlate(): string
    {
        return $this->numberPlate;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function classification(): CarClassification
    {
        return $this->classification;
    }

    public function hasClassification(CarClassification $classification): bool
    {
        return $classification->equals($this->classification);
    }
}
