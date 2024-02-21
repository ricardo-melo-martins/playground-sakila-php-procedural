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

use APP\Apps\Public\Controllers\AbstractController;

require __DIR__.'../../src/core/bootstrap.php';


$container_config = [

  'settings' => fn ($setting) =>  (require __DIR__.'../../src/core/config/settings.php'),

  App::class => function (ContainerInterface $container) {

      $app = AppFactory::createFromContainer($container);

      (require __DIR__ . '../../src/apps/public/routes/public.php')($app);

      (require __DIR__ . '../../src/apps/public/middlewares/public.php')($app);

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
