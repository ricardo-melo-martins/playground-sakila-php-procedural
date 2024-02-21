<?php

namespace APP\Apps\Public\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use APP\Apps\Public\Controllers\AbstractController;

class IndexController extends AbstractController
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->logger->debug('IndexController requisitado');

        $payload = 'Welcome!';

        return $this->response->html($response, $payload);
    }
}
