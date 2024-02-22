<?php

class ListaNumerica
{
   
    public static function somarElementos(array $lista)
    {
        return array_sum($lista);
    }

    public static function encontrarMaiorElemento(array $lista)
    {
        if (empty($lista)) {
            return null;
        }
        return max($lista);
    }

    public static function encontrarMenorElemento(array $lista)
    {
        if (empty($lista)) {
            return null;
        }
        return min($lista);
    }

    public static function ordenarLista(array $lista)
    {
        sort($lista);
        return $lista;
    }

    public static function filtrarNumerosPares(array $lista)
    {
        $filtrados = array_filter($lista, function ($numero) {
            return $numero % 2 === 0;
        });

        return array_values($filtrados); 
    }

}
