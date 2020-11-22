<?php


namespace App\Carnovo\Cars\Application\Request;


class GetCarsRequest
{
    private ?string $brand;
    private ?string $model;
    private ?int $priceLessEqualThan;
    private ?int $priceMoreEqualThan;
    private ?string $orderBy;
    private int $page;
    private int $perPage;

    public function __construct(
        ?string $brand,
        ?string $model,
        ?int $priceLessEqualThan,
        ?int $priceMoreEqualThan,
        ?string $orderBy,
        int $page = 1,
        int $perPage = 10
    ) {
        $this->brand = $brand;
        $this->model = $model;
        $this->priceLessEqualThan = $priceLessEqualThan;
        $this->priceMoreEqualThan = $priceMoreEqualThan;
        $this->orderBy = $orderBy;
        $this->page = $page;
        $this->perPage = $perPage;
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

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}