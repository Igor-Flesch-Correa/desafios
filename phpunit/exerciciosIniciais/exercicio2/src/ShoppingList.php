<?php

class ShoppingList
{
    private $itens = [];

    public function addItem($item)
    {
        // Adiciona um item à lista de compras
        $this->itens[] = $item;
    }

    public function getitens()
    {
        // Retorna todos os itens da lista de compras
        return $this->itens;
    }

    public function removeItem($index)
    {
        // Verifica se o índice existe e remove o item
        if (isset($this->itens[$index])) {
            array_splice($this->itens, $index, 1);
        }
    }

    public function clearitens()
    {
        // Limpa todos os itens da lista de compras
        $this->itens = [];
    }
}

/*
a) Qual é o propósito da classe ShoppingList?

o propósito da classe ShoppingList é gerenciar uma lista 
de compras onde se  é permitido adicionar e remover produtos

b) Quais são os métodos disponíveis na classe ShoppingList e o que cada um
deles faz?

addItem - adiciona item ao array itens

getItens - retorna o array com os itens

removeItem - remove um item do array usando um indice de referencia e reorganiza array para manter a sequencia do indice

clearitens - apaga todos os itens de dentro do array

c) Explique o que é testado no método testAddItem()

testa se a quantidade de itens aumentou em 1 depois de adicionar
e se o ultimo item correspode ao adicionado

d) Qual é a finalidade do método testRemoveItem() e o que ele verifica?

ele verifica se um item removido foi removido e se o que não era pra ser removido continua lá


*/