<?php

namespace APP\Common\Handlers\Response;

use Psr\Http\Message\ResponseInterface;

use APP\Common\Http\HttpStatus;

final class ResponseHandler
{

    public function json(
        ResponseInterface $response,
        mixed $data = null,
        int $statusCode = HttpStatus::OK
    ): ResponseInterface {
        $response = $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus($statusCode);

        $response->getBody()->write(
            $this->jsonEncode($data)
        );

        return $response;
    }

    public function html(
      ResponseInterface $response,
      mixed $data = null,
      int $statusCode = HttpStatus::OK
  ): ResponseInterface {
      $response = $response
                      ->withHeader('Content-Type', 'text/html')
                      ->withStatus($statusCode);

      $response->getBody()->write(
          $this->htmlEncode($data)
      );

      return $response;
  }

  private function jsonEncode(mixed $data = null)
  {
    return (string)json_encode(
      $data,
      JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR
    );
  }

  private function htmlEncode(string $text, string $encoding = 'UTF-8'): string
  {
      return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, $encoding);
  }

}
