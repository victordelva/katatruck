<?php

namespace App\Carnovo\Cars\Application\UseCase;


use App\Carnovo\Cars\Application\Request\GetCarsRequest;
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
            ->findCarsBy(Argument::any(),Argument::any(), Argument::any(), Argument::any())
            ->willReturn(new CarsCollection([CarMother::random()]))
            ->shouldBeCalledOnce();

        $cars = ($this->sut)(new GetCarsRequest(
            null,
            null,
            null,
            null
        ));

        self::assertContains(CarsCollectionResponse::class, get_class($cars));
    }

}
