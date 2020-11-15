<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

class RentACar implements CarRentalCommand
{
    /**
     * @var ContractIdentifier
     */
    private ContractIdentifier $contractIdentifier;

    /**
     * @var CarClassification
     */
    private CarClassification $carClassification;

    public function __construct(ContractIdentifier $contractIdentifier, CarClassification $carClassification)
    {
        $this->contractIdentifier = $contractIdentifier;
        $this->carClassification = $carClassification;
    }

    public function contractIdentifier(): ContractIdentifier
    {
        return $this->contractIdentifier;
    }

    public function carClassification(): CarClassification
    {
        return $this->carClassification;
    }
}
