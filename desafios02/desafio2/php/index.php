<?php
//sudo chmod -R 755 /home/imply/Área\ de\ Trabalho/desafios/desafios02/desafio2/dados     se por acaso acontecer de novo
//sudo chown -R imply /home/imply/Área\ de\ Trabalho/desafios/desafios02/desafio2/dados
//remover dados

//cd /home/imply/Área\ de\ Trabalho/desafios/desafios02/desafio2
//docker-compose up -d
//docker context use default

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

echo "\nFuncionários após cadastro:\n\n";
$funcionario1->listarTodos();
// Alterando os nomes e aumentando os salários

$funcionario1->mudaNome("Alvin Alfredo"); // Altera o nome objeto
$funcionario1->aumentarSalario(10); // Aumenta o salário em 10%
$funcionario1->atualizar();

$funcionario2->mudaNome("Gyovana Santana"); // Altera o nome objeto
$funcionario2->aumentarSalario(10); // Aumenta o salário em 10%
$funcionario2->atualizar();

$funcionario3->mudaNome("Carlinhos Carter"); // Altera o nome objeto
$funcionario3->aumentarSalario(10); // Aumenta o salário em 10%
$funcionario3->atualizar();

$funcionario4->mudaNome("Anastasia Albergue"); // Altera o nome objeto
$funcionario4->aumentarSalario(10); // Aumenta o salário em 10%
$funcionario4->atualizar();

// Listando todos os funcionários após as alterações
echo "\nFuncionários após alterações:\n\n";
$funcionario1->listarTodos();


// Salvando o ID de um funcionário e realizando unset no objeto
$idSalvo = $funcionario1->salvaId();
unset($funcionario1);

// Carregando os dados do funcionário com o ID salvo
$funcionarioRecarregado = new Funcionario();
$dadosFuncionario = $funcionarioRecarregado->construirPorId($idSalvo);
echo "\nDados do funcionário recarregado:\n\n";
echo "{$dadosFuncionario['id']}, {$dadosFuncionario['nome']}, {$dadosFuncionario['genero']}, {$dadosFuncionario['idade']}, {$dadosFuncionario['salario']}\n";

// Excluindo um funcionário e listando os restantes
$funcionario3->excluir();

echo "\nFuncionários após exclusão:\n\n";
$funcionario3->listarTodos();
?>
