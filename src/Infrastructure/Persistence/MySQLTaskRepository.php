<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Task;
use App\Domain\Enum\TaskStatus;
use App\Domain\Repository\TaskRepositoryInterface;

class MySQLTaskRepository implements TaskRepositoryInterface
{
    public function __construct(private \PDO $pdo)
    {
    }

    public function save(Task $task): void
    {
        $sql = "
            INSERT INTO tasks (id, title, description, status, created_at, completed_at)
            VALUES (:id, :title, :description, :status, :created_at, :completed_at)
            ON DUPLICATE KEY UPDATE
                status       = VALUES(status),
                completed_at = VALUES(completed_at)
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id'           => $task->getId(),
            'title'        => $task->getTitle()->getValue(),
            'description'  => $task->getDescription(),
            'status'       => $task->getStatus()->value,
            'created_at'   => $task->getCreatedAt()->getDateTimeImmutable()->format('Y-m-d H:i:s'),
            'completed_at' => $task->getCompletedAt()?->format('Y-m-d H:i:s'),
        ]);
    }

    public function findById(string $id): ?Task
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $this->hydrate($row);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return array_map([$this, 'hydrate'], $stmt->fetchAll());
    }

    private function hydrate(array $row): Task
    {
        return Task::reconstitute(
            $row['id'],
            $row['title'],
            $row['description'],
            TaskStatus::from($row['status']),
            new \DateTimeImmutable($row['created_at']),
            $row['completed_at'] ? new \DateTimeImmutable($row['completed_at']) : null
        );
    }
}
