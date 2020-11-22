<?php


namespace App\Carnovo\Cars\Application\Request;


class ImportCarRequest
{
    private string $brand;
    private string $model;

    public function __construct(string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }
}