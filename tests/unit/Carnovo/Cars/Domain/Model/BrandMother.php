<?php


namespace App\Tests\unit\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Model\Brand;
use Faker\Factory;

class BrandMother
{
    public static function random(): Brand
    {
        return new Brand(Factory::create()->name);
    }
}