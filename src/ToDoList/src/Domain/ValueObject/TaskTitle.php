<?php

namespace App\Domain\ValueObject;

class TaskTitle
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);
        if(strlen($value) < 3){
            throw new \InvalidArgumentException("O título deve ter mais de 3 caracteres");
        }

        if(strlen($value) > 120){
            throw new \InvalidArgumentException("O título deve ter no máximo 120 caracteres");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}
