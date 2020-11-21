<?php


namespace App\Carnovo\Cars\Application\UseCase;

use App\Carnovo\Cars\Application\Request\GetCarsRequest;
use App\Carnovo\Cars\Application\Response\CarResponse;
use App\Carnovo\Cars\Application\Response\CarsCollectionResponse;
use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Car;
use App\Carnovo\Cars\Domain\Model\Model;

class GetCarsUseCase
{
    private CarsRepository $carsRepository;

    public function __construct(CarsRepository $carsRepository)
    {
        $this->carsRepository = $carsRepository;
    }

    public function __invoke(GetCarsRequest $getCarsRequest): CarsCollectionResponse
    {
        $cars = $this->carsRepository->findCarsBy(
            $getCarsRequest->getBrand() ? new Brand($getCarsRequest->getBrand()) : null,
            $getCarsRequest->getModel() ? new Model($getCarsRequest->getModel()) : null,
            $getCarsRequest->getPriceLessEqualThan(),
            $getCarsRequest->getPriceMoreEqualThan(),
        );

        return new CarsCollectionResponse(array_map(function (Car $car) {
            return new CarResponse(
                $car->getBrand()->getValue(),
                $car->getModel()->getValue(),
                (string)$car->getPrice()
            );
        }, $cars->__toArray()));
    }
}