<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

use APP\apps\public\Controller\IndexController;
use APP\apps\public\Controller\ApiController;

return function (App $app)
{

  $app->get('/', IndexController::class)->setName('index');

  $app->group('/api', function (RouteCollectorProxy $group) {

      $group->get('[/]', ApiController::class)->setName('index');

  });
};
