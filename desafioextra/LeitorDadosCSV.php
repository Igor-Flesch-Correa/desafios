<?php
//ok
class LeitorDadosCSV {
    private $capacidadeMochila;
    private $itens = [];

    public function __construct($arquivo) {
        $ponteiro = fopen($arquivo, 'r');
        if (!$ponteiro) {
            die("Não foi possível abrir o arquivo");
        }

        // Lê a primeira linha para definir a capacidade da mochila
        $linha = fgets($ponteiro);
        if ($linha !== false) {
            $campos = preg_split('/\s+/', trim($linha));
            $this->capacidadeMochila = $campos[1];
        }

        $id = 0;
        while (($linha = fgets($ponteiro)) !== FALSE) {
            $campos = preg_split('/\s+/', trim($linha));
            if (count($campos) >= 2) {
                // Incrementa o ID para cada item lido
                $id++;
                // Adiciona o item à lista de itens, assumindo que os campos estão na ordem correta
                $this->itens[] = new Item((float)$campos[0], (float)$campos[1], $id);
            }
        }

        fclose($ponteiro);
    }

    public function retornarCapacidade() {
        return $this->capacidadeMochila;
    }

    public function retornarItens() {
        return $this->itens;
    }
}
