<?php

namespace App\Tests\functional\Carnovo\Cars\Infrastructure\Http\Controller;

use App\Carnovo\Cars\Infrastructure\Http\Controller\GetCarsController;
use App\Tests\FunctionalTester;
use Codeception\Module\Symfony;
use Symfony\Component\HttpFoundation\Response;

class GetCarsControllerCest
{
    private const PATH = "cars";


    protected function _inject(Symfony $symfony)
    {
    }

    public function itShouldReturnAListOfCars(FunctionalTester $I)
    {
        $I->amHttpAuthenticated("test", "test");
        $I->sendGet(self::PATH);
        $I->seeResponseCodeIs(Response::HTTP_OK);
    }

    public function itIsNotAuthenticated(FunctionalTester $I)
    {
        $I->sendGet(self::PATH);
        $I->seeResponseCodeIs(Response::HTTP_UNAUTHORIZED);
    }
}
