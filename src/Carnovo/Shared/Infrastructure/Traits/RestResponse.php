<?php

namespace App\Carnovo\Shared\Infrastructure\Traits;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

trait RestResponse
{
    private $serializer;

    public function buildResponse(Request $request, int $httpCode, $body): Response
    {
        list($headers, $format) = $this->getHeadersAndFormat($request);

        $content = $this->getSerializer()->serialize($body, $format);

        return new Response($content, $httpCode, $headers);
    }

    public function buildVoidResponse(Request $request, int $httpCode): Response
    {
        list($headers) = $this->getHeadersAndFormat($request);

        return new Response('', $httpCode, $headers);
    }

    public function buildErrorResponse(
        Request $request,
        int $httpCode,
        string $code,
        string $message
    ): Response {
        list($headers, $format) = $this->getHeadersAndFormat($request);

        $payload                = [
            [
                'code'   => $code,
                'message'  => $message,
            ],
        ];

        $content = $this->getSerializer()->serialize($payload, $format);

        return new Response($content, $httpCode, $headers);
    }

    private function getHeadersAndFormat(Request $request): array
    {
        $headers = ['Content-Type' => 'application/json'];
        $format  = 'json';
        if (true === $request->headers->has('Content-Type')) {
            $contentType = $request->headers->get('Content-Type');
            if ('application/xml' === $contentType) {
                $format                  = 'xml';
                $headers['Content-Type'] = 'application/xml';
            }
        }

        return [$headers, $format];
    }

    private function getSerializer(): Serializer
    {
        if (empty($this->serializer)) {
            $encoders    = [new XmlEncoder(), new JsonEncoder()];
            $normalizers = [
                new DateTimeNormalizer(),
                new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter()),
            ];
            $this->serializer = new Serializer($normalizers, $encoders);
        }
        return $this->serializer;
    }
}