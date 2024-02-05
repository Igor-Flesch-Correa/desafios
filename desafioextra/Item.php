<?php
//ok
class Item {
    private float $peso;
    private float $utilidade;
    private int $id;

    public function __construct(float $peso, float $utilidade, int $id) {
        $this->peso = $peso;
        $this->utilidade = $utilidade;
        $this->id = $id;
    }
    public function mostrarDados() {
        echo "Peso: " . $this->peso . " - ";
        echo "Utilidade: " . $this->utilidade . " - ";
        echo "ID: " . $this->id . "\n";
    }
    public function getPeso() {
        return $this->peso;
    }
    public function getUtilidade() {
        return $this->utilidade;
    }
    public function getId() {
        return $this->id;
    }
}