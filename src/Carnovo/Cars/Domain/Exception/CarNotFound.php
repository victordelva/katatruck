<?php


namespace App\Carnovo\Cars\Domain\Exception;


use Exception;

final class CarNotFound extends Exception
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Car with id %id not found', $id));
    }
}