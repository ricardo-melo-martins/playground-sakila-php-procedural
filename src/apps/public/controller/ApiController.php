<?php

namespace APP\apps\public\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use APP\apps\public\Controller\AbstractController;

class ApiController extends AbstractController
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->logger->debug('ApiController requisitado');

        $payload = json_encode(['message'=>'Welcome!']);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
