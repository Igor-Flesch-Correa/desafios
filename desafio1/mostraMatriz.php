<?php
/**
 * @param $matriz
 * @return void
 */

function mostraMatriz($matriz)
{
//mostra grade atual
            foreach ($matriz as $l) {
                foreach ($l as $valor) {
                    echo $valor . "|"; 
                }
                echo "\n"; 
            }
}