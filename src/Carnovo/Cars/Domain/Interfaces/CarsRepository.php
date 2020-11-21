<?php


namespace App\Carnovo\Cars\Domain\Interfaces;


use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Carnovo\Cars\Domain\Model\Model;
use App\Carnovo\Cars\Domain\Model\Price;

interface CarsRepository
{
    public function findCarsBy(
        ?Brand $brand = null,
        ?Model $model = null,
        ?Price $lessEqual = null,
        ?Price $moreEqual = null
    ): CarsCollection;
}