<?php

class Produto
{
    public int $valor;
    public string $descricao;

    public function codigo(int $valor){
        return $valor;
    }

    public function descricao(string $descricao){
        return $descricao;
    }
}