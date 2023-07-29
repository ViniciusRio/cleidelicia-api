<?php
use Core\Database;
$config = require BASE_PATH . 'config.php';
$db = new Database($config['database']);
$result = $db->query("SELECT * FROM cleidelicia.recipes")->fetchAll();

dd($result);