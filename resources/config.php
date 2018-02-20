<?php 

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__.DS."templates/front");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

// Database config
defined("DB_HOST") ? null : define("DB_HOST", "");
defined("DB_USER") ? null : define("DB_USER", "");
defined("DB_PASSWORD") ? null : define("DB_PASSWORD", "");
defined("DB_NAME") ? null : define("DB_NAME", "");

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
 
?>