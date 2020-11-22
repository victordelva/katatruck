<?php

namespace App\Tests\functional\Carnovo\Cars\Infrastructure\Persistence\Repository;

use App\Carnovo\Cars\Domain\Interfaces\CarPriceRepository;
use App\Carnovo\Cars\Domain\Model\Price;
use App\Carnovo\Cars\Infrastructure\Persistence\Repository\HttpCarPriceRepository;
use App\Tests\FunctionalTester;
use App\Tests\unit\Carnovo\Cars\Domain\Model\CarMother;
use Codeception\Module\Symfony;

class HttpCarPriceRepositoryCest
{
    private ?HttpCarPriceRepository $carPriceRepository;

    protected function _inject(Symfony $symfony)
    {
        $this->carPriceRepository = $symfony->_getContainer()->get(CarPriceRepository::class);
    }

    public function itShouldReturnPrice(FunctionalTester $I)
    {
        $car = CarMother::random();
        $price = $this->carPriceRepository->findModelPrice($car->getBrand(), $car->getModel());

        $I->assertEquals(Price::class, get_class($price));
    }
}
