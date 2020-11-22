<?php


namespace App\Carnovo\Cars\Application\Request;


class FavCarRequest
{
    private string $username;
    private string $carId;
    private bool $favOrUnfav;

    public function __construct(string $username, string $carId, bool $favOrUnfav)
    {

        $this->username = $username;
        $this->carId = $carId;
        $this->favOrUnfav = $favOrUnfav;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getCarId(): string
    {
        return $this->carId;
    }

    public function isFavOrUnfav(): bool
    {
        return $this->favOrUnfav;
    }
}