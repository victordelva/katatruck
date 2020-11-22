<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Doctrine\Entity;


final class Car
{
    private string $brand;
    private string $model;
    private int $priceAmount;
    private string $priceCurrency;
    private string $id;

    public function __construct(
        string $id,
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

    public function getId(): string
    {
        return $this->id;
    }

    public function changePriceAmount(int $priceAmount): void
    {
        $this->priceAmount = $priceAmount;
    }

    public function changePriceCurrency(string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }
}