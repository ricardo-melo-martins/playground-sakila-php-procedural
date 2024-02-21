<?php

namespace APP\Common\Handlers\Response;

use Psr\Http\Message\ResponseInterface;

use APP\Common\Http\HttpStatus;

final class ResponseHandler
{
    private function jsonEncode(mixed $data = null)
    {
      return (string)json_encode(
        $data,
        JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR
      );
    }

    public function json(
        ResponseInterface $response,
        mixed $data = null,
    ): ResponseInterface {
        $response = $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(HttpStatus::OK);

        $response->getBody()->write(
            $this->jsonEncode($data)
        );

        return $response;
    }
}
