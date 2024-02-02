<?php

require_once 'Conexao.php'; 


    $conexao = Conexao::conectar();

    $tabela = 'funcionarios';

    try {
        // Trunca a tabela e reinicia a contagem de sequências (IDs)
        $conexao->exec("TRUNCATE TABLE \"$tabela\" RESTART IDENTITY;");

        echo "Tabela $tabela limpa com sucesso.\n";
    } catch (PDOException $e) {
        echo "Erro ao limpar a tabela $tabela: " . $e->getMessage();
    }

?>
