<?php


namespace App\Carnovo\Cars\Domain\Interfaces;


use App\Carnovo\Cars\Domain\Model\Car;
use App\Carnovo\Cars\Domain\Model\User;

interface UserCarsRepository
{
    public function favOrUnfavCar(User $user, Car $car, bool $favOrUnfav): void;
}