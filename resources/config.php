<?php

require_once(dirname(__DIR__, 1). '/vendor/autoload.php');

$dotenv = new Dotenv\Dotenv(dirname(__DIR__, 1));
$dotenv->load();

ob_start();
session_start();
// session_destroy();

// directory pattern
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__.DS."templates/front");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

// Database config
defined("DB_HOST") ? null : define("DB_HOST", getenv('DB_HOST'));
defined("DB_USER") ? null : define("DB_USER", getenv('DB_USERNAME'));
defined("DB_PASSWORD") ? null : define("DB_PASSWORD", getenv('DB_PASSWORD'));
defined("DB_NAME") ? null : define("DB_NAME", getenv('DB_DATABASE'));

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$admin_email = getenv('ADMIN_EMAIL');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

require_once('cart.php');
require_once('functions.php');
 
?>