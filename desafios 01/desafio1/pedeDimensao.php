<?php
/**
 * @param $pede
 * @return tamanho array['linha'=>n,'coluna'=>n]
 */



function pedeDimensao(string $mensagem)
{
    $tam = readline($mensagem);//exibe pergunta(mensagem) e pega string do usuario
    echo "\n {$tam} \n";//testa entrada string

    
        $linha = $coluna = null; //inicializa com null para evitar problemas caso não seja preenchido
        // Tenta extrair os números do tam(tamanho) no fomato intxint
        if (sscanf($tam, "%dx%d", $linha, $coluna) === 2) //numero de atribuiçoes bem sucedidas
        {
            echo "escreveu certo 👍  \n";
            return ['linha' => $linha, 'coluna' => $coluna];//array com os inteiros linha coluna

        } 

            echo "\nescreveu no formato errado 😠 tente de novo como por exemplo: 5x5\n\n";
            return pedeDimensao($mensagem); //lembrar de retornar chamadas recursivas
            
        
}
    
    /* PRIMEIRA TENTATIVA a de cima já deixa em formato inteiro
    
    $padrao = '/^\d+x\d+$/';//padrao exemplo 1x1

    // preg_match Testa se a string corresponde ao padrão
    
    if (0 == preg_match($padrao, $tam))//se nao segue padrao volta 0
    {
        echo "\nescreveu no formato errado 😠 tente de novo como por exemplo: 5x5\n\n";
        pedeDimensao($mensagem);
    } else {
        echo "escreveu certo 👍  ";
        return $tam;
    }*/

