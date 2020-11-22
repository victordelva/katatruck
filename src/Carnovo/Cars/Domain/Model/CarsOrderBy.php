<?php


namespace App\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Exception\InvalidOrderBy;
use App\Carnovo\Shared\Domain\ValueObjects\Enum;

class CarsOrderBy extends Enum
{
    const BRAND = "brand";
    const MODEL = "model";
    const PRICE = "price";

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidOrderBy($value);
    }
}