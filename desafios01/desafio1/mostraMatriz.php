<?php

function mostraMatriz($matriz) {

 // Encontrar o número máximo de dígitos na matriz para formatar cada casa do mesmo tamanho
    $lista = array_merge(...$matriz);//trasforma em lista

    // strval vonverte para string,strlen ve quantos digitos,resultados salvos em lista, max ve qual o maior valor
    $digitoMaior = max(array_map('strlen', array_map('strval', $lista)));


 // ve quantos espaços por casa precisa
 foreach ($matriz as $linha)
    {
        foreach ($linha as $valor) 
        {
            // Calcular o número de espaços necessários para preencher
            $espacos = $digitoMaior - strlen($valor);//tamanhoMaior-tamanhoAtual=numeroDeEspaçosParaFicarMesmoTamanho
            
            echo str_repeat(' ', $espacos) . $valor . "|";

            $espacos = 0;
        }
        echo "\n";
    }
}

