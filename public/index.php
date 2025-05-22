<?php

session_start();

use Src\Container;
use Src\Controller\UserController;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = new Container();
$controller = $container->get(UserController::class);

// Parse URI path only (strip query parameters)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Trim base path from URI to match clean routes
$basePath = '/BasicRegistration/public';
$route = str_replace($basePath, '', $uri);

if ($route === '/' && $method === 'GET') {
    $controller->showRegistrationForm();
} elseif ($route === '/register' && $method === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];
    $controller->register($data);
} else {
    http_response_code(404);
    echo "404 Not Found. Routing: $method $route";
}