<?php

namespace App\Http\Controller;

use App\Application\TaskService;
use App\Application\DTO\CreateTaskDTO;

class CreateTaskController
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function handle(): string
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $dto = new CreateTaskDTO($data['title'] ?? '', $data['description'] ?? '');

        $task = $this->taskService->createTask($dto);

        return json_encode(['message' => 'Task created', 'id' => $task->getId()]);
    }
}