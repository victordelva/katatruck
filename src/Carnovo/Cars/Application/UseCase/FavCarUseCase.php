<?php


namespace App\Carnovo\Cars\Application\UseCase;


use App\Carnovo\Cars\Application\Request\FavCarRequest;
use App\Carnovo\Cars\Domain\Exception\CarNotFound;
use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Interfaces\UserCarsRepository;
use App\Carnovo\Cars\Domain\Model\CarId;
use App\Carnovo\Cars\Domain\Model\User;

final class FavCarUseCase
{
    private CarsRepository $carsRepository;
    private UserCarsRepository $userCarsRepository;

    public function __construct(
        CarsRepository $carsRepository,
        UserCarsRepository $userCarsRepository
    ) {
        $this->carsRepository = $carsRepository;
        $this->userCarsRepository = $userCarsRepository;
    }

    /** @throws CarNotFound */
    public function __invoke(FavCarRequest $favCarRequest): void
    {
        $car = $this->carsRepository->findById(new CarId($favCarRequest->getCarId()));
        $user = new User($favCarRequest->getUsername());

        $this->userCarsRepository->favOrUnfavCar($user, $car, $favCarRequest->isFavOrUnfav());
    }
}