<?php

namespace App\Tests\functional\Carnovo\Cars\Infrastructure\Persistence\Repository;

use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Carnovo\Cars\Infrastructure\Persistence\Repository\DoctrineCarsRepository;
use App\Tests\FunctionalTester;
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
}
