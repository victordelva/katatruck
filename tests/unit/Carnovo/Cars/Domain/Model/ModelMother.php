<?php


namespace App\Tests\unit\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Model\Model;
use Faker\Factory;

class  ModelMother
{
    public static function random(): Model
    {
        return new Model(Factory::create()->name);
    }
}