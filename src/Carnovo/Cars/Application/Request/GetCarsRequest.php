<?php


namespace App\Carnovo\Cars\Application\Request;


class GetCarsRequest
{
    private ?string $brand;
    private ?string $model;
    private ?int $priceLessEqualThan;
    private ?int $priceMoreEqualThan;

    public function __construct(
        ?string $brand,
        ?string $model,
        ?int $priceLessEqualThan,
        ?int $priceMoreEqualThan
    ) {

        $this->brand = $brand;
        $this->model = $model;
        $this->priceLessEqualThan = $priceLessEqualThan;
        $this->priceMoreEqualThan = $priceMoreEqualThan;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getPriceLessEqualThan(): ?int
    {
        return $this->priceLessEqualThan;
    }

    public function getPriceMoreEqualThan(): ?int
    {
        return $this->priceMoreEqualThan;
    }

}