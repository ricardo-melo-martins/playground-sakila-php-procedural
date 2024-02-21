<?php
namespace APP\apps\public\Controller;

use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;
use APP\common\handlers\response\JsonResponse;

abstract class AbstractController
{
    public ?LoggerInterface $logger;

    public function __construct(
        ContainerInterface $container
    ) {

        $container->injectOn($this);

        $this->logger = $container->get(LoggerInterface::class);
        $this->response = $container->get(JsonResponse::class);
    }
}
