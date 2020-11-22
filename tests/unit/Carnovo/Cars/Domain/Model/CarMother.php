<?php


namespace App\Tests\unit\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Model\Car;
use App\Carnovo\Cars\Domain\Model\CarId;
use Faker\Factory;

class CarMother
{
    public static function random(): Car
    {
        $faker = Factory::create();

        return new Car(
            new CarId($faker->firstName),
            BrandMother::random(),
            ModelMother::random(),
            PriceMother::random()
        );
    }
}