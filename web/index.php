<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__.'/../vendor/autoload.php'; 
require_once __DIR__.'/../app/provider/provider.php';
require_once __DIR__.'/../app/routing/routing.php';

$app->run(); 