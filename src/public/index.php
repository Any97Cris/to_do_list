<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Carrega variáveis do .env
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

use App\Http\Router;
use App\Http\Controller\CreateTaskController;
use App\Http\Controller\ListTaskController;
use App\Http\Controller\CompleteTaskController;
use App\Application\TaskService;
use App\Http\ExceptionHandler;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Persistence\MySQLTaskRepository;

try {
    $pdo         = Connection::getInstance();
    $repository  = new MySQLTaskRepository($pdo);
    $taskService = new TaskService($repository);

    $router = new Router();

    $router->add('GET', '/tasks',      fn()    => (new ListTaskController($taskService))->handle());
    $router->add('POST', '/tasks',     fn()    => (new CreateTaskController($taskService))->handle());
    $router->add('PUT', '/tasks/{id}', fn($id) => (new CompleteTaskController($taskService))->handle($id));

    $method = $_SERVER['REQUEST_METHOD'];
    $path   = strtok($_SERVER['REQUEST_URI'], '?');

    echo $router->dispatch($method, $path);
} catch (\Throwable $e) {
    ExceptionHandler::handle($e);
}
