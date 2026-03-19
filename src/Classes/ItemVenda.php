<?php

class ItemVenda
{
    private Produto $produto;
    private int $quantidade;
    private float $precoUnitario;

    public function getSubTotal()
    {
        return $this->quantidade * $this->precoUnitario;
    }
}