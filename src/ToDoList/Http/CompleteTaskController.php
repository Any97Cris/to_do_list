<?php

namespace App\Http\Controller;

use App\Application\TaskService;

class CompleteTaskController
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
    }

    public function handle(): string
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;

        if (!$id) {
            throw new \InvalidArgumentException('Task ID is required.');
        }
        
        $this->taskService->completeTask($id);

        return json_encode(['message' => 'Task completed']);
    }
}