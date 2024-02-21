<?php

namespace APP\Apps\Public\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use APP\Apps\Public\Controllers\AbstractController;

class ApiController extends AbstractController
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->logger->debug('ApiController requisitado');

        $payload = ['message'=>'Welcome!'];

        return $this->response->json($response, $payload);
    }
}
