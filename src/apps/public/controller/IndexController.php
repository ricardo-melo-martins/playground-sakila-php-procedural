<?php

namespace APP\apps\public\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use APP\apps\public\Controller\AbstractController;

class IndexController extends AbstractController
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->logger->debug('IndexController requisitado');

        $payload = 'Welcome!';
        $response->getBody()->write($payload);
        return $response;
    }
}
