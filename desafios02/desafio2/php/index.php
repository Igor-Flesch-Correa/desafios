<?php

require_once 'Conexao.php';
require_once 'Funcionario.php';

// Realizando 4 cadastros de funcionários
$funcionario1 = new Funcionario("Alvin", "Masculino", 30, 3000.00);
$funcionario1->cadastrar();

$funcionario2 = new Funcionario("Gyovana", "Feminino", 28, 3200.00);
$funcionario2->cadastrar();

$funcionario3 = new Funcionario("Carlinhos", "Masculino", 35, 3500.00);
$funcionario3->cadastrar();

$funcionario4 = new Funcionario("Anastasia", "Feminino", 32, 3400.00);
$funcionario4->cadastrar();

// Alterando os nomes e aumentando os salários

$funcionario1->mudaNome("João Leiteiro"); // Altera o nome
$funcionario1->aumentarSalario(10); // Aumenta o salário em 10%


// Listando todos os funcionários após as alterações
echo "Funcionários após alterações:\n";
$listaFuncionarios = $funcionario1->listarTodos();
foreach ($listaFuncionarios as $func) {
    echo "{$func['nome']}, {$func['genero']}, {$func['idade']}, {$func['salario']}\n";
}

// Salvando o ID de um funcionário e realizando unset no objeto
$idSalvo = $funcionario1->id;
unset($funcionario1);

// Carregando os dados do funcionário com o ID salvo
$funcionarioRecarregado = new Funcionario();
$dadosFuncionario = $funcionarioRecarregado->listarPorId($idSalvo);
echo "\nDados do funcionário recarregado:\n";
echo "{$dadosFuncionario['nome']}, {$dadosFuncionario['genero']}, {$dadosFuncionario['idade']}, {$dadosFuncionario['salario']}\n";

// Excluindo um funcionário e listando os restantes
$funcionario2->excluir();

echo "\nFuncionários após exclusão:\n";
$listaFuncionariosAtualizada = $funcionario3->listarTodos();
foreach ($listaFuncionariosAtualizada as $func) {
    echo "{$func['nome']}, {$func['genero']}, {$func['idade']}, {$func['salario']}\n";
}
