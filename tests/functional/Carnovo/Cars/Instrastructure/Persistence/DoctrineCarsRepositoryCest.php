<?php

namespace App\Tests\functional\Carnovo\Cars\Infrastructure\Persistence\Repository;

use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Carnovo\Cars\Infrastructure\Persistence\Repository\DoctrineCarsRepository;
use App\Tests\FunctionalTester;
use App\Tests\unit\Carnovo\Cars\Domain\Model\CarMother;
use Codeception\Module\Symfony;

class DoctrineCarsRepositoryCest
{
    private ?CarsRepository $carsRepository;

    protected function _inject(Symfony $symfony)
    {
        $this->carsRepository = $symfony->_getContainer()->get(DoctrineCarsRepository::class);
    }

    public function itShouldReturnCars(FunctionalTester $I)
    {
        $cars = $this->carsRepository->findCarsBy();
        $I->assertEquals(CarsCollection::class, get_class($cars));
    }

    public function itShouldSaveCarAndFindIt(FunctionalTester $I)
    {
        $car = CarMother::random();
        $this->carsRepository->save($car);

        $carFound = $this->carsRepository->findById($car->getCarId());
        $I->assertEquals($car, $carFound);
    }
}
