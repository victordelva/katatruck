<?php


namespace App\Carnovo\Cars\Application\Request;


class ImportCarRequest
{
    private string $brand;
    private string $model;
    private string $id;

    public function __construct(string $id, string $brand, string $model)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->id = $id;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }
    
    public function getId(): string
    {
        return $this->id;
    }
}