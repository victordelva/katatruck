<?php


namespace App\Carnovo\Cars\Domain\Model;


class Car
{
    private Brand $brand;
    private Model $model;
    private Price $price;

    public function __construct(
        Brand $brand,
        Model $model,
        Price $price
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->price = $price;
    }

    public function getBrand(): Brand
    {
        return $this->brand;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }
}