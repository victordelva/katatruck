<?php


namespace App\Tests\unit\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Model\Car;

class CarMother
{
    public static function random(): Car
    {
        return new Car(
            BrandMother::random(),
            ModelMother::random(),
            PriceMother::random()
        );
    }
}