<?php 
require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();

// Login & Logout
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Password recovery
$router->get('/forgot-password', [LoginController::class, 'forgot']);
$router->post('/forgot-password', [LoginController::class, 'forgot']);
$router->get('/recover', [LoginController::class, 'recover']);
$router->post('/recover', [LoginController::class, 'recover']);

// Create account
$router->get('/create-account', [LoginController::class, 'create']);
$router->post('/create-account', [LoginController::class, 'create']);

// Confirm account
$router->get('/confirm-account', [LoginController::class, 'confirm']);
$router->get('/message', [LoginController::class, 'message']);

// Start point
$router->verifyRoutes();
?>