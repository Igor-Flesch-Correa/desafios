<?php
/**
 * @param $pede
 * @return tamanho nxn
 */



function pedeDimensao(string $mensagem)
{
    $tam = readline($mensagem);
    echo "\n {$tam} \n";

    $padrao = '/^\d+x\d+$/';//padrao exemplo 1x1

    // preg_match Testa se a string corresponde ao padrão
    
    if (0 == preg_match($padrao, $tam))//se nao segue padrao volta 0
    {
        echo "\nescreveu no formato errado 😠 tente de novo como por exemplo: 5x5\n\n";
        pedeDimensao($mensagem);
    } else {
        echo "escreveu certo 👍  ";
        return $tam;
    }
}
