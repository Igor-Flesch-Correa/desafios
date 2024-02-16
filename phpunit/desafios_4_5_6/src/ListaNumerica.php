<?php

class ListaNumerica
{
    protected $numeros = [];

    public function adicionarNumero($numero)
    {
        if (!is_numeric($numero)) {
            throw new InvalidArgumentException("O valor deve ser numérico.");
        }

        $this->numeros[] = $numero;
    }

    public function getMaximo()
    {
        return max($this->numeros);
    }

    public function getMinimo()
    {
        return min($this->numeros);
    }

    public function calcularMedia()
    {
        if (empty($this->numeros)) {
            return null;
        }

        return array_sum($this->numeros) / count($this->numeros);
    }

    public function retornaNumeros()
    {
        return $this->numeros;
    }
}
