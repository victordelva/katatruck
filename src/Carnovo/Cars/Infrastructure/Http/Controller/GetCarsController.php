<?php


namespace App\Carnovo\Cars\Infrastructure\Http\Controller;


use App\Carnovo\Shared\Infrastructure\Traits\RestResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetCarsController
{
    use RestResponse;

    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        return $this->buildResponse($request, Response::HTTP_OK, []);
    }
}