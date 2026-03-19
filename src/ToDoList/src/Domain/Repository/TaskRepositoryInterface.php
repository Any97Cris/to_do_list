<?php

namespace App\Domain\Repository;
use App\Domain\Entity\Task;

interface TaskRepositoryInterface
{
    public function save(Task $task): void;

    public function findById(string $id): ?Task;

    public function findAll(): array;
}
