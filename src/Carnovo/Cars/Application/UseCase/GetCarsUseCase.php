<?php


namespace App\Carnovo\Cars\Application\UseCase;

use App\Carnovo\Cars\Application\Request\GetCarsRequest;
use App\Carnovo\Cars\Application\Response\CarsCollectionResponse;

class GetCarsUseCase
{
    public function __construct()
    {

    }

    public function __invoke(GetCarsRequest $getCarsRequest): CarsCollectionResponse
    {
        return new CarsCollectionResponse([]);
    }
}