<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Doctrine\Entity;


use App\Carnovo\Shared\Domain\Collection;

final class CarsCollection extends Collection
{
    protected function type(): string
    {
        return Car::class;
    }
}