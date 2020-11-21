<?php


namespace App\Carnovo\Cars\Domain\Model;


use App\Carnovo\Shared\Domain\Collection;

class CarsCollection extends Collection
{
    protected function type(): string
    {
        return Car::class;
    }
}