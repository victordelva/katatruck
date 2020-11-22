<?php


namespace App\Carnovo\Cars\Domain\Model;


class CarId
{
    private string $value;

    public function __construct(string $id)
    {
        $this->value = $id;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}