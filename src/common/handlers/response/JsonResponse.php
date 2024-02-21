<?php

namespace APP\common\handlers\response;

use Psr\Http\Message\ResponseInterface;

final class JsonResponse
{
    public function json(
        ResponseInterface $response,
        mixed $data = null,
    ): ResponseInterface {
        $response = $response->withHeader('Content-Type', 'application/json');

        $response->getBody()->write(
            (string)json_encode(
                $data,
                JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR
            )
        );

        return $response;
    }
}
