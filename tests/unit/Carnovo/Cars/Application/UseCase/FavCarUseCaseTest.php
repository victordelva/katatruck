<?php

namespace App\Carnovo\Cars\Application\UseCase;


use App\Carnovo\Cars\Application\Request\FavCarRequest;
use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Interfaces\UserCarsRepository;
use App\Tests\unit\Carnovo\Cars\Domain\Model\CarMother;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;

class FavCarUseCaseTest extends TestCase
{
    use ProphecyTrait;

    /** @var CarsRepository|\Prophecy\Prophecy\ObjectProphecy */
    private $carsRepository;
    private FavCarUseCase $sut;
    /** @var UserCarsRepository|\Prophecy\Prophecy\ObjectProphecy */
    private $userCarsRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->carsRepository = $this->prophesize(CarsRepository::class);
        $this->userCarsRepository = $this->prophesize(UserCarsRepository::class);
        $this->sut = new FavCarUseCase(
            $this->carsRepository->reveal(),
            $this->userCarsRepository->reveal()
        );
    }

    public function testItReturnsCars(): void
    {
        $faker = Factory::create();
        $car = CarMother::random();
        $this->carsRepository
            ->findById(Argument::any())
            ->willReturn($car)
            ->shouldBeCalledOnce();

        $this->userCarsRepository
            ->favOrUnfavCar(Argument::any(), Argument::any(), true)
            ->shouldBeCalledOnce();

        ($this->sut)(new FavCarRequest(
            $faker->name,
            $faker->text(10),
            true
        ));

        self::assertTrue(true);
    }

}
