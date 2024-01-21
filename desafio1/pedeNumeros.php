<?php
/**
 * @param array array['linha'=>n,'coluna'=>n]
 * @param string nome matriz (ex:primeira)
 * @return array matriz
 */

require_once __DIR__.'/mostraMatriz.php';

//inserir dados na matriz, mostrar grade 

function pedeNumeros($dimensao,$nom_matriz)
{$l = $dimensao["linha"];
 $c = $dimensao["coluna"];
 echo "\nteste entrada pedeNumero linhas:{$l} colunas:{$c}\n";//teste
 

            $matriz = array();// inicializa matriz, enche com zero e mostra

            $matriz = array_fill(0, $l, array_fill(0, $c, 0));
            echo "\n teste inicizlização matriz zero:\n\n"; mostraMatriz($matriz); //teste

    //enche a matriz com a entrada do usuario e mostra em loop até encher
    for($i = 0; $i < $l; $i++)
    {
        for($j = 0; $j < $c; $j++)
        {
        $pede = "insira os dados da {$nom_matriz} da posicao {$i}x{$j}:";
        $matriz[$i][$j] = (int)readline($pede);
        mostraMatriz($matriz);
        }
    }
    return $matriz;
}