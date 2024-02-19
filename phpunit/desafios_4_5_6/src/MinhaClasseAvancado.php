<?php

class MinhaClasseAvancado
{
    public static function somar($a, $b)
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException("Ambos os argumentos devem ser numéricos.");
        }
        return $a + $b;
    }

    public static function subtrair($a, $b)
    {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException("Ambos os argumentos devem ser numéricos.");
        }
        return $a - $b;
    }
}

