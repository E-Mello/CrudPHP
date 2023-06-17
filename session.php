<?php
define("BASE_PATH", dirname(__FILE__));
define("BASE_URL", "http://localhost/CrudPHP");
define ('SESSION_TIME', 1440);

session_name("MyAPP");
session_start([
    'cookie_lifetime' => SESSION_TIME,
]);
?>