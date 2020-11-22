<?php


namespace App\Carnovo\Cars\Infrastructure\Http\Controller;

use App\Carnovo\Cars\Application\UseCase\GetCarsUseCase;
use App\Carnovo\Cars\Application\Request\GetCarsRequest;
use App\Carnovo\Shared\Infrastructure\Traits\RestResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetCarsController
{
    private const MAX_ITEMS = 10;

    use RestResponse;

    private GetCarsUseCase $getCarsUseCase;

    public function __construct(
        GetCarsUseCase $getCarsUseCase
    ) {
        $this->getCarsUseCase = $getCarsUseCase;
    }

    public function __invoke(Request $request)
    {
        $page = $request->get('page') ? (int)$request->get('page') : 1;
        if ($page < 1) $page = 1;

        $perPage = $request->get('per_page') ? (int)$request->get('per_page') : self::MAX_ITEMS;
        if ($perPage < 1) $perPage = self::MAX_ITEMS;

        $cars = ($this->getCarsUseCase)(new GetCarsRequest(
            $request->get("brand"),
            $request->get("model"),
            $request->get("lessPrice"),
            $request->get("morePrice"),
            $request->get('orderBy'),
            $page,
            $perPage
        ));

        return $this->buildResponse($request, Response::HTTP_OK, [
            "per_page" => $perPage,
            "page" => $page,
            "items" => $cars,
            // TODO add total
        ]);
    }
}