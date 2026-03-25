<?php

namespace App\Http\Controller;

use App\Application\TaskService;

class CompleteTaskController
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function handle(string $id): string
    {
        $this->taskService->completeTask($id);

        return json_encode(['message' => 'Task completed']);
    }
}