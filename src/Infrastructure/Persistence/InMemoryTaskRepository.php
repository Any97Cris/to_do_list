<?php
namespace App\Infrastructure\Persistence;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Entity\Task;

class InMemoryTaskRepository implements TaskRepositoryInterface
{
    private array $tasks = [];

    public function save(Task $task): void
    {
        $this->tasks[$task->getId()] = $task;
    }

    public function findById(string $id): ?Task
    {
        return $this->tasks[$id] ?? null;
    }

    public function findAll(): array
    {
        return array_values($this->tasks);
    }
}