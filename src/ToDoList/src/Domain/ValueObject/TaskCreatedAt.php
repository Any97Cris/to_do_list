<?php

namespace App\Domain\ValueObject;
use DateTimeImmutable;

class TaskCreatedAt
{
    private DateTimeImmutable $value;

    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    public function getDateTimeImmutable(): DateTimeImmutable
    {
        return $this->value;
    }
}