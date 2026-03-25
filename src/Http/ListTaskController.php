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
                'id'          => $task->getId(),
                'title'       => $task->getTitle()->getValue(),
                'description' => $task->getDescription(),
                'status'      => $task->getStatus()->value,
                'created_at'  => $task->getCreatedAt()->getDateTimeImmutable()->format('Y-m-d H:i:s'),
                'completed_at'=> $task->getCompletedAt()?->format('Y-m-d H:i:s'),
            ];
        }

        return json_encode($response);
    }
}