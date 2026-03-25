<?php

namespace App\Application\DTO;

class CreateTaskDTO
{
    public function __construct(public string $title, public string $description)
    {
    }
}