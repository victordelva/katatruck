<?php


namespace App\Carnovo\Cars\Infrastructure\Http\Controller;


use App\Carnovo\Cars\Application\UseCase\GetCarsUseCase;
use App\Carnovo\Cars\Application\Request\GetCarsRequest;
use App\Carnovo\Shared\Infrastructure\Traits\RestResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetCarsController
{
    use RestResponse;

    private GetCarsUseCase $getCarsUseCase;

    public function __construct(
        GetCarsUseCase $getCarsUseCase
    ) {
        $this->getCarsUseCase = $getCarsUseCase;
    }

    public function __invoke(Request $request)
    {
        $cars = ($this->getCarsUseCase)(new GetCarsRequest(
            $request->get("brand"),
            $request->get("model"),
            $request->get("lessPrice"),
            $request->get("morePrice")
        ));
        
        return $this->buildResponse($request, Response::HTTP_OK, $cars);
    }
}