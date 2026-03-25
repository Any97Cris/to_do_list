<?php

namespace App\Domain\Enum;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed'; 
}