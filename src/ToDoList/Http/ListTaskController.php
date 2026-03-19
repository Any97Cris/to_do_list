<?php

namespace App\Http\Controller;

use App\Application\TaskService;

class ListTaskController
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function handle(): string
    {
        $tasks = $this->taskService->getAllTasks();

        $response = [];

        foreach ($tasks as $task){
            $response[] = [
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'status' => $task->getStatus(),
            ];
        }

        return json_encode($response);
    }
}