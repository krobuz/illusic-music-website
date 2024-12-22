<?php
session_start();
require_once 'config/Database.php';
require_once 'models/User.php';
require_once 'controllers/AuthController.php';
require_once 'routes.php';

$database = new Database();
$db = $database->getConnection();
$router = new Router($db);

// Define routes
$router->addRoute('GET', '/music_website/login', function() {
    include 'views/login.php';
});

$router->addRoute('GET', '/music_website/register', function() {
    include 'views/register.php';
});

$authController = new AuthController($db);

$router->addRoute('POST', '/music_website/register', [$authController, 'register']);
$router->addRoute('POST', '/music_website/login', [$authController, 'login']);
$router->addRoute('GET', '/music_website/logout', [$authController, 'logout']);

// Handle the request
$router->handleRequest();