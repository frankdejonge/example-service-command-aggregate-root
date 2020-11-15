<?php

declare(strict_types=1);

namespace FrankDeJonge\Example;

final class ContractIdentifier
{
    private string $identifier;

    private function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function toString(): string
    {
        return $this->identifier;
    }


    public static function fromString(string $identifier): ContractIdentifier
    {
        return new ContractIdentifier($identifier);
    }
}
