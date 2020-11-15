<?php

declare(strict_types=1);

use FrankDeJonge\Example\Car;
use FrankDeJonge\Example\CarClassification;
use FrankDeJonge\Example\CarRental;
use FrankDeJonge\Example\CarRentalService;
use FrankDeJonge\Example\CarSupply\InMemoryCarSupplier;
use FrankDeJonge\Example\ContractIdentifier;
use FrankDeJonge\Example\InMemoryCarRentalRepository;
use FrankDeJonge\Example\RentACar;
use FrankDeJonge\Example\SorryNoSuitableCarsFound;
use PHPUnit\Framework\TestCase;

class CarRentalServiceTest extends TestCase
{
    private CarRentalService $service;
    private InMemoryCarRentalRepository $repository;
    private InMemoryCarSupplier $carSupplier;
    private ContractIdentifier $contractIdentifier;

    protected function setUp(): void
    {
        $this->contractIdentifier = ContractIdentifier::fromString('my-contract');
        $this->service = new CarRentalService(
            $this->repository = new InMemoryCarRentalRepository(),
            $this->carSupplier = new InMemoryCarSupplier()
        );
    }

    /**
     * @test
     */
    public function renting_an_economy_car(): void
    {
        $this->givenCarsAreAvailable([
            new Car('abc', 'Cheap Car', 4900, CarClassification::economy()),
            $expectedCar = new Car('abcd', 'Very Cheap Car', 4600, CarClassification::economy()),
            new Car('bcde', 'Not So Cheap Car', 6900, CarClassification::business()),
        ]);

        $this->service->rentACar(new RentACar(
            $this->contractIdentifier,
            CarClassification::economy(),
        ));

        $rental = $this->carRental();

        $this->assertEquals($expectedCar, $rental->rentedCar());
    }

    /**
     * @test
     * @dataProvider dpCasesWhenTheSuitableCarIsNotFound
     */
    public function not_finding_a_suitable_car(array $suitableCars, CarClassification $classification): void
    {
        $this->givenCarsAreAvailable($suitableCars);

        $this->expectException(SorryNoSuitableCarsFound::class);

        $this->service->rentACar(new RentACar($this->contractIdentifier, $classification));
    }

    public function dpCasesWhenTheSuitableCarIsNotFound(): Generator
    {
        yield "no cars are available at all" => [
            [],
            CarClassification::economy(),
        ];

        yield "looking for an economy car and there is only business" => [
            [
                new Car('abcd', 'A', 5600, CarClassification::business()),
                new Car('bcde', 'A', 5600, CarClassification::business()),
                new Car('cdef', 'A', 5600, CarClassification::business()),
            ],
            CarClassification::economy()
        ];

        yield "looking for an business car and there is only economy" => [
            [
                new Car('abcd', 'A', 5600, CarClassification::economy()),
                new Car('bcde', 'A', 5600, CarClassification::economy()),
                new Car('cdef', 'A', 5600, CarClassification::economy()),
            ],
            CarClassification::business()
        ];
    }

    /**
     * @param Car[] $carSupply
     */
    protected function givenCarsAreAvailable(array $carSupply): void
    {
        $this->carSupplier->updateCarSupply($carSupply);
    }

    protected function carRental(): CarRental
    {
        return $this->repository->findOrCreateCarRental($this->contractIdentifier);
    }
}
