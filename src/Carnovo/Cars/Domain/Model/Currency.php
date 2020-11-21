<?php


namespace App\Carnovo\Cars\Domain\Model;


use App\Carnovo\Cars\Domain\Exception\InvalidCurrency;
use App\Carnovo\Shared\Domain\ValueObjects\Enum;

class Currency extends Enum
{
    const EUR = 'eur';

    protected function throwExceptionForInvalidValue($value)
    {
        throw new InvalidCurrency($value);
    }
}