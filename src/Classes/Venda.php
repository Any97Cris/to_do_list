<?php

require_once 'ItemVenda.php';

class Venda
{
    private array $itens = [];
    private string $status;

    public function __construct()
    {
        $this->status = 'aberta';
    }

    public function adicionarItem(ItemVenda $item): void
    {
        if ($this->status !== 'aberta') {
            throw new RuntimeException("Não é possível adicionar itens em uma venda finalizada ou cancelada.");
        }

        $this->itens[] = $item;
    }

    public function finalizar(): void
    {
        if ($this->status !== 'aberta') {
            throw new RuntimeException("A venda não pode ser finalizada.");
        }

        $this->status = 'finalizada';
    }

    public function cancelar(): void
    {
        if ($this->status === 'finalizada') {
            throw new RuntimeException("Venda já finalizada não pode ser cancelada.");
        }

        $this->status = 'cancelada';
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}