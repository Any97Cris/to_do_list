<?php

namespace App\Application;

use App\Application\DTO\CreateTaskDTO;
use App\Domain\Entity\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\ValueObject\TaskTitle;
use App\Domain\ValueObject\TaskDescription;

class TaskService
{
    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function createTask(CreateTaskDTO $dto): void
    {
        $task = 
            new Task(
                new TaskTitle($dto->title),
                new TaskDescription($dto->description),
            );

        $this->taskRepository->save($task);
    }

    public function completeTask(string $id): void
    {
        $task = $this->taskRepository->findById($id);
        if (!$task) {
            throw new \RuntimeException('Task not found.');
        }
        $task->complete();
        $this->taskRepository->save($task);
    }

    public function getAllTasks(): array
    {
        return $this->taskRepository->findAll();
    }
}