<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Repository;


use App\Carnovo\Cars\Domain\Interfaces\UserCarsRepository;
use App\Carnovo\Cars\Domain\Model\Car as CarDomain;
use App\Carnovo\Cars\Domain\Model\User;
use App\Carnovo\Cars\Infrastructure\Persistence\Doctrine\Entity\UserCarFav;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineUserCarsRepository implements UserCarsRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function favOrUnfavCar(User $user, CarDomain $car, bool $favOrUnfav): void
    {
        $userCarFav = $this->entityManager->createQueryBuilder()
            ->select('ucf')
            ->from(UserCarFav::class, 'ucf')
            ->where('ucf.userName = :userName')
            ->andWhere('ucf.carId = :carId')
            ->setParameter('userName', $user->getUsername())
            ->setParameter('carId', $car->getCarId()->getValue())
            ->getQuery()
            ->getResult();

        if ($favOrUnfav && empty($userCarFav)) {
            $userCarFav = new UserCarFav($user->getUsername(), $car->getCarId()->getValue());
            $this->entityManager->persist($userCarFav);
            $this->entityManager->flush();
        } elseif (!$favOrUnfav && !empty($userCarFav)) {
            $this->entityManager->remove(array_pop($userCarFav));
            $this->entityManager->flush();
        }
    }
}