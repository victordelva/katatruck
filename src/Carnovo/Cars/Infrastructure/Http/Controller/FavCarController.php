<?php


namespace App\Carnovo\Cars\Infrastructure\Http\Controller;


use App\Carnovo\Cars\Application\Request\FavCarRequest;
use App\Carnovo\Cars\Application\UseCase\FavCarUseCase;
use App\Carnovo\Cars\Domain\Exception\CarNotFound;
use App\Carnovo\Shared\Infrastructure\Traits\RestResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FavCarController
{
    use RestResponse;

    private FavCarUseCase $favCarUseCase;

    public function __construct(
        FavCarUseCase $favCarUseCase
    ) {
        $this->favCarUseCase = $favCarUseCase;
    }

    public function __invoke(Request $request): Response
    {
        $body = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->buildErrorResponse($request, Response::HTTP_BAD_REQUEST, "CE-00001", "Bad json body");
        }

        try {
            ($this->favCarUseCase)(new FavCarRequest(
                $request->getUser(),
                $request->get('id'),
                $body['fav'] ?? false
            ));
        } catch (CarNotFound $exception) {
            return $this->buildErrorResponse($request, Response::HTTP_NOT_FOUND, "CE-00404", $exception->getMessage());
        }

        return $this->buildVoidResponse($request, Response::HTTP_OK);
    }
}