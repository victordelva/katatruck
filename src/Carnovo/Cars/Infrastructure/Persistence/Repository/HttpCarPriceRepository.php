<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Repository;


use App\Carnovo\Cars\Domain\Interfaces\CarPriceRepository;
use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Model;
use App\Carnovo\Cars\Domain\Model\Price;
use App\Tests\unit\Carnovo\Cars\Domain\Model\PriceMother;

class HttpCarPriceRepository implements CarPriceRepository
{
    public function findModelPrice(Brand $brand, Model $model): Price
    {
        // TODO call actual dummy API as requested
        return PriceMother::random();
    }

}