<?php
const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';
require BASE_PATH . 'Database.php';

$config = require BASE_PATH . 'config.php';
$db = new Database($config['database']);

phpinfo();