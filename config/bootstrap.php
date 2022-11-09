<?php

use DevCoder\DotEnv;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
require BASE_PATH.'/vendor/autoload.php';
$builder = new ContainerBuilder();
$builder->addDefinitions(BASE_PATH.'/config/di.php');
$container = $builder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addErrorMiddleware(true, false, false);
(new DotEnv(BASE_PATH.'.env'))->load();
(require BASE_PATH.'/config/routes.php')($app);
return $app;
