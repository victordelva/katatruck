<?php


namespace App\Carnovo\Cars\Domain\Interfaces;


use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Model;
use App\Carnovo\Cars\Domain\Model\Price;

interface CarPriceRepository
{
    public function findModelPrice(Brand $brand, Model $model): Price;
}