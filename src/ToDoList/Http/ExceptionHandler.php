<?php

namespace App\Http;

class ExceptionHandler
{
    public static function handle(\Throwable $e): void
    {
        if($e instanceof \DomainException){
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
            return;
        }

        if($e instanceof \RuntimeException){
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
            return;
        }

        http_response_code(500);
        echo json_encode(['error' => 'Internal Server Error']);
    }
}