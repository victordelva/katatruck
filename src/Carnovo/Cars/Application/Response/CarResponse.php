<?php


namespace App\Carnovo\Cars\Application\Response;


class CarResponse
{
    private string $brand;
    private string $model;
    private string $price;

    public function __construct(
        string $brand,
        string $model,
        string $price
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getPrice(): string
    {
        return $this->price;
    }
}