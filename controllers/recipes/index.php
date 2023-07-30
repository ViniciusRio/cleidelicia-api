<?php
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$result = $db->query("SELECT * FROM cleidelicia.recipes")->fetchAll();

response($result);