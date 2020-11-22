<?php


namespace App\Carnovo\Cars\Domain\Interfaces;


use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Car;
use App\Carnovo\Cars\Domain\Model\CarId;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Carnovo\Cars\Domain\Model\CarsOrderBy;
use App\Carnovo\Cars\Domain\Model\Model;

interface CarsRepository
{
    public function findCarsBy(
        ?Brand $brand = null,
        ?Model $model = null,
        ?int $priceLessEqual = null,
        ?int $priceMoreEqual = null,
        ?CarsOrderBy $orderBy = null,
        int $page = 1,
        int $perPage = 10
    ): CarsCollection;

    public function save(Car $car): void;

    public function findById(CarId $carId): Car;
}