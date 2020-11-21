<?php


namespace App\Carnovo\Cars\Domain\Exception;

use Exception;

class InvalidCurrency extends Exception
{
    public function __construct(string $value)
    {
        parent::__construct(sprintf('Invalid currency {%s}', $value));
    }
}