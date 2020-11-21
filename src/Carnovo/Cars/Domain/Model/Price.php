<?php


namespace App\Carnovo\Cars\Domain\Model;


class Price
{
    private int $amount;
    private Currency $currency;

    public function __construct(
        int $amount,
        Currency $currency
    ) {

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function __toString()
    {
        return $this->getAmount() . " " . $this->getCurrency()->value();
    }
}