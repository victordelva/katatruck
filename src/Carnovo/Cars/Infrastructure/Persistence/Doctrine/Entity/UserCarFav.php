<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Doctrine\Entity;


final class UserCarFav
{
    private string $userName;
    private string $carId;
    private int $id;

    public function __construct(string $userName, string $carId)
    {
        $this->userName = $userName;
        $this->carId = $carId;
    }
}