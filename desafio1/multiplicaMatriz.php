<?php
/**
 * @param array $matrizA
 * @param array $matrizB
 * @return array matriz resultante
 */


function multiplicaMatriz(array $matrizA,array $matrizB)
{
$lA = count($matrizA);
$cA = count($matrizA[0]);
$lB = count($matrizB);
$cB = count($matrizB[0]);
//inicializa matriz resposta
$resultado = array_fill(0, $lA, array_fill(0, $cB, 0));
//calcula e coloca valores
for ($i = 0; $i < $lA; $i++) {
    for ($j = 0; $j < $cB; $j++) {
        for ($k = 0; $k < $cA; $k++) {
            $resultado[$i][$j] += $matrizA[$i][$k] * $matrizB[$k][$j];
        }
    }
}

return $resultado;


return $resultado;
}