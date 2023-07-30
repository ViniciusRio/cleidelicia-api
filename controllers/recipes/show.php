<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$recipe = $db->query("SELECT * FROM cleidelicia.recipes WHERE id = :id", ['id' => $_GET['id']])->find();

response($recipe);