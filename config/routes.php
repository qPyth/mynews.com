<?php

use NewsSite\Controllers\AboutPageController;
use NewsSite\Controllers\HomePageController;
use NewsSite\Controllers\NewsPageRoute;
use NewsSite\Controllers\SingleNewsPageController;
use Slim\App;

return function(App $app) {
    $app->get('/', HomePageController::class. ':execute');
    $app->get('/about', AboutPageController::class.':execute');
    $app->get('/news', NewsPageRoute::class.':execute');
    $app->get('/{url_key}', SingleNewsPageController::class.':execute');
};