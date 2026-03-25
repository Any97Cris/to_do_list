<?php

namespace App\Domain\ValueObject;

class TaskDescription
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);
        if(strlen($value) < 15){
            throw new \InvalidArgumentException("A descrição deve ter mais de 15 caracteres");
        }

        if(strlen($value) > 500){
            throw new \InvalidArgumentException("A descrição deve ter no máximo 500 caracteres");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}