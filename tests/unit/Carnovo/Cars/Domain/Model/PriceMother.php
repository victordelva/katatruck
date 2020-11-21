<?php


namespace App\Tests\unit\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Model\Currency;
use App\Carnovo\Cars\Domain\Model\Price;
use Faker\Factory;

class PriceMother
{
    public static function random(): Price
    {
        return new Price(
            Factory::create()->numberBetween(0, 50000),
            new Currency(Currency::randomValue())
        );
    }
}