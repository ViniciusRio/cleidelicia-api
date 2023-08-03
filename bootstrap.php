<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Repository\Recipe\RecipeRepository;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require BASE_PATH . 'config.php';

    return new Database($config['database']);
});

$container->bind(RecipeRepository::class, function () {
    return new RecipeRepository();
});

App::setContainer($container);