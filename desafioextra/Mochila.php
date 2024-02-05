<?php
class Mochila {
    private $itens = [];
    private $capacidade;

    public function __construct($capacidade) {
        $this->capacidade = $capacidade;
    }

    public function adicionaItem(Item $item) 
    {

        //só adiciona se o item não ultrapassar a capacidade da mochila 
        //e tambem se já não tem um com o mesmo id
        foreach ($this->itens as $itemExistente) {
            if ($itemExistente->getId() === $item->getId()) {
                // Item com o mesmo ID já existe, não adiciona
                return false;
            }
        }

        // Verifica se o item ultrapassa a capacidade da mochila
        if (($this->getTotalPeso() + $item->getPeso() <= $this->capacidade)) {
            $this->itens[] = $item;
            return true;
        }

        return false;
     }

     public function removeItemAleatorio() {
        if (count($this->itens) > 0) {
            $indice = array_rand($this->itens);
            unset($this->itens[$indice]);
        }
     }

    public function getTotalPeso() {
        $totalPeso = 0;
        foreach ($this->itens as $item) {
            $totalPeso += $item->getPeso();
        }
        return $totalPeso;
    }

    public function getTotalUtilidade() {
         $totalUtilidade = 0;
        foreach ($this->itens as $item) {
            $totalUtilidade += $item->getUtilidade();
        }
        return $totalUtilidade;
    }
    public function mostrarItens() {
        foreach ($this->itens as $item) {
            $item->mostrarDados();
        }
    }
    public function getItens() {
        return $this->itens;
    }

    
}