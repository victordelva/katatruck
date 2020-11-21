<?php


namespace App\Carnovo\Cars\Domain\Interfaces;


use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Carnovo\Cars\Domain\Model\Model;

interface CarsRepository
{
    public function findCarsBy(
        ?Brand $brand = null,
        ?Model $model = null,
        ?int $priceLessEqual = null,
        ?int $priceMoreEqual = null
    ): CarsCollection;
}