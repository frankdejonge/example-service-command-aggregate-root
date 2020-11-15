<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

interface CarRentalCommand
{
    public function contractIdentifier(): ContractIdentifier;
}
