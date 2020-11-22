<?php


namespace App\Carnovo\Cars\Infrastructure\Persistence\Repository;


use App\Carnovo\Cars\Domain\Interfaces\CarPriceRepository;
use App\Carnovo\Cars\Domain\Model\Brand;
use App\Carnovo\Cars\Domain\Model\Currency;
use App\Carnovo\Cars\Domain\Model\Model;
use App\Carnovo\Cars\Domain\Model\Price;
use GuzzleHttp\ClientInterface;

class HttpCarPriceRepository implements CarPriceRepository
{
    private const RANDOM_NUMBER_URL = 'http://www.randomnumberapi.com/api/v1.0/randomnumber';
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $client)
    {
        $this->httpClient = $client;
    }

    public function findModelPrice(Brand $brand, Model $model): Price
    {
        $response = $this->httpClient->request("GET", self::RANDOM_NUMBER_URL);
        $numbers = json_decode($response->getBody()->getContents(), true);

        return new Price(
            array_pop($numbers),
            Currency::random()
        );
    }

}