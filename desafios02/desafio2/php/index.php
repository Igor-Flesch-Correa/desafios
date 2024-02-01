<?php
//docker-compose up no diretorio para subir os 2
require_once "Conexao.php";
require_once "Funcionario.php";

$conexao = new Conexao();
$funcionario = new Funcionario();

// Cadastrar funcionários
$funcionario->cadastrar("Funcionario1", 1000, 25);
$funcionario->cadastrar("Funcionario2", 1200, 30);
$funcionario->cadastrar("Funcionario3", 800, 28);
$funcionario->cadastrar("Funcionario4", 1500, 35);

// Alterar nomes e aumentar salários
$funcionario->alterarNome(1, "NovoNome1");
$funcionario->alterarNome(2, "NovoNome2");
$funcionario->alterarNome(3, "NovoNome3");
$funcionario->alterarNome(4, "NovoNome4");

$funcionario->aumentarSalario(1, 10);
$funcionario->aumentarSalario(2, 5);
$funcionario->aumentarSalario(3, 15);
$funcionario->aumentarSalario(4, 8);

// Listar todos os funcionários
$funcionario->listarTodos();

// Salvar ID de um funcionário, realizar unset e carregar novamente
$idParaExcluir = 3;
$funcionario->excluir($idParaExcluir);

// Listar novamente após exclusão
$funcionario->listarTodos();

// Carregar dados de um funcionário excluído
$funcionarioExcluido = new Funcionario();
$funcionarioExcluido->carregarPorId($idParaExcluir);

?>
