<?php


namespace App\Carnovo\Cars\Application\UseCase;


use App\Carnovo\Cars\Application\Request\ImportCarRequest;
use App\Carnovo\Cars\Domain\Interfaces\CarPriceRepository;
use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Car;
use App\Carnovo\Cars\Domain\Model\Model;

final class ImportCarsUseCase
{
    private CarsRepository $carsRepository;
    private CarPriceRepository $carPriceRepository;

    public function __construct(
        CarsRepository $carsRepository,
        CarPriceRepository $carPriceRepository
    ) {

        $this->carsRepository = $carsRepository;
        $this->carPriceRepository = $carPriceRepository;
    }

    public function __invoke(ImportCarRequest $request) : void
    {
        $brand = new Brand($request->getBrand());
        $model = new Model($request->getModel());
        $price = $this->carPriceRepository->findModelPrice($brand, $model);

        $this->carsRepository->save(new Car($brand, $model, $price));
    }
}