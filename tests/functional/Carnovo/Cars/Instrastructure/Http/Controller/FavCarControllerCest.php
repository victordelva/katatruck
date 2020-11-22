<?php

namespace App\Tests\functional\Carnovo\Cars\Infrastructure\Http\Controller;

use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Infrastructure\Persistence\Repository\DoctrineCarsRepository;
use App\Tests\FunctionalTester;
use App\Tests\unit\Carnovo\Cars\Domain\Model\CarMother;
use Codeception\Module\Symfony;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class FavCarControllerCest
{
    private const PATH = "cars/%s";
    private CarsRepository $carRepository;


    protected function _inject(Symfony $symfony)
    {
        $this->carRepository = $symfony->_getContainer()->get(CarsRepository::class);
    }

    public function itShouldReturnSuccess(FunctionalTester $I)
    {

        $car = CarMother::random();
        $this->carRepository->save($car);

        $I->amHttpAuthenticated("test", "test");
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPut(sprintf(self::PATH, $car->getCarId()->getValue()), ["fav"=> true]);
        $I->seeResponseCodeIs(Response::HTTP_OK);
    }

    public function itIsNotAuthenticated(FunctionalTester $I)
    {
        $I->sendPut(sprintf(self::PATH, $id = Factory::create()->uuid), [
            "fav"=> true
        ]);
        $I->seeResponseCodeIs(Response::HTTP_UNAUTHORIZED);
    }

    public function itReturnNotFoundCar(FunctionalTester $I)
    {
        $I->amHttpAuthenticated("test", "test");
        $I->haveHttpHeader('Content-Type','application/json');
        $I->sendPut(sprintf(self::PATH, $id = Factory::create()->uuid), [
            "fav"=> true
        ]);
        $I->seeResponseCodeIs(Response::HTTP_NOT_FOUND);
    }
}
