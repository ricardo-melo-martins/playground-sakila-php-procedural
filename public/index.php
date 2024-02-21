<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Psr\Container\ContainerInterface;

use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;


use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use function DI\autowire;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;

use APP\common\handlers\response\JsonResponse;

use APP\apps\public\Controller\AbstractController;

require __DIR__.'../../src/core/bootstrap.php';


$settings = [];

$settings['logger'] = [
    // Log file location
    'path' => __DIR__ . '/../tmp/logs',
    // Default log level
    'level' => \Psr\Log\LogLevel::DEBUG,
];

$container_config = [

  'settings' => fn ($setting) =>  $settings,

  App::class => function (ContainerInterface $container) {

      $app = AppFactory::createFromContainer($container);

      $app->addBodyParsingMiddleware();

      (require __DIR__ . '../../src/apps/public/routes/public.php')($app);

      return $app;
  },
  LoggerInterface::class => function (ContainerInterface $container) {

    $settings = $container->get('settings')['logger'];
    $logger = new Logger('app');

    $filename = sprintf('%s/app.log', $settings['path']);
    $level = $settings['level'];

    $rotatingFileHandler = new RotatingFileHandler($filename, 0, $level, true, 0777);
    $rotatingFileHandler->setFormatter(new LineFormatter(null, null, false, true));

    $logger->pushHandler($rotatingFileHandler);

    return $logger;
  },
  AbstractController::class => function (ContainerInterface $container) {
      return new AbstractController(
          $container
      );
  },
];


$container = (new ContainerBuilder())
    ->addDefinitions($container_config)
    ->build();


$app = $container->get(App::class);

$app->run();
