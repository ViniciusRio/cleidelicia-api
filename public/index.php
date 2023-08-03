<?php

use Core\App;
use Core\Repository\Recipe\RecipeRepository;
use Core\Router;

const BASE_PATH = __DIR__ . '/../';
require BASE_PATH . 'functions.php';

require base_path('vendor/autoload.php');
require base_path('bootstrap.php');

$router = new Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->addDependency('Controllers\Recipe\RecipeController', [App::resolve(RecipeRepository::class)]);

$router->route($uri, $method);


