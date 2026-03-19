<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Router;
use App\Http\Controller\CreateTaskController;
use App\Http\Controller\ListTaskController;
use App\Http\Controller\CompleteTaskController;
use App\Application\TaskService;
use App\Http\ExceptionHandler;
use App\Infrastructure\Persistence\InMemoryTaskRepository;

$repository = new InMemoryTaskRepository();
$taskService = new TaskService($repository);

$router = new Router();

$router->add('GET', '/tasks', fn() => (new ListTaskController($taskService))->handle());
$router->add('POST', '/tasks', fn() => (new CreateTaskController($taskService))->handle());
$router->add('PUT', '/tasks/{id}', fn($id) => (new CompleteTaskController($taskService))->handle($id));

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['REQUEST_URI'];
    echo $router->dispatch($method, $path);
} catch (\Throwable $e){
    ExceptionHandler::handle($e);
}
