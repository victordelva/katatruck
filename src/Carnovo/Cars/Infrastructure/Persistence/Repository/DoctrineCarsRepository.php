<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Repository;


use App\Carnovo\Cars\Domain\Exception\CarNotFound;
use App\Carnovo\Cars\Domain\Interfaces\CarsRepository;
use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Car as CarDomain;
use App\Carnovo\Cars\Domain\Model\CarId;
use App\Carnovo\Cars\Domain\Model\CarsCollection;
use App\Carnovo\Cars\Domain\Model\CarsOrderBy;
use App\Carnovo\Cars\Domain\Model\Currency;
use App\Carnovo\Cars\Domain\Model\Model;
use App\Carnovo\Cars\Domain\Model\Price;
use App\Carnovo\Cars\Infrastructure\Persistence\Doctrine\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineCarsRepository implements CarsRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findCarsBy(
        ?Brand $brand = null,
        ?Model $model = null,
        ?int $lessEqual = null,
        ?int $moreEqual = null,
        ?CarsOrderBy $orderBy = null,
        int $page = 1,
        int $perPage = 10
    ): CarsCollection {
        $query = $this->entityManager->createQueryBuilder()
            ->select('c')
            ->from(Car::class, "c")
        ;

        if (!is_null($brand)) {
            $query->andWhere("c.brand = :brand")
                ->setParameter("brand", $brand->getValue());
        }

        if (!is_null($model)) {
            $query->andWhere("c.model = :model")
                ->setParameter("model", $model->getValue());
        }

        if (!is_null($lessEqual)) {
            $query->andWhere("c.priceAmount <= :less")
                ->setParameter("less", $lessEqual);
        }

        if (!is_null($moreEqual)) {
            $query->andWhere("c.priceAmount >= :more")
                ->setParameter("more", $moreEqual);
        }

        $orderByMapped = $this->getOderByMapping($orderBy);
        if (!is_null($orderByMapped)) {
            $query->orderBy(sprintf("c.%s",$orderByMapped));
        }

        $query->setMaxResults($perPage)
            ->setFirstResult($perPage*$page);

        $result = $query
            ->getQuery()
            ->getResult();

        return new CarsCollection(array_map(function (Car $car) {
            return $this->carDomainFromCar($car);
        }, $result));
    }

    public function save(CarDomain $carDomain): void
    {
        /** @var Car $car */
        $car = $this->entityManager->find(Car::class, $carDomain->getCarId()->getValue());

        if (is_null($car)) {
            $car = new Car(
                $carDomain->getCarId()->getValue(),
                $carDomain->getBrand()->getValue(),
                $carDomain->getModel()->getValue(),
                $carDomain->getPrice()->getAmount(),
                $carDomain->getPrice()->getCurrency()->getValue()
            );
        } else {
            $car->changePriceAmount($carDomain->getPrice()->getAmount());
            $car->changePriceCurrency($carDomain->getPrice()->getCurrency());
        }

        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }

    public function findById(CarId $carId): CarDomain
    {
        /** @var Car $car */
        $car = $this->entityManager->find(Car::class, $carId->getValue());

        if (!is_null($car)) {
            return $this->carDomainFromCar($car);
        }

        throw new CarNotFound($carId->getValue());
    }

    private function carDomainFromCar(Car $car): CarDomain
    {
        return new CarDomain(
            new CarId($car->getId()),
            new Brand($car->getBrand()),
            new Model($car->getModel()),
            new Price($car->getPriceAmount(), new Currency($car->getPriceCurrency()))
        );
    }

    private function getOderByMapping(?CarsOrderBy $orderBy): ?string
    {
        if (is_null($orderBy)) return null;

        switch ($orderBy->getValue()) {
            case "brand":
                return "brand";
            case "model":
                return "model";
            case "price":
                return "priceAmount";
            default:
                return null;
        }
    }
}