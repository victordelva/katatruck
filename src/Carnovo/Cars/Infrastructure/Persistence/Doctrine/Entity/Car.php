<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Doctrine\Entity;


class Car
{
    private string $brand;
    private string $model;
    private int $priceAmount;
    private string $priceCurrency;
    private int $id;

    public function __construct(
        int $id,
        string $brand,
        string $model,
        int $priceAmount,
        string $priceCurrency
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->priceAmount = $priceAmount;
        $this->priceCurrency = $priceCurrency;
        $this->id = $id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getPriceAmount(): int
    {
        return $this->priceAmount;
    }

    public function getPriceCurrency(): string
    {
        return $this->priceCurrency;
    }

    public function getId(): int
    {
        return $this->id;
    }
}