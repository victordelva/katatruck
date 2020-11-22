<?php

namespace App\Carnovo\Cars\Application\UseCase;


use App\Carnovo\Cars\Application\Request\GetCarsRequest;
use App\Carnovo\Cars\Application\Response\CarResponse;
use App\Carnovo\Cars\Application\Response\CarsCollectionResponse;
use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Tests\unit\Carnovo\Cars\Domain\Model\CarMother;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class GetCarsUseCaseTest extends TestCase
{
    use ProphecyTrait;

    /** @var CarsRepository|\Prophecy\Prophecy\ObjectProphecy */
    private $carsRepository;
    private GetCarsUseCase $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->carsRepository = $this->prophesize(CarsRepository::class);
        $this->sut = new GetCarsUseCase(
            $this->carsRepository->reveal()
        );
    }

    public function testItReturnsCars(): void
    {
        $this->carsRepository
            ->findCarsBy(Argument::any(),Argument::any(), Argument::any(), Argument::any(), Argument::any(), Argument::any(), Argument::any())
            ->willReturn(new CarsCollection([$car = CarMother::random()]));

        $cars = ($this->sut)(new GetCarsRequest(
            null,
            null,
            null,
            null,
            null,
            1
        ));

        self::assertEquals(CarsCollectionResponse::class, get_class($cars));
        self::assertEquals($cars->getIterator()->current(), new CarResponse($car->getBrand()->getValue(), $car->getModel()->getValue(), (string)$car->getPrice()));
    }

}
