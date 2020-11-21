<?php


namespace App\Carnovo\Cars\Application\Response;


use App\Carnovo\Shared\Domain\Collection;

class CarsCollectionResponse extends Collection
{
    protected function type(): string
    {
        return CarResponse::class;
    }
}