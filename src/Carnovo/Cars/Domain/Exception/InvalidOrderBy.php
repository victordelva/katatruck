<?php


namespace App\Carnovo\Cars\Domain\Exception;


final class InvalidOrderBy extends \Exception
{
    public function __construct(string $value)
    {
        parent::__construct(sprintf("Invalid OrderBy. %s given", $value));
    }
}