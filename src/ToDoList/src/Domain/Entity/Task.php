<?php

namespace App\Domain\Entity;
use App\Domain\ValueObject\TaskTitle;
use App\Domain\Enum\TaskStatus;
use App\Domain\ValueObject\TaskDescription;
use App\Domain\ValueObject\TaskCreatedAt;

class Task
{
    private string $id;
    private TaskTitle $title;
    private string $description;
    private TaskStatus $status;
    private TaskCreatedAt $createdAt;
    private ?\DateTimeImmutable $completedAt = null;

    public function __construct(TaskTitle $title, TaskDescription $description, TaskCreatedAt $createdAt)
    {
        $this->id = bin2hex(random_bytes(16));
        $this->title = $title;
        $this->description = $description->getValue();
        $this->status = TaskStatus::PENDING;
        $this->createdAt = $createdAt;
    }

    public function complete(): void
    {
        if($this->status === TaskStatus::COMPLETED){
            throw new \DomainException('Task is already completed.');
        }

        $this->status = TaskStatus::COMPLETED;
        $this->completedAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): TaskTitle
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

    public function getCreatedAt(): TaskCreatedAt
    {
        return $this->createdAt;
    }

    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->concludedAt;
    }
}
