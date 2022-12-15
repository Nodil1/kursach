<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use Api\Controllers\AuthController;
use Api\Controllers\DepartmentController;



session_start();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: *');

$path = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$controller = match ($path) {
    "department" => new DepartmentController(),
    "auth" => new AuthController()
};
echo $controller->run()->response;
