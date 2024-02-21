<?php
namespace APP\Apps\Public\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

use APP\Common\Handlers\Response\ResponseHandler;
use APP\Common\Http\HttpStatus;

abstract class AbstractController
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    public ?LoggerInterface $logger;

    /**
     * Response Handler
     *
     * @var ResponseHandler
     */
    protected ResponseHandler $response;

    public function __construct(
        ContainerInterface $container
    ) {

        $container->injectOn($this);

        $this->logger = $container->get(LoggerInterface::class);
        $this->response = $container->get(ResponseHandler::class);
    }

}
